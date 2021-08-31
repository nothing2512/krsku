<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use App\Models\TeamUser;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    function store(Request $request)
    {
        $team = Team::query()->create($request->all());
        $users = explode("\n", $request->input("users"));
        foreach ($users as $user) {
            TeamUser::query()->create([
                "teamId" => $team->id,
                "name" => $user
            ]);
        }
        return redirect()->back();
    }

    function update(Request $request, $id)
    {
        $team = Team::query()->where("id", $id)->first();
        if ($team == null) return notFound("Team");

        $team->fill($request->all());
        $team->save();

        TeamUser::query()
            ->where("teamId", $team->id)
            ->delete();
        $users = explode("\n", $request->input("users"));
        foreach ($users as $user) {
            TeamUser::query()->create([
                "teamId" => $team->id,
                "name" => $user
            ]);
        }
        return redirect()->back();
    }

    function destroy(Request $request, $id)
    {
        $team = Team::query()->where("id", $id)->first();
        if ($team == null) return notFound("Team");
        TeamUser::query()->where("teamId", $id)->delete();
        Task::query()->where("teamId", $id)->delete();
        $team->delete();
        return redirect()->back();
    }
}
