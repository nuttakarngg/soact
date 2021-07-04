<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','student_id','answer','feedback_id'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $table = 'feedbacks';

    public function students()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function clubs(){
        return $this->belongsTo(Clubs::class,'club_id');
    }
    public function questions(){
        return $this->belongsTo(Question::class,'question_id')->with('clubs');
    }
}
