<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question','answer','club_id','show'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $table = 'questions';

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function clubs(){
        return $this->belongsTo(Clubs::class,'club_id');
    }
}
