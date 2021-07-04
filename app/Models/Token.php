<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['token','used','club_id','student_id','stdid'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $table = 'token';

}
