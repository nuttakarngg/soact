@extends('layouts.app')
@section('title', "ผลการตอบกลับ ($club->name)")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 bg-white">
                <h5>กรองข้อมูล</h5>
                <div class="d-flex mb-3">
                    {{-- <input type="checkbox" name="" id=""> --}}
                </div>
                <table class="table table-striped table-bordered" id="student-table">
                    <thead>
                        <tr class="text-center">
                            <th>รหัสนักศึกษา</th>
                            <th>ชื่อ</th>
                            <th> นามสกุล </th>
                            <th> สาขา </th>
                            <th> คณะ </th>
                            <th> เบอร์โทร </th>
                            <th>ชั้นปี</th>
                            <th>คะแนน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <th>{{ $student['student']['stdid'] }}</th>
                                <td>{{ $student['student']['firstname'] }}</td>
                                <td>{{ $student['student']['lastname'] }}</td>
                                <td>{{ $student['student']['branch'] }}</td>
                                <td>{{ $student['student']['faculty'] }}</td>
                                <td>{{ $student['student']['phone'] }}</td>
                                <td>{{ $student['student']['level'] }}</td>
                                <td class="text-center {{array_sum($student['scores'])<$maxscore/2?'text-danger':'text-success'}}">{{array_sum($student['scores'])}} / {{$maxscore}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#student-table').DataTable();
        });
    </script>
@endsection
