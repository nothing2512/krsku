<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function uploadAttachment($taskId, $attachments = [], $savedIds=[]) {
        $now = now();
        $now->addHours(7);
        $attachmentPayloads = [];

        $oldAttachments = TaskAttachment::query()
            ->where("taskId", $taskId)
            ->whereNotIn("id", $savedIds)
            ->get();

        if (sizeof($oldAttachments) > 0) {
            TaskAttachment::query()
                ->where("taskId", $taskId)
                ->whereNotIn("id", $savedIds)
                ->delete();
        }

        foreach ($attachments as $file) {
            $path = $file->storeAs("tasks", uniqid() . "." . $file->extension());
            array_push($attachmentPayloads, [
                "taskId" => $taskId,
                "filename" => $file->getClientOriginalName(),
                "mime" => $file->getMimeType(),
                "url" => route("attachments", ["path" => $path]),
                "created_at" => $now,
                "updated_at" => $now
            ]);
        }

        TaskAttachment::query()->insert($attachmentPayloads);
    }

    function attachments($id) {
        $tasks = TaskAttachment::query()
            ->where("taskId", $id)
            ->get();
        return response()->json($tasks);
    }

    function store(Request $request) {
        $task = Task::query()->create($request->all());
        $attachments = $request->file("attachments", []);
        $this->uploadAttachment($task->id, $attachments);
        return redirect()->back();
    }

    function update(Request $request, $id) {
        $task = Task::query()->where("id", $id)->first();
        if ($task == null) return notFound("Task");
        $task->fill($request->all());
        $task->save();

        $savedIds = $request->input("attachmentIds", []);
        $attachments = $request->file("attachments", []);
        $this->uploadAttachment($task->id, $attachments, $savedIds);

        return redirect()->back();
    }

    function updateStatus(Request $request, $id) {
        $task = Task::query()->where("id", $id)->first();
        if ($task == null) return notFound("Task");
        $task->fill([
            "status" => $task->status == 0 ? 1 : 0
        ]);
        $task->save();
        return redirect()->back();
    }

    function destroy(Request $request, $id) {
        Task::query()->where("id", $id)->delete();
        TaskAttachment::query()->where("taskId", $id)->delete();
        return redirect()->back();
    }
}
