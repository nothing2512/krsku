<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartIpkView extends Model
{
    use HasFactory;

    public function getTable()
    {
        return "chart_ipk_view";
    }
}
