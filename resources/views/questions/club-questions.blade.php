@extends('layouts.app')
@section('title', 'Questions')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 bg-white">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="clubs-table">
                        <thead>
                            <tr>
                                <th>แก้ไขคำถาม</th>
                                <th> ชื่อชมรม </th>
                                <th> คำอธิบาย </th>
                                <th> หน่วยงาน </th>
                                <th> ตอบไปแล้ว </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clubs as $idx => $club)
                                <tr>
                                    <td class="text-center">
                                        <form method="GET" action="{{ route('question.show', ['question' => $club->id]) }}"
                                            class="d-inline">
                                            <button class="btn btn-warning">?</button>
                                        </form>
                                    </td>
                                    <td>{{ $club->name }}</td>
                                    <td class="text-wrap" style="line-height: 20px">{{ $club->description }}</td>
                                    <td>{{ $club->faction }}</td>
                                    <td>0</td>
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
            $('#clubs-table').DataTable();
        });
    </script>


@endsection
