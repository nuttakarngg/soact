@extends('layouts.app')
@section('title', "ผลการตอบกลับ ($club->name)")
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 bg-white">
                <div class="row">
                    <div class="col-md-12 text-black">
                        <h5>กรองข้อมูล</h5>
                        <form class="row" method="GET">
                            <div class="col-md-4 d-flex">
                                <div class="form-check mx-2">
                                    <input type="radio" id="pass" name="pass" value="true">
                                    <label for="pass">ผ่าน</label>
                                </div>
                                <div class="form-check mx-2">
                                    <input type="radio" id="nopass" name="pass" value="false">
                                    <label for="nopass">ไม่ผ่าน</label>
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                    <div class="form-group d-flex">
                                        <input type="text" name="max" id="max" placeholder="maxscore" class="form-control mx-1">
                                        <input type="text" name="min" id="min" placeholder="minscore" class="form-control mx-1">
                                        <button class="btn btn-primary"> ค้นหา</button>
                                    </div>
                            </div>
                            {{-- <div class="d-flex row">
                                <div class="form-check mx-2 col-1">
                                    <input type="radio" id="pass" name="pass" value="true">
                                    <label for="pass">ผ่าน</label>
                                </div>
                                <div class="form-check mx-2  col-1">
                                    <input type="radio" id="pass" name="pass" value="false">
                                    <label for="pass">ไม่ผ่าน</label>
                                </div>

                            </div> --}}
                        </form>
                    </div>

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
                                <td
                                    class="text-center {{ array_sum($student['scores']) < $maxscore / 2 ? 'text-danger' : 'text-success' }}">
                                    {{ array_sum($student['scores']) }} / {{ $maxscore }}</td>
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
