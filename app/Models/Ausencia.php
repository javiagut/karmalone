<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ausencia extends Model
{
    protected $fillable = ['id_user','id_motivo','estado','fecha'];
    use HasFactory;
}
