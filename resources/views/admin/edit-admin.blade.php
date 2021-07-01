@extends('layouts.app')
@section('title', $admin->firstname . ' ' . $admin->lastname . ' (Edit)')
@section('content')

    <div class="container my-3">
        <form action="{{ route('admin.update', ['admin' => $admin->id]) }}" method="POST" class="update">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>ชื่อ</label>
                <input type="text" class="form-control" value="{{ $admin->firstname }}" name="firstname" required>
            </div>
            <div class="form-group">
                <label>นามสกุล</label>
                <input type="text" class="form-control" value="{{ $admin->lastname }}" name="lastname" required>
            </div>
            <div class="form-group">
                <label>ชื่อผู้ใช้</label>
                <input type="text" class="form-control" value="{{ $admin->username }}" name="username" required>
            </div>
            <div class="form-group">
                <label>รหัสผ่าน</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label>อีเมล์</label>
                <input type="email" class="form-control" value="{{ $admin->email }}" name="email">
            </div>
            <div class="form-group">
                <label>หน่วยงาน</label>
                <input type="text" class="form-control" value="{{ $admin->faction }}" name="faction">
            </div>
            <div class="form-group">
                <label>เบอร์โทร</label>
                <input type="text" class="form-control" value="{{ $admin->phone }}" name="phone">
            </div>
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary px-3" type="button" id="save">บันทึก</button>
                    <a href="{{ route('admin.index') }}">กลับไปก่อนหน้า</a>
                </div>
            </div>
        </form>

    </div>

@endsection

@section('script')
    <script>
        $('#save').on('click', async function(e) {
            if ($('#password').val() == "" || $('#password').val() == null) {
                e.preventDefault();
                Swal.fire(
                    'Register Error?',
                    'Password can\'t empty',
                    'error'
                )
            } else {
                let result = await Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Edit it!'
                })
                if (result.isConfirmed) {
                    console.log($(`.update`).submit())
                }
            }

        })
    </script>
@endsection
