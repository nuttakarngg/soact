@extends('layouts.app')
@section('title', 'Clubs')
@section('content')
    <!-- Button trigger modal -->

    <!-- Modal -->
    <form class="modal fade" id="addclubs" tabindex="-1" aria-labelledby="addclubs" aria-hidden="true"
        action="{{ route('clubs.store') }}" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addclubs">เพิ่มชมรม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-sample">
                    @csrf
                    <div class="form-group">
                        <label>ชื่อชมรม</label>
                        <input type="text" class="form-control" required name="name" placeholder="ชื่อ">
                    </div>
                    <div class="form-group">
                        <label>คำอธิบาย</label>
                        <input type="text" class="form-control" required name="description" placeholder="คำอธิบาย">
                    </div>
                    <div class="form-group">
                        <label>เฟสบุ๊ค</label>
                        <input type="text" class="form-control" name="facebook" placeholder="facebook.com/example">
                    </div>
                    <div class="form-group">
                        <label>เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone" placeholder="เบอร์โทร">
                    </div>
                    <div class="form-group">
                        <label>วิดีโอ</label>
                        <input type="text" class="form-control" name="vdo" placeholder="youtube.com/example">
                    </div>
                    <div class="form-group">
                        <label>หน่วยงาน</label>
                        <input type="text" class="form-control" name="faction" placeholder="หน่วยงาน/ฝ่าย/คณะ">
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
        <div class="alert alert-{{ session('result') == 1 ? 'success' : 'danger' }}" role="alert">
            {{ session('text') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 bg-white">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn btn-inverse-success my-3" data-toggle="modal" data-target="#addclubs">เพิ่มชมรม <i
                                class="mdi mdi-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="clubs-table" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> ชื่อชมรม </th>
                                <th> คำอธิบาย </th>
                                <th> Facebook </th>
                                <th> เบอร์โทร </th>
                                <th> วีดีโอ </th>
                                <th> หน่วยงาน </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clubs as $idx=>$club)
                                <tr>
                                    <td class="text-center">

                                        <form method="POST" action="{{ route('clubs.destroy', ['club' => $club->id]) }}" class="form-delete-{{$idx}} d-inline" onsubmit="delete($idx)"  >
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-delete" value="{{$idx}}" type="button"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </form>
                                        <form method="GET" action="{{ route('clubs.destroy', ['club' => $club->id]) }}"  class="d-inline">

                                            <button  class="btn btn-warning"><i
                                                class="mdi mdi-lead-pencil"></i></button>
                                        </form>

                                    </td>
                                    <td>{{ $club->name }}</td>
                                    <td class="text-wrap" style="line-height: 20px">{{ $club->description }}</td>
                                    <td>{{ $club->facebook }}</td>
                                    <td>{{ $club->phone }}</td>
                                    <td>{{ $club->vdo }}</td>
                                    <td>{{ $club->faction }}</td>

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
        $(document).ready( function () {
    $('#clubs-table').DataTable();
} );
        $('.btn-delete').on('click',async function(e) {

            let result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            if(result.isConfirmed){
               $(`.form-delete-${this.value}`).submit();
            }
        })

    </script>


@endsection
