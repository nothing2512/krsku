<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseView extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "courses_view";
    }
}
