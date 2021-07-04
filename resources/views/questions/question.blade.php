@extends('layouts.app')
@section('title', 'Questions')
@section('content')

    <!-- Modal -->
    <form class="modal fade" id="addquestions" tabindex="-1" aria-labelledby="addquestions" aria-hidden="true"
        action="{{ route('question.store') }}" method="POST">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addquestions">เพิ่มผู้ใช้</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body form-sample">
                    @csrf
                    <input hidden type="text" class="form-control" name="club_id" value="{{ $club_id }}">

                    <div class="form-group">
                        <label>คำถาม</label>
                        <input type="text" class="form-control" name="question" required>
                    </div>
                    <div class="form-group">
                        <label>คำตอบ 1</label>
                        <input type="text" class="form-control" name="answers[]">
                    </div>
                    <div class="form-group">
                        <label>คำตอบ 2</label>
                        <input type="text" class="form-control" name="answers[]">
                    </div>
                    <div class="form-group">
                        <label>คำตอบ 3</label>
                        <input type="text" class="form-control" name="answers[]">
                    </div>
                    <div class="form-group">
                        <label>คำตอบ 4</label>
                        <input type="text" class="form-control" name="answers[]">
                    </div>
                    <div class="form-group">
                        <label>คำตอบที่ถูกต้อง (*ระวังช่องว่าง)</label>
                        <input type="text" class="form-control" name="answer">
                    </div>


                    <small class="text-danger">*หมายเหตุ ระบบจะทำการสลับคำตอบและรายการคำถามให้อัตโนมัติ</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทีก</button>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 bg-white">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn btn-inverse-success my-3" data-toggle="modal"
                            data-target="#addquestions">เพิ่มคำถาม <i class="mdi mdi-plus"></i></button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="questions-table">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th> คำถาม </th>
                                <th> คำตอบ 1 </th>
                                <th> คำตอบ 2 </th>
                                <th> คำตอบ 3 </th>
                                <th> คำตอบ 4 </th>
                                <th> ที่ถูกต้อง </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($questions as $idx => $question)

                                <tr>
                                    <td class="text-center">

                                        <form method="POST"
                                            action="{{ route('question.destroy', ['question' => $question['id']]) }}"
                                            class="form-delete-{{ $idx }} d-inline" onsubmit="delete($idx)">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-delete" value="{{ $idx }}"
                                                type="button"><i class="mdi mdi-delete"></i></button>
                                        </form>
                                        <form method="GET"
                                            action="{{ route('question.edit', ['question' => $question['id']]) }}"
                                            class="d-inline">

                                            <button class="btn btn-warning"><i class="mdi mdi-lead-pencil"></i></button>
                                        </form>

                                    </td>
                                    <td>{{ $question['question'] }}</td>
                                    @foreach ($question['answers'] as $ida => $answer)
                                        <td> {{ $answer['answer'] }}</td>
                                    @endforeach
                                    <td>{{ $question['answer'] }}</td>
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
        $(document).ready(function() {
            $('#questions-table').DataTable();
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
