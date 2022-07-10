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

                        <h4 class="card-title">Hasil</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Siswa </th>
                                    <th> Nilai </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exam_users as $exam_user)
                                <tr>
                                    <td> {{ $exam_user->user->name }} </td>
                                    <td> {{ $exam_user->score }} </td>
                                    <td>
                                        <a href="{{ url('exam/') . '/' . $exams->id . '/hasil' .'/'. $exam_user->id }}" class="btn-edit btn btn-primary btn-fw">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
</script>
@endpush
