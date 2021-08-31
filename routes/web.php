<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/attachments/{path?}", function (Request $request, $path) {
    if ($request->input("r", "embed") == "embed")
        return Storage::response($path);
    else return Storage::download($path);
})->where('path', '.*')->name("attachments");

Route::prefix("services")->middleware("auth:true")->group(function () {
    Route::post("/semester", [SemesterController::class, "store"])->name("api.semester.add");
    Route::post("/semester/{id}", [SemesterController::class, "update"])->name("api.semester.edit");
    Route::get("/semester/{id}/delete", [SemesterController::class, "destroy"])->name("api.semester.delete");
    Route::get("/semester/{id}/activate", [SemesterController::class, "activate"])->name("api.semester.activate");

    Route::post("course", [CourseController::class, "store"])->name("api.course.add");
    Route::post("course/{id}", [CourseController::class, "update"])->name("api.course.edit");
    Route::get("course/{id}/delete", [CourseController::class, "destroy"])->name("api.course.delete");

    Route::post("/presence", [PresenceController::class, "store"])->name("api.presence.add");
    Route::post("/presence/{id}", [PresenceController::class, "update"])->name("api.presence.edit");
    Route::get("/presence/{id}/delete", [PresenceController::class, "destroy"])->name("api.presence.delete");

    Route::post("/team", [TeamController::class, "store"])->name("api.team.add");
    Route::post("/team/{id}", [TeamController::class, "update"])->name("api.team.edit");
    Route::get("/team/{id}/delete", [TeamController::class, "destroy"])->name("api.team.delete");

    Route::post("/certificate", [CertificateController::class, "store"])->name("api.certificate.add");
    Route::post("/certificate/{id}", [CertificateController::class, "update"])->name("api.certificate.edit");
    Route::get("/certificate/{id}/delete", [CertificateController::class, "destroy"])->name("api.certificate.delete");

    Route::post("/task", [TaskController::class, "store"])->name("api.task.add");
    Route::post("/task/{id}", [TaskController::class, "update"])->name("api.task.edit");
    Route::get("/task/{id}/attachments", [TaskController::class, "attachments"])->name("api.task.attachments");
    Route::get("/task/{id}/status", [TaskController::class, "updateStatus"])->name("api.task.edit.status");
    Route::get("/task/{id}/delete", [TaskController::class, "destroy"])->name("api.task.delete");

    Route::post("/user", [UserController::class, "update"])->name("api.user.edit");
});

Route::prefix("services")->middleware("auth:false")->group(function () {
    Route::post("/auth/login", [AuthController::class, "login"])->name("api.login");
    Route::post("/auth/register", [AuthController::class, "register"])->name("api.register");

    Route::get("/auth/login", [AuthController::class, "login"])->name("login");
    Route::get("/auth/register", [AuthController::class, "register"])->name("register");
});

Route::middleware("auth:true")->group(function () {

    Route::get("/", [DashboardController::class, "index"])->name("dashboard");

    Route::get("/semesters", [SemesterController::class, "index"])->name("semester");

    Route::get("/courses", [CourseController::class, "index"])->name("course");
    Route::get("/course/{id}", [CourseController::class, "show"])->name("course.detail");

    Route::get("/certificates", [CertificateController::class, "index"])->name("certificate");

    Route::get("/auth/logout", [AuthController::class, "logout"])->name("logout");
});

Route::any("/testing", function () {
    return view('testing');
});
