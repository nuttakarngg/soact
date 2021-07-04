<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Admin::all();
        return view('admin.admin',['admins'=>$admin]);
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
        $admin = new Admin();
        $admin->firstname = $request->firstname;
        $admin->lastname = $request->lastname;
        $admin->username = $request->username;
        $admin->password = $request->password;
        $admin->faction = $request->faction;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        if($admin->save()){
            $error = [1,'เพิ่มผู้ใช้สำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->route('admin.index')->with(['result'=>$error[0],'text'=>$error[1]]);
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
        $admin = Admin::find($id);
        return view('admin.edit-admin',['admin'=>$admin]);
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
        $admin = Admin::find($id);
        $admin->firstname = $request->firstname;
        $admin->lastname = $request->lastname;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->faction = $request->faction;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        if($admin->save()){
            $error = [1,'แก้ไขผู้ใช้สำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->route('admin.index')->with(['result'=>$error[0],'text'=>$error[1]]);
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

        $admin = Admin::find($id);
        if($admin->role==0){
            return redirect()->route('admin.index')->with(['result'=>[0],'text'=>'ไม่สามารถลบ Root Admin ได้']);
        }
        if($admin->delete()){
            $error = [1,'ลบผู้ใช้สำเร็จ'];
        }else{
            $error = [0,'เกิดข้อผิดพลาดบางอย่าง โปรดติดต่อแอดมิน'];
        }
        return redirect()->route('admin.index')->with(['result'=>$error[0],'text'=>$error[1]]);
    }
}
