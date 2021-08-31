<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingTaskView extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "incoming_tasks_view";
    }
}
