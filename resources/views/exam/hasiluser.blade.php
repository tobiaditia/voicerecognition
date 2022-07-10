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
                    <form action="{{ url('examuserdetail') }}" method="POST">
                        @method('CSRF')
                        <div class="w-100 d-flex justify-content-between">

                            <h4 class="card-title">Hasil</h4>
                            <button type="submit" class="btn btn-success btn-fw">Simpan</button>
                        </div>
                        <div class="table-responsive mb-2 w-50">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ $exam_users->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nilai</td>
                                        <td>:</td>
                                        <td>{{ $exam_users->score }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tipe</td>
                                        <td>:</td>
                                        <td>{{ $exams->type }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> Pertanyaan </th>
                                        <th> Jawaban </th>
                                        <th> Benar/Salah </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam_user_details as $exam_user_detail)
                                    <tr>
                                        <td> {{ $exam_user_detail->question->question }} </td>
                                        <td> {{ $exam_user_detail->answer }} </td>
                                        <td> {{ $exam_user_detail->correct }}
                                            <div class="form-check" style="margin-top: 0;">
                                                <input class="form-check-input" value="1" type="radio" name=""
                                                    id="flexRadioDefault1_{{ $exam_user_detail->id }}">
                                                <label class="form-check-label" for="flexRadioDefault1_{{ $exam_user_detail->id }}">
                                                    Benar
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-top: 0;">
                                                <input checked class="form-check-input" value="0" type="radio" name=""
                                                    id="flexRadioDefault0_{{ $exam_user_detail->id }}">
                                                <label class="form-check-label" for="flexRadioDefault0_{{ $exam_user_detail->id }}">
                                                    Salah
                                                </label>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
<script>
</script>
@endpush
