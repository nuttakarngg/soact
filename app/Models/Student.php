<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['firstname','lastname','branch','stdid','faculty','phone','level'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $table = 'students';
}
