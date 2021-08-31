<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "courseId",
        "type",
        "link"
    ];

    public function getTable(): string
    {
        return "presence";
    }
}
