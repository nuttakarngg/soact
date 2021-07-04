<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\QuestionController;
use App\Models\Admin;
use App\Models\Clubs;
use App\Models\Feedback;
use App\Models\Question;
use App\Models\Student;
use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route
Route::middleware('hasLogin')->group(function(){
    Route::get('/list-answered/{club?}',function($id){
        $feedback = Feedback::with(['students','clubs','questions'])->Where('club_id',$id)->get();
        $club = Clubs::find($id);
        $score = 0;
        $students = [];
        foreach ($feedback as $item) {
            $students[$item->student_id]['scores'][$item->question_id] = $item->questions->answer === $item->answer;
            $students[$item->student_id]['score'] = $score;
            $students[$item->student_id]['student'] = $item->students;
        }
        $maxscore =Question::Where('club_id',$id)->selectRaw('count(*) as max')->first();
        return view('clubs.list-answered',['students'=>$students,'club'=>$club,'maxscore'=>$maxscore->max]);
        // return response()->json($student);
    })->name('list-answered');
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Resource
    Route::resource('clubs', ClubsController::class);
    Route::resource('admin', AdminController::class);
    Route::resource('question', QuestionController::class);

});


Route::get('/successfuly',function(){
    return view('success');
})->name('success');
Route::get('/404Notfound', function () {
    return view('notfound');
})->name('notfound');
Route::get('/feedback/{club?}/{time?}',function($id, $time){
    $token = Token::Where([['club_id','=', $id],['token','=',$time]])->first();
    $club = Clubs::find($id);
    if(!$club->open){
        return 'ชมรมปิดรับสมัครแล้ว';
    }
    if ($time > now()->timestamp - 86400 && $token!=null && $token->student_id==null) {
        return view('Feedback',['token'=>$time,'club'=>$id]);
    }else{
        return 'Url นี้ถูกใช้ไปแล้ว';
    }
    return redirect()->route('notfound');
});


Route::get('login',function(){
    return view('login');
});

Route::post('/login',function(Request $request){
    $admin = Admin::Where('username',$request->username)->first();
    // dd($request->all());
    // dd($admin);
    if(Hash::check($request->password,$admin->password)){
        // auth()->login($admin);
        $request->session()->regenerate();
    }
    return redirect()->route('dashboard');
})->name('login');

Route::prefix('/api')->group(function(){
    Route::get('/get/question/{club?}', function ($id) {
            $club = Clubs::find($id);
            $questions = Question::where('club_id', $id)->with('answers')->get()->toArray();
            shuffle($questions);
            foreach ($questions as $idx => $item) {
                shuffle($item['answers']);
                $questions[$idx]['answers'] = $item['answers'];
            }

            return response()->json(['data'=>$questions,'club_name'=>$club->name]);
    })->name('getquestion');

    Route::get('/get/token/{club?}', function ($id) {
        $token = new Token();
        $token->token = now()->timestamp;
        $token->club_id = $id;
        if ($token->save()) {
            return response()->json(['token' => $token->token]);
        } else {
            return response()->json(['error' => 'someting went wrongs']);
        }
    });

    Route::post('/feedback/{club?}',function(Request $request,$id){
        $feedback = Feedback::Where([['student_id',$request->student['stdid']],['club_id',$id]])->first();
        if($feedback){
            return response()->json(['error'=>'student is registered','student'=>$feedback],403);
        }
        $student = new Student();
        $student->firstname =$request->student['firstname'];
        $student->lastname = $request->student['lastname'];
        $student->branch =$request->student['branch'];
        $student->stdid = $request->student['stdid'];
        $student->faculty=  $request->student['faculty'];
        $student->phone= $request->student['phone'];
        $student->level= $request->student['level'];
        $student->save();
        foreach ($request->feedback as $id => $item) {
            $feedback = new Feedback();
            $feedback->question_id = $item['question_id'];
            $feedback->student_id =  $student['id'];
            $feedback->club_id = $item['club_id'];
            $feedback->answer = $item['answer'];
            $feedback->save();
        }
        $token = Token::where('token',$request->token)->first();
        $token->club_id = $feedback->club_id;
        $token->student_id = $request->student['stdid'];
        $token->stdid = $student->id;
        $token->save();
        return response()->json($request->all());
    })->name('savefeedback');
});
