<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskView extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "tasks_view";
    }
}
