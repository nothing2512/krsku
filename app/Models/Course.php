<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "semesterId",
        "name",
        "short_name",
        "kosek",
        "dosen",
        "sks",
        "day",
        "score",
        "start_time",
        "end_time",
        "lms_type",
        "lms_link",
        "group_link"
    ];
}
