<?php

namespace App\Http\Controllers;

use App\Models\Views\ChartIpkView;
use App\Models\Views\CounterView;
use App\Models\Views\CourseView;
use App\Models\Views\IncomingTaskView;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index() {
        $user = user();

        $ipkChart = ChartIpkView::query()
            ->where("userId", $user->id)
            ->get();

        $counter = CounterView::query()
            ->where("userId", $user->id)
            ->first();

        $ipk = [];
        foreach ($ipkChart as $item) array_push($ipk, $item->ipk);

        $events = [];
        $courses = CourseView::query()
            ->where("userId", $user->id)
            ->get();

        $colors = [
            "#3c8dbc",
            "#f39c12",
            "#0073b7",
            "#00c0ef",
            "#00a65a"
        ];

        $i = 0;
        foreach ($courses as $course) {
            array_push($events, $this->createCalendarEvent($course, $colors[$i % sizeof($colors)]));
            $i++;
        }

        $tasks = IncomingTaskView::query()
            ->where("userId", $user->id)
            ->orderBy("deadline")
            ->get();

        return view("dashboard")->with([
            "ipk" => json_encode($ipk),
            "counter" => $this->getCounterBackground($counter),
            "tasks" => $tasks,
            "user" => $user,
            "events" => json_encode($events)
        ]);
    }

    function createCalendarEvent($course, $color): array
    {
        $now = now();
        $now->addHours(7);
        $now->addDays(-$now->dayOfWeek);
        $now->addDays($course->day);

        return [
            "title" => $course->short_name,
            "start" => $now->format("Y-m-d") . "T" . $course->start_time,
            "end" => $now->format("Y-m-d") . "T" . $course->end_time,
            "backgroundColor" => $color,
            "borderColor" => $color,
            "url" => route("course.detail", ["id" => $course->id])
        ];
    }

    function getRatioBackground($ratio): string
    {
        if ($ratio < 30) return "bg-danger";
        else if ($ratio < 60) return "bg-warning";
        else if ($ratio < 90) return "bg-info";
        else return "bg-success";
    }

    function getCounterBackground($counter)
    {
        $semesterRatio = $counter->semester * 100 / $counter->targetSemester;
        $sksRatio = $counter->sks * 100 / $counter->targetSks;
        $certificateRatio = $counter->certificates * 100 / $counter->targetCertificates;

        $counter->bgSemester = $this->getRatioBackground($semesterRatio);
        $counter->bgSks = $this->getRatioBackground($sksRatio);
        $counter->bgCertificate = $this->getRatioBackground($certificateRatio);

        if ($counter->ipk < 2.5) $counter->bgIpk = "bg-danger";
        else if ($counter->ipk < 3.0) $counter->bgIpk = "bg-warning";
        else if ($counter->ipk < 3.5) $counter->bgIpk = "bg-info";
        else $counter->bgIpk = "bg-success";

        return $counter;
    }
}
