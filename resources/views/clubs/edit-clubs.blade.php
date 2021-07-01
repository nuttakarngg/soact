@extends('layouts.app')
@section('title', $club->name . ' (Edit)')
@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="col-12">
                <form action="{{ route('clubs.update', ['club' => $club->id]) }}" method="POST" class="update">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>ชื่อชมรม</label>
                        <input type="text" class="form-control" required name="name" value="{{ $club->name }}"
                            placeholder="ชื่อ">
                    </div>
                    <div class="form-group">
                        <label>คำอธิบาย</label>
                        <input type="text" class="form-control" required name="description" value="{{ $club->description }}"
                            placeholder="คำอธิบาย">
                    </div>
                    <div class="form-group">
                        <label>เฟสบุ๊ค</label>
                        <input type="text" class="form-control" name="facebook" value="{{ $club->facebook }}"
                            placeholder="facebook.com/example">
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone" value="{{ $club->phone }}"
                            placeholder="เบอร์โทร">
                    </div>
                    <div class="form-group">
                        <label>วิดีโอ</label>
                        <input type="text" class="form-control" name="vdo" value="{{ $club->vdo }}"
                            placeholder="youtube.com/example">
                    </div>
                    <div class="form-group">
                        <label>หน่วยงาน</label>
                        <input type="text" class="form-control" name="faction" value="{{ $club->faction }}"
                            placeholder="หน่วยงาน/ฝ่าย/คณะ">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary px-3" type="button" id="save">บันทึก</button>
                            <a href="{{ route('clubs.index') }}">กลับไปก่อนหน้า</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#save').on('click',async function(e){
            let result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Edit it!'
            })
            if(result.isConfirmed){
               console.log($(`.update`).submit())
            }
        } )
    </script>
@endsection
