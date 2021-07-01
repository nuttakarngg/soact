<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['firstname','lastname','username','password','phone','role','email'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $table = 'admins';
}

