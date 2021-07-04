<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin  extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = ['firstname','lastname','username','password','phone','role','email'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $table = 'admins';

}
