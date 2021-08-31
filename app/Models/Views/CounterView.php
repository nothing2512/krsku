<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterView extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "counter_view";
    }
}
