<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Views\CounterView;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    function index()
    {
        $user = user();

        $certificates = Certificate::query()
            ->where("userId", $user->id)
            ->get();

        $counter = CounterView::query()
            ->where("userId", $user->id)
            ->first();

        return view("certificate")->with([
            "certificates" => $certificates,
            "user" => $user,
            "counter" => $counter
        ]);
    }

    function store(Request $request)
    {
        $user = user();
        $file = $request->file("attachments");
        $path = $file->storeAs("certificates", uniqid() . "." . $file->extension());

        Certificate::query()->create([
            "userId" => $user->id,
            "title" => $request->input("title"),
            "obtainedDate" => $request->input("obtainedDate"),
            "expiredDate" => $request->input("expiredDate"),
            "attachments" => route("attachments", ["path" => $path]),
            "mime" => $file->getMimeType()
        ]);

        return redirect()->back();
    }

    function update(Request $request, $id)
    {
        $certificate = Certificate::query()->where("id", $id)->first();
        if ($certificate == null) return notFound("Certificate");

        $certificate->fill($request->all());
        $file = $request->file("attachments");

        if ($file != null) {
            $path = $file->storeAs("certificates", uniqid() . "." . $file->extension());
            $certificate->fill([
                "attachments" => route("attachments", ["path" => $path]),
                "mime" => $file->getMimeType()
            ]);
        }

        $certificate->save();

        return redirect()->back();
    }

    function destroy(Request $request, $id)
    {
        Certificate::query()->where("id", $id)->delete();
        return redirect()->back();
    }
}
