@extends('layouts.app')
@section('title', 'Admins')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <form class="modal fade" id="addadmins" tabindex="-1" aria-labelledby="addadmins" aria-hidden="true"
        action="{{ route('admin.store') }}" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addadmins">เพิ่มผู้ใช้</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-sample">
                    @csrf
                    <div class="form-group">
                        <label>ชื่อ</label>
                        <input type="text" class="form-control" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label>นามสกุล</label>
                        <input type="text" class="form-control" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label>ชื่อผู้ใช้</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>รหัสผ่าน</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>อีเมล์</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>หน่วยงาน</label>
                        <input type="text" class="form-control" name="faction">
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร</label>
                        <input type="text" class="form-control" required name="phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทีก</button>
                </div>
            </div>
        </div>
    </form>
    @if (session('result'))
        <div class="alert alert-{{ session('result') === 1 ? 'success' : 'danger' }}" role="alert">
            {{ session('text') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 bg-white">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn btn-inverse-success my-3" data-toggle="modal"
                            data-target="#addadmins">เพิ่มผู้ใช้งาน <i class="mdi mdi-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="admins-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> ชื่อ </th>
                                <th> นามสกุล </th>
                                <th> ชื่อผู้ใช้ </th>
                                <th> อีเมล์ </th>
                                <th> เบอร์โทร </th>
                                <th> หน่วยงาน </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $idx => $admin)
                                <tr>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('admin.destroy', ['admin' => $admin->id]) }}"
                                            class="form-delete-{{ $idx }} d-inline" onsubmit="delete($idx)">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-delete" value="{{ $idx }}"
                                                type="button"><i class="mdi mdi-delete"></i></button>
                                        </form>
                                        <form method="GET" action="{{ route('admin.destroy', ['admin' => $admin->id]) }}" class="d-inline">

                                            <button class="btn btn-warning"><i class="mdi mdi-lead-pencil"></i></button>
                                        </form>
                                    </td>
                                    <td>{{ $admin->firstname }}</td>
                                    <td>{{ $admin->lastname }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->faction }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#admins-table').DataTable();
        });
        $('.btn-delete').on('click', async function(e) {

            let result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            if (result.isConfirmed) {
                $(`.form-delete-${this.value}`).submit();
            }
        })
    </script>


@endsection
