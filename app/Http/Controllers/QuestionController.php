<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Clubs;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clubs = Clubs::all();
        return view('questions.club-questions',['clubs'=>$clubs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $question = new Question();
        $question->club_id = $request->club_id;
        $question->question = $request->question;
        $question->show = true;
        $question->answer = $request->answer;
        $result_1 = $question->save();
        foreach($request->answers as $answer_item){
            $answer = new Answer();
            $answer->question_id = $question->id;
            $answer->answer = $answer_item;

            $result_2 = $answer->save();

        }

        if($result_1 && $result_2){
            $error = [1,'สร้างสำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->back()->with(['result'=>$error[0],'text'=>$error[1]]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $questions = Question::where('club_id',$id)->with('answers')->get();

        return view('questions.question',['questions'=>$questions,'club_id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question = Question::find($id);
        return view('questions.edit-question',['question'=>$question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $question = Question::find($id);
        $question->question = $request->question;

        if(count($request->answers)==4){
            Answer::where('question_id',$id)->delete();
            foreach($request->answers as $answer_item){
                $answer = new Answer();
                $answer->question_id = $question->id;
                $answer->answer = $answer_item;
                $valid_1 = $answer->save();
            }
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
            return redirect()->back()->with(['result'=>$error[0],'text'=>$error[1]]);
        }

        $question->answer = $request->answer;
        $valid_2 = $question->save();
        if($valid_1 && $valid_2){
            $error = [1,'ลบสำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->back()->with(['result'=>$error[0],'text'=>$error[1]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        if(Question::Where('id',$id)->delete() && Answer::where('question_id',$id)->delete()){
            $error = [1,'ลบสำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->back()->with(['result'=>$error[0],'text'=>$error[1]]);
    }
}
