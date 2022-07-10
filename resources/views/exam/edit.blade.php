@extends('layout.master')

@push('plugin-styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-body">
                    <div class="w-100 d-flex justify-content-between">
                        <h4 class="card-title">Edit Data Ujian</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" value="{{ $exams->name }}" id="name" class="form-control form-control-sm" name="name"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Kelas</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" style="padding: 0 0.8rem;" name="class_id" id="class_id">
                                @foreach ($classes as $class)
                                    <option {{ $exams->class_id == $class->id ? 'selected' : '' }} value="{{ $class->id }}">
                                        {{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Aktif</label>
                        </div>
                        <div class="col-md-9">
                            {{-- <input type="text" class="form-control form-control-sm" name="name" required> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Tipe</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-check">
                                <input {{ $exams->type == 'multiple_choice' ? 'checked' : '' }} class="form-check-input" value="multiple_choice" type="radio" name="type">
                                Pilihan Ganda
                                <br>
                                <input {{ $exams->type == 'essay' ? 'checked' : '' }} class="form-check-input" value="essay" type="radio" name="type"> Isian
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mb-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Soal </th>
                                    <th> Jawaban </th>
                                    <th> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 10%;">1</td>
                                    <td style="width: 40%;">
                                        <textarea data-number="1" name="question[]" id="" rows="5" placeholder="Soal"
                                            class="form-control form-control-sm"> {{ $exams->question[0]->question }} </textarea>
                                    </td>
                                    <td style="width: 40%;">
                                        <div class="ishidden">
                                            <div class="row mb-1">
                                                <div class="col-md-1">
                                                    <label>A</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input value="{{ $exams->question[0]->multiple_choice[0]->content ?? '' }}" name="content[]" id="content_1_A" type="text"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-md-1">
                                                    <input {{ !empty($exams->question[0]->multiple_choice[0]->correct_answer) ? 'checked' : '' }} data-number="1" class="form-check-input" value=""
                                                        type="radio" name="exam_multiple_choice_item_1"
                                                        id="exam_multiple_choice_item_1_A">
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-1">
                                                    <label>B</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input value="{{ $exams->question[0]->multiple_choice[1]->content ?? '' }}" name="content[]" id="content_1_B" type="text"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-md-1">
                                                    <input {{ !empty($exams->question[0]->multiple_choice[1]->correct_answer) ? 'checked' : '' }} data-number="1" class="form-check-input" value=""
                                                        type="radio" name="exam_multiple_choice_item_1"
                                                        id="exam_multiple_choice_item_1_B">
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-1">
                                                    <label>C</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input value="{{ $exams->question[0]->multiple_choice[2]->content ?? '' }}" name="content[]" id="content_1_C" type="text"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-md-1">
                                                    <input {{ !empty($exams->question[0]->multiple_choice[2]->correct_answer) ? 'checked' : '' }} data-number="1" class="form-check-input" value=""
                                                        type="radio" name="exam_multiple_choice_item_1"
                                                        id="exam_multiple_choice_item_1_C">
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-1">
                                                    <label>D</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <input value="{{ $exams->question[0]->multiple_choice[3]->content ?? '' }}" name="content[]" id="content_1_D" type="text"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-md-1">
                                                    <input {{ !empty($exams->question[0]->multiple_choice[3]->correct_answer) ? 'checked' : '' }} data-number="1" class="form-check-input" value=""
                                                        type="radio" name="exam_multiple_choice_item_1"
                                                        id="exam_multiple_choice_item_1_D">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 10%;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between ">
                            <button id="add-row" type="button" class="btn btn-secondary btn-fw">Tambah</button>
                            <button id="btn-simpan" type="button" class="btn btn-lg btn-primary btn-fw">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
    <script>
        let lineNo = 2;
        let markup = '';
        let id = "{{ $exams->id }}";
        let url = "{{ url('exam') }}"+'/'+id;
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            if ($('input[type=radio][name=type]').value == 'multiple_choice') {
                $(".ishidden").css("visibility", "visible");
            }else{
                $(".ishidden").css("visibility", "hidden");
            }

            $('input[type=radio][name=type]').change(function() {
                if (this.value == 'multiple_choice') {
                    $(".ishidden").css("visibility", "visible");
                }
                else{
                    $(".ishidden").css("visibility", "hidden");
                }
            });



            $("#add-row").click(function() {
                markup = addMarkUp(lineNo);
                var tableBody = $("table tbody");
                tableBody.append(markup);
                lineNo++;
            });

            function addMarkUp(lineNo = 2){
                return `
                    <tr>
                        <td style="width: 10%;">1</td>
                        <td style="width: 40%;">
                            <textarea  data-number="` + lineNo + `" name="question[]" id="" rows="5" placeholder="Soal" class="form-control form-control-sm"></textarea>
                        </td>
                        <td style="width: 40%;">
                            <div class="ishidden">
                                <div class="row mb-1">
                                    <div class="col-md-1">
                                        <label>A</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="content[]" id="content_` + lineNo + `_A" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1">
                                        <input checked data-number="` + lineNo + `" class="form-check-input" value="" type="radio"
                                            name="exam_multiple_choice_item_` + lineNo +
                                            `" id="exam_multiple_choice_item_` + lineNo + `_A">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-1">
                                        <label>B</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="content[]" id="content_` + lineNo + `_B" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1">
                                        <input  data-number="` + lineNo + `" class="form-check-input" value="" type="radio"
                                            name="exam_multiple_choice_item_` + lineNo +
                                            `" id="exam_multiple_choice_item_` + lineNo + `_B">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-1">
                                        <label>C</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="content[]" id="content_` + lineNo + `_C" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1">
                                        <input  data-number="` + lineNo + `" class="form-check-input" value="" type="radio"
                                            name="exam_multiple_choice_item_` + lineNo +
                                            `" id="exam_multiple_choice_item_` + lineNo + `_C">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-1">
                                        <label>D</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input name="content[]" id="content_` + lineNo + `_D" type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1">
                                        <input  data-number="` + lineNo + `" class="form-check-input" value="" type="radio"
                                            name="exam_multiple_choice_item_` + lineNo +
                                            `" id="exam_multiple_choice_item_` + lineNo + `_D">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="width: 10%;">
                            <button type="button" class="btn-delete-tr btn btn-icons btn-rounded btn-danger">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </td>
                    </tr>
                `;
            }

            $(document).on('click', '.btn-delete-tr', function() {
                $(this).closest('tr').remove();
            });

            $("#btn-simpan").click(function() {
                let questions = $("textarea[name='question[]']")
                    .map(function() {
                        let datanumber = $(this).data('number');
                        let items = [{
                                'content': $("#content_" + datanumber + "_A").val(),
                                'correct': $("#exam_multiple_choice_item_" + datanumber + "_A").is(
                                    ':checked') ? 1 : 0
                            },
                            {
                                'content': $("#content_" + datanumber + "_B").val(),
                                'correct': $("#exam_multiple_choice_item_" + datanumber + "_B").is(
                                    ':checked') ? 1 : 0
                            },
                            {
                                'content': $("#content_" + datanumber + "_C").val(),
                                'correct': $("#exam_multiple_choice_item_" + datanumber + "_C").is(
                                    ':checked') ? 1 : 0
                            },
                            {
                                'content': $("#content_" + datanumber + "_D").val(),
                                'correct': $("#exam_multiple_choice_item_" + datanumber + "_D").is(
                                    ':checked') ? 1 : 0
                            },
                        ]
                        return {
                            'question': $(this).val(),
                            'items': items
                        }
                    }).get();
                let data = {
                    class_id: $("#class_id").val(),
                    users_id: 1,
                    name: $("#name").val(),
                    type: $("input[name=type]:checked").val(),
                    question: questions
                };
                // window.location.href = url;
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function(response) {
                        if (response == true || response == 1) {
                            window.location = "{{ url('exam') }}";
                            // console.log(response);
                            // console.log('l');
                        }
                        // console.log(response);
                        // console.log('p');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endpush
