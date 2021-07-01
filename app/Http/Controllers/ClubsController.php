<?php

namespace App\Http\Controllers;

use App\Models\Clubs;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClubsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = Clubs::all();
        return view('clubs.clubs',['clubs'=>$clubs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $club = new Clubs();
        $club->name = $request->name;
        $club->description = $request->description;
        $club->facebook = $request->facebook;
        $club->phone = $request->phone;
        $club->faction = $request->faction;
        $club->vdo = $request->vdo;
        $error = [];
        if($club->save()){
            $error = [1,'บันทึกชมรมสำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->route('clubs.index')->with(['result'=>$error[0],'text'=>$error[1]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $club = Clubs::find($id);

        return view('clubs.edit-clubs',['club'=>$club]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function edit(Clubs $clubs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $club = Clubs::find($id);
        $club->name = $request->name;
        $club->description = $request->description;
        $club->facebook = $request->facebook;
        $club->phone = $request->phone;
        $club->vdo = $request->vdo;
        $club->faction = $request->faction;

        if($club->update()){
            $error = [1,'แก้ไขรมสำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->route('clubs.index')->with(['result'=>$error[0],'text'=>$error[1]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clubs  $clubs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        if(Clubs::find($id)->delete()){
            $error = [1,'ลบชมรมสำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->route('clubs.index')->with(['result'=>$error[0],'text'=>$error[1]]);
    }
}
