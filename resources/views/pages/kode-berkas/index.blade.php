@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Kode Berkas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Kode Berkas</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="#" type="button" onclick="add()" class="btn btn-icon btn-primary" data-toggle="modal" data-target="#kode-berkas"><i class="fas fa-plus"></i> Tambah Kode</a></h4>
                        <div class="card-header-form">
                            <form action="{{ route('kode-berkas.index') }}" method="GET">
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
                        <table class="table table-striped table-md">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama kode</th>
                                <th>kode QR</th>
                                @canany('kode-berkas-edit', 'kode-berkas-delete')
                                <th>Aksi</th>                                    
                                @endcanany
                            </tr>
                                @foreach ($kode as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->id }}</td>                                    
                                        <td>{{ $item->nama_kode }}</td>                                    
                                        <td class="text-center">{!! QrCode::size(100)->generate($item->nama_kode); !!}</td>                                    
                                        @canany('kode-berkas-edit', 'kode-berkas-delete')
                                        <td class="text-center">
                                            @can('kode-berkas-edit')                                                    
                                            <a href="#" type="button" onclick="edit({{ json_encode($item) }})" class="btn btn-icon btn-warning" data-toggle="modal" data-target="#kode-berkas"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('kode-berkas-delete')  
                                                <a href="#" type="button" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn btn-icon btn-danger" data-toggle="modal" data-target="#hapus-kode-berkas"><i class="fas fa-trash-alt"></i></a>                                            
                                            @endcan
                                        </td>
                                        @endcanany
                                    </tr>                                    
                                @endforeach
                        </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col">
                                <div class="text-left align-items-center">
                                    <span class="badge badge-info">Jumlah data : {{ $kode->total() }}</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-right">
                                    <nav class="d-inline-block">
                                        {{ $kode->links() }}                            
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

<div class="modal fade" tabindex="-1" role="dialog" id="kode-berkas">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-modal">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="nama_kode">Nama kode</label>
                    <input type="text" name="nama_kode" id="nama_kode" class="form-control" placeholder="Isikan nama kode" required>
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

@foreach ($kode as $item)
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
        $('#modal-title').text('Tambah Kode Berkas');
        $('#form-modal').trigger("reset");
        $("#store").show();
        $("#update").hide();
    }

    function edit(data) {
        $('#modal-title').text('Edit Kode Berkas');
        $('#form-modal').trigger("reset");
        $('#id').val(data.id);
        $('#nama_kode').val(data.nama_kode);
        $("#store").hide();
        $("#update").show();
    }
    
    function store()
    {
        var nama_kode = $('#nama_kode').val();
        var form_data = new FormData();
        form_data.append('_token', '{{ csrf_token() }}');
        form_data.append('nama_kode', nama_kode);
        $.ajax({
            type: "POST",
            url: "{{ route('kode-berkas.store') }}",
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
                        window.location = "{{ route('kode-berkas.index') }}"
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

    function destroy(id) {
        $.ajax({
            type: "delete",
            url: "{!! route('kode-berkas.destroy',["id"]) !!}",
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
                        window.location = "{{ route('kode-berkas.index') }}"
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
        var nama_kode = $('#nama_kode').val();
        $.ajax({
            type: "PUT",
            url: "{!! route('kode-berkas.update',["id"]) !!}",
            data: {
                '_token' : '{{ csrf_token() }}',
                'id' : id,
                'nama_kode' : nama_kode,
            },
            dataType: "json",
            success: function (data) {
                if (data["status"] == "success") {
                    iziToast.success({
                        message: data.message,
                        progressBar: false,
                    });
                    setTimeout(() => {
                        window.location = "{{ route('kode-berkas.index') }}"
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