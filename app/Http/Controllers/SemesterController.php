<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Views\CounterView;
use App\Models\Views\SemesterView;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    function index()
    {
        $user = user();

        $semesters = SemesterView::query()
            ->where("userId", $user->id)
            ->get();

        $counter = CounterView::query()
            ->where("userId", $user->id)
            ->first();

        return view("semester")->with([
            "semesters" => $semesters,
            "user" => $user,
            "counter" => $counter
        ]);
    }

    function store(Request $request)
    {
        Semester::query()
            ->where("userId", user()->id)
            ->update(["active" => 0]);
        Semester::query()->create([
            "userId" => user()->id,
            "code" => $request->input("code"),
            "name" => $request->input("name"),
            "active" => 1
        ]);

        return redirect()->route("semester");
    }

    function activate(Request $request, $id)
    {
        Semester::query()
            ->where("userId", user()->id)
            ->update(["active" => 0]);
        Semester::query()
            ->where("id", $id)
            ->update(["active" => 1]);

        return redirect()->route("semester");
    }

    function update(Request $request, $id)
    {
        $semester = Semester::query()
            ->where("id", $id)
            ->first();

        if ($semester == null) return notFound("Semester");

        $semester->fill($request->all());
        $semester->save();

        return redirect()->route("semester");
    }

    function destroy(Request $request, $id)
    {
        Semester::query()->where("id", $id)->delete();
        return redirect()->route("semester");
    }
}
