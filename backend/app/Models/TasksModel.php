<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksModel extends Model
{
    use HasFactory;
    protected $table = "tasks";
    protected $fillable = [
        'user_id',
        'category_id',
        'description',
        'created_by',
    ];
}
