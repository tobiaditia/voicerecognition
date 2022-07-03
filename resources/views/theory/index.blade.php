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

                        <h4 class="card-title">Data Pelajaran</h4>
                        <a class="btn btn-success btn-fw" href="{{ url('theory/add') }}">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Nama </th>
                                    <th> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($theorys as $theory)
                                <tr>
                                    <td> {{ $theory->name }} </td>
                                    <td>
                                        <a href="{{ url('theory'.'/'.$theory->id.'/edit') }}" class="btn-edit btn btn-primary btn-fw">Edit</a>
                                        <form class="d-inline" action="{{ url('theory').'/'.$theory->id }}" method="POST"
                                            onclick="return confirm('Apakah Anda yakin menghapus data ini ?')">
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-fw">Hapus</button>
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
    </div>

@endsection

@push('plugin-scripts')
@endpush

@push('custom-scripts')
@endpush
