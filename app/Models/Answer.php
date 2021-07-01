<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['answer','question_id'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $table = 'answers';
}
