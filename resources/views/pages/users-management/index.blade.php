@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Manajemen Team</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Manajemen Team</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="#" type="button" onclick="add()" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#manajemen-pengguna"><i class="fas fa-plus"></i> Tambah Anggota</a></h4>
                        <div class="card-header-form">
                            <form action="{{ route('manajemen-pengguna.index') }}" method="GET">
                                <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari nama kode..">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-md text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Aksi</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengguna as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>                                           
                                        <td>
                                            <a href="#" type="button" onclick="edit({{ json_encode($item) }})" class="btn btn-icon btn-warning" data-toggle="modal" data-target="#manajemen-pengguna"><i class="fas fa-edit"></i></a>
                                            <a href="#" type="button" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#hapus-kode-berkas"><i class="fas fa-trash-alt"></i></a>                                            
                                        </td>                                   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <div class="text-left align-items-center">
                                    <span class="badge badge-info">Jumlah data : {{ $pengguna->total() }}</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-right">
                                    <nav class="d-inline-block">
                                        {{ $pengguna->links() }}                            
                                    </nav>
                                </div>
                            </div> 
                        </div>                        
                    </div>
                    </div>
            </div>
        </div>
    </div>
</section>
</div>    

<div class="modal fade" tabindex="-1" role="dialog" id="manajemen-pengguna">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="modal_form">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Lengkap</label>
                    <input class="form-control" type="text" name="name" id="name" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Pengguna</label>
                    <input class="form-control" type="text" name="username" id="username" placeholder="Nama Pengguna" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email Pengguna">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Biodata</label>
                    <textarea name="biodata" id="biodata" class="form-control" cols="30" rows="30"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Role</label>
                    <select name="roles" id="roles" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="nasabah">Nasabah</option>
                    </select>
                </div>
                <div class="form-group" id="form-password">
                    <label for="exampleFormControlInput1">Password</label>
                    <input class="form-control" type="password" id="password" placeholder="Password Pengguna" required>
                </div>
            </form>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="store()" id="store" class="btn btn-primary">Save</button>
            <button type="button" onclick="update()" id="update" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>

@foreach ($pengguna as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="modal-hapus{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h5 class="text-center">Apakah anda yakin?</h5>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" onclick="destroy({{ $item->id }})" id="destroy" class="btn btn-danger">Delete</button>
        </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')
<script>
    function add() {
        $('#exampleModalLabel').text('Tambah Pengguna');
        $('#modal_form').trigger("reset");
        $("#store").show();
        $("#form-password").show();
        $("#update").hide();
    }

    function edit(data) {
        $('#exampleModalLabel').text('Edit Pengguna');
        $('#modal_form').trigger("reset");
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#username').val(data.username);
        $('#email').val(data.email);
        $('#roles').val(data.roles.name);
        // $('#password').val(data.password);
        $("#store").hide();
        $("#form-password").hide();
        $("#update").show();
    }

    function store() {
        var name = $('#name').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var roles = $("#roles").val();
        var password = $('#password').val();
        var biodata = $('#biodata').val();
        var form_data = new FormData();
        // form_data.append('_token', '{{ csrf_token() }}');
        form_data.append('name', name);
        form_data.append('username', username);
        form_data.append('email', email);
        form_data.append('biodata', biodata);
        // form_data.append('roles', roles);
        form_data.append('password', password);
        $.ajax({
            type: "POST",
            url: "{!! route('manajemen-pengguna.store') !!}",
            data: form_data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data["status"] == "success") {
                    iziToast.success({
                        message: data.message,
                        progressBar: false,
                    });
                    setTimeout(() => {
                        window.location = "{{ route('manajemen-pengguna.index') }}"
                    }, 1000);
                } else {
                    iziToast.warning({
                        message: data.message,
                        position: 'bottomRight',
                    });
                }
            }, error: function(error) {
                console.log(error);
                iziToast.error({
                    title: 'Upss..',
                    message: error,
                    position: 'bottomRight',
                });
            }
        });            
    }

    function destroy(id) {
        $.ajax({
            type: "delete",
            url: "{!! route('manajemen-pengguna.destroy',["id"]) !!}",
            data: {
                '_token' : '{{ csrf_token() }}',
                _method: 'DELETE',
                id: id,
            },
            dataType: "json",
            success: function (data) {
                if (data["status"] == "success") {
                    iziToast.success({
                        message: data.message,
                        progressBar: false,
                    });
                    setTimeout(() => {
                        window.location = "{{ route('manajemen-pengguna.index') }}"
                    }, 1000);
                } else {
                    iziToast.warning({
                        message: data.message,
                        position: 'bottomRight',
                    });
                }
            }, error: function(error) {
                iziToast.error({
                    title: 'Upss..',
                    message: 'Ada yang tidak beres!',
                    position: 'bottomRight',
                });
            }
        });
    }

    function update() {
        var id = $('#id').val();
        var name = $('#name').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var roles = $("#roles").val();
        var password = $('#password').val();
        $.ajax({
            type: "put",
            url: "{!! route('manajemen-pengguna.update',["id"]) !!}",
            data: {
                '_token' : '{{ csrf_token() }}',
                'id' : id,
                'name' : name,
                'username' : username,
                'email' : email,
                'roles' : roles,
                'password' : password,
            },
            dataType: "json",
            success: function (data) {
                if (data["status"] == "success") {
                    iziToast.success({
                        message: data.message,
                        progressBar: false,
                    });
                    setTimeout(() => {
                        window.location = "{{ route('manajemen-pengguna.index') }}"
                    }, 1000);
                } else {
                    iziToast.warning({
                        message: data.message,
                        position: 'bottomRight',
                    });
                }
            }, error: function(error) {
                iziToast.error({
                    title: 'Upss..',
                    message: 'Ada yang tidak beres!',
                    position: 'bottomRight',
                });
            }
        });
    }
</script>
@endsection