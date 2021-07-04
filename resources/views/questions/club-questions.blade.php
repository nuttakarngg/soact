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
                                <th>สถานะ</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clubs as $idx => $club)
                                <tr>
                                    <td class="text-center">
                                        <form method="GET"
                                            action="{{ route('question.show', ['question' => $club->id]) }}"
                                            class="d-inline">
                                            <button class="btn btn-warning">?</button>
                                        </form>

                                    </td>
                                    <td>{{ $club->name }}</td>
                                    <td class="text-wrap" style="line-height: 20px">{{ $club->description }}</td>
                                    <td>{{ $club->faction }}</td>
                                    <td>{{ App\Models\Feedback::Where('club_id', $club->id)->selectRaw('count(DISTINCT(student_id)) as answered')->first()->answered }}
                                    </td>
                                    <td class="text-center">
                                        <form class="custom-control custom-switch" action="{{route('clubs.update',$club->id)}}" method="POST" id="club_{{$club->id}}">
                                            @method('PUT')
                                            @csrf
                                            <input type="checkbox" class="custom-control-input" name="open"
                                                id="switch_{{ $club->id }}" {{$club->open?'checked':''}} onchange="update(event,'club_{{$club->id}}',this)">
                                                <input type="text" name="refresh" value="123" hidden>
                                            <label class="custom-control-label" for="switch_{{ $club->id }}"></label>
                                        </form>
                                    </td>
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
        function update(e,id,t){

        t.value = e.target.checked;
        $(`#${id}`).submit();
        }
    </script>


@endsection
