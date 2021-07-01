@extends('layouts.app')
@section('title', 'Questions (Edit)')
@section('content')
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('question.update', ['question' => $question['id']]) }}" id="update">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>คำถาม</label>
                        <input type="text" class="form-control" value="{{ $question['question'] }}" name="question"
                            required>
                    </div>
                    @foreach ($question['answers'] as $idx => $answer_item)
                        <div class="form-group">
                            <div class="form-group">
                                <label>คำตอบ 1</label>
                                <input type="text" class="form-control" value="{{ $answer_item['answer'] }}"
                                    name="answers[]">
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label>คำตอบที่ถูกต้อง (*ระวังช่องว่าง)</label>
                        <input type="text" class="form-control" value="{{ $question['answer'] }}" name="answer">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary px-3" type="button" id="save">บันทึก</button>
                            <a href="{{ route('question.show',['question'=>$question['club_id']]) }}">กลับไปก่อนหน้า</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#save').on('click', async function(e) {
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
                console.log($(`#update`).submit())
            }
        })
    </script>
@endsection
