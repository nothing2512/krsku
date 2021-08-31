<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    function store(Request $request) {
        Presence::query()->create($request->all());
        return redirect()->route("course.detail", ["id" => $request->input("courseId")]);
    }

    function update(Request $request, $id) {
        $presence = Presence::query()
            ->where("id", $id)
            ->first();
        if ($presence == null) return notFound("Presence");

        $presence->fill($request->all());
        $presence->save();

        return redirect()->route("course.detail", ["id" => $presence->courseId]);
    }

    function destroy(Request $request, $id) {
        $presence = Presence::query()
            ->where("id", $id)
            ->first();
        if ($presence == null) return notFound("Presence");
        $presence->delete();
        return redirect()->route("course.detail", ["id" => $presence->courseId]);
    }
}
