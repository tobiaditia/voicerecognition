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

                        <h4 class="card-title">Tambah Data Pelajaran</h4>
                    </div>
                    <form action="{{ url('theory') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-9">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label>Judul</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="name" type="text"
                                            class=" @error('name') is-invalid @enderror form-control form-control-sm"
                                            name="name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Materi</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="content" id="content" cols="30" rows="10"
                                            class="@error('content') is-invalid @enderror form-control"></textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 border rounded p-2">
                                <h5 class="text-center">Kelas</h5>
                                @foreach ($classes as $class)
                                    <div class="form-check" style="margin-top: 0;">
                                        <input class="form-check-input" value="{{ $class->id }}" type="radio" name="class_id"
                                            id="flexRadioDefault{{ $class->id }}">
                                        <label class="form-check-label" for="flexRadioDefault{{ $class->id }}">
                                            {{ $class->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <button type="submit" class="w-100 btn btn-success mr-2">Simpan Data</button>
                            </div>
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
@endpush
