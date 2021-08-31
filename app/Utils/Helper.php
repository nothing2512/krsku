<?php

use App\Models\User;
use Illuminate\Http\RedirectResponse;

if (!function_exists("user")) {
    function user($user = null)
    {
        if ($user == null) {
            $userId = session()->get("userId");
            if ($userId == null) return null;

            $user = User::query()->where("id", $userId)->first();
            if ($user == null) session()->flush();

            return $user;
        } else {
            session()->put("userId", $user->id);
            return $user;
        }
    }
}

if (!function_exists("error")) {
    function error($message = ""): RedirectResponse
    {
        return redirect()->back()->with("error", $message);
    }
}

if (!function_exists("notFound")) {
    function notFound($name): RedirectResponse
    {
        return redirect()->back()->with("error", "$name not found");
    }
}

if (!function_exists("adminlte")) {
    function adminlte($path): string
    {
        return env("WEB_SERVER", "artisan") == "artisan"
            ? asset("adminlte/$path")
            : asset("public/adminlte/$path");
    }
}
