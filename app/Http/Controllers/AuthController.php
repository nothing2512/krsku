<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        if ($request->method() == "GET") return view("auth.register");

        $nim = $request->input("nim");
        $user = User::query()->where("nim", $nim)->first();
        if ($user != null) return error("Nim telah terdaftar");

        $user = User::query()->create($request->all());
        user($user);

        Setting::query()->create(["userId" => $user->id]);

        return redirect()->route("dashboard");
    }

    function login(Request $request)
    {
        if ($request->method() == "GET") return view("auth.login");

        $nim = $request->input("nim");
        $user = User::query()->where("nim", $nim)->first();
        if ($user == null) return notFound("Nim");

        if (!Hash::check($request->input("password"), $user->password))
            return error("Password is invalid!");

        user($user);

        $oldRoute = $request->input("route");

        return $oldRoute == null ? redirect()->route("dashboard") : redirect($oldRoute);
    }

    function logout()
    {
        session()->flush();
        return redirect()->route("login");
    }
}
