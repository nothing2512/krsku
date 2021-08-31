<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Presence;
use App\Models\Semester;
use App\Models\Task;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\Views\CounterView;
use App\Models\Views\CourseView;
use App\Models\Views\TaskView;
use App\Models\Views\TeamView;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index()
    {
        $user = user();

        $counter = CounterView::query()
            ->where("userId", $user->id)
            ->first();

        $semester = Semester::query()
            ->where("active", 1)
            ->where("userId", $user->id)
            ->select("id", "name")
            ->first();
        if ($semester == null) return error("No Semester Active");

        $courses = CourseView::query()
            ->where("userId", $user->id)
            ->orderBy("day")
            ->orderBy("start_time")
            ->get();

        $totalSks = 0;
        $totalScore = 0;

        foreach ($courses as $course) {
            $totalSks += $course->sks;
            $totalScore += $course->score == 0 ? 0 : $course->score;
        }

        $ipk = $totalSks == 0 && $totalScore == 0 ? 0
            : number_format($totalScore / $totalSks, 2, '.', '');

        return view("courses.index")->with([
            "semester" => $semester->name,
            "semesterId" => $semester->id,
            "courses" => $courses,
            "totalSks" => $totalSks,
            "totalScore" => $totalScore,
            "ipk" => $ipk,
            "user" => $user,
            "counter" => $counter
        ]);
    }

    function show(Request $request, $id)
    {
        $user = user();

        $course = CourseView::query()
            ->where("id", $id)
            ->where("userId", $user->id)
            ->first();

        $counter = CounterView::query()
            ->where("userId", $user->id)
            ->first();

        $semester = Semester::query()
            ->where("id", $course->semesterId)
            ->first();

        $presences = Presence::query()
            ->where("courseId", $course->id)
            ->get();

        $teams = TeamView::query()
            ->where("courseId", $course->id)
            ->get();

        $tasks = TaskView::query()
            ->where("courseId", $course->id)
            ->orderBy("status")
            ->orderByDesc("deadline")
            ->get();

        if (sizeof($tasks) > 0) {
            $taskChart = [0, 0];

            foreach ($tasks as $item) $taskChart[$item->status] += 1;
        } else $taskChart = [0, 1];

        $now = now();
        $now->setHours($now->hour + 7);
        $now->setTimeFromTimeString($course->start_time);
        $dayOfWeek = $now->dayOfWeek;

        if ($course->day == $dayOfWeek) $now->addDays(7);
        else if ($course->day > $dayOfWeek) $now->addDays($course->day - $dayOfWeek);
        else $now->addDays(7 - ($dayOfWeek - $course->day));

        return view('courses.detail')
            ->with([
                "hasContentTitle" => false,
                "course" => $course,
                "semester" => $semester,
                "tasks" => $tasks,
                "teams" => $teams,
                "presences" => $presences,
                "user" => $user,
                "counter" => $counter,
                "defaultTaskDeadline" => $now,
                "taskChart" => json_encode($taskChart)
            ]);
    }

    function store(Request $request)
    {
        Course::query()->create($request->all());
        return redirect()->route("course");
    }

    function update(Request $request, $id)
    {
        $course = Course::query()
            ->where("id", $id)
            ->first();

        if ($course == null) return notFound("Course");

        $course->fill($request->all());
        $course->save();

        return redirect()->back();
    }

    function destroy(Request $request, $id)
    {
        Course::query()->where("id", $id)->delete();
        Presence::query()->where("courseId", $id)->delete();
        TeamUser::query()->whereIn("teamId",
            Team::query()->where("courseId", $id)->select("id")
        );
        Team::query()->where("courseId", $id)->delete();
        Task::query()->where("courseId", $id)->delete();
        return redirect()->route("course");
    }
}
