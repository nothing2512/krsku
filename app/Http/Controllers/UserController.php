<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function update(Request $request) {
        $user = user();
        $setting = Setting::query()->where("userId", $user->id)->first();

        $user->fill($request->all());
        $setting->fill($request->all());

        $user->save();
        $setting->save();

        return redirect()->back();
    }
}
