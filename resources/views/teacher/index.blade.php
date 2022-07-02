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

                        <h4 class="card-title">Data Guru</h4>
                        <button type="button" class="btn btn-success btn-fw" data-toggle="modal"
                            data-target="#add">Tambah</button>
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
                                @foreach ($teachers as $teacher)
                                <tr>
                                    <td> {{ $teacher->name }} </td>
                                    <td>
                                        <button type="button" data-id="{{ $teacher->id }}" data-toggle="modal" data-target="#edit" class="btn-edit btn btn-primary btn-fw">Edit</button>
                                        <button type="button" class="btn btn-danger btn-fw">Hapus</button>
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

    <div class="modal fade" id="add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah guru</h4>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ url('teacher'); }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Username</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class=" @error('username') is-invalid @enderror form-control form-control-sm" name="username" required>
                                    @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class=" @error('password') is-invalid @enderror form-control form-control-sm" name="password" required>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Simpan Data</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit guru</h4>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{ url('teacher/edit'); }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="idEdit">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nama</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="nameEdit" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Username</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="usernameEdit" type="text" class=" @error('username') is-invalid @enderror form-control form-control-sm" name="username" required>
                                    @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class=" @error('password') is-invalid @enderror form-control form-control-sm" name="password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Simpan Data</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        let url = "{{ url('teacher') }}" + "/"+id+"/edit";
        $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
            success: function(data) {
				$('#idEdit').val(data.id);
				$('#nameEdit').val(data.name);
				$('#usernameEdit').val(data.username);
            }
        });
    });
</script>
@endpush
