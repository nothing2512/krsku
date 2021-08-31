<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamView extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "teams_view";
    }
}
