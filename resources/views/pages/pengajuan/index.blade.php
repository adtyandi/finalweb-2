@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Data Pengajuan Kredit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Data Pengajuan Kredit</div>
        </div>
    </div>

    <div class="section-body">
        @if (session()->has('success'))
        <div class="alert alert-success alert-has-icon alert-dismissible">
            <div class="alert-icon"><i class="far fa-smile-wink"></i></div>
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <div class="alert-title">Success</div>
                {{ session()->get('success') }}
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="{{ route('pengajuan-kredit.create') }}" class="btn btn-icon btn-primary"><i class="fas fa-plus"></i> Tambah Pengajuan</a></h4>
                        <div class="card-header-form">
                            <form action="{{ route('pengajuan-kredit.index') }}" method="GET">
                                <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="Cari pengajuan...">
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
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Pemohon</th>
                                    <th>Nominal</th>
                                    <th>Jaminan</th>
                                    <th>kode Berkas</th>
                                    @canany('pengajuan-kredit-edit', 'pengajuan-kredit-delete', 'pengajuan-kredit-validasi')
                                    <th>Aksi</th>                                    
                                    @endcanany
                                </tr>
                            </thead>   
                            <tbody>
                                @foreach ($kredit as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td><h6>{{ $item->name }}</h6></td>
                                        <td class="text-center">{{ $item->jumlah_permohonan }}</td>
                                        <td>{{ $item->jaminan_kredit }}</td>
                                        <td class="text-center">
                                            @if (!empty($item->kode_qr))
                                                {!! QrCode::size(100)->generate($item->kode_qr); !!}
                                                <br>
                                                <span class="badge badge-info mt-2">{{ $item->kode_qr }}</span>
                                            @else
                                                <h5><span class="badge badge-warning">Kode berkas belum ditambahkan!</span></h5>
                                            @endif
                                        </td>
                                        @canany('pengajuan-kredit-edit', 'pengajuan-kredit-delete', 'pengajuan-kredit-qrcode')
                                        <td class="text-center">
                                            <a href="#" type="button" data-toggle="modal" data-target="#modal-progress{{ $item->id }}" class="btn btn-icon btn-primary"><i class="fas fa-chart-line"></i></a>
                                            {{-- @can('pengajuan-kredit-qrcode')                                                     --}}
                                                <a href="#" type="button" data-toggle="modal" data-target="#modal-qrcode{{ $item->id }}" class="btn btn-icon btn-info"><i class="fas fa-qrcode"></i></a>
                                            {{-- @endcan --}}
                                            @can('pengajuan-kredit-edit')                                                    
                                                <a href="{{ route('pengajuan-kredit.edit',[$item->id]) }}" class="btn btn-icon btn-warning"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('pengajuan-kredit-delete')  
                                                <a href="#" type="button" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></a>                                            
                                            @endcan
                                        </td>
                                        @endcanany
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
                                    <span class="badge badge-info">Jumlah data : {{ $kredit->total() }}</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-right">
                                    <nav class="d-inline-block">
                                        {{ $kredit->links() }}                            
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

@foreach ($kredit as $item)
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
            <button type="button" class="btn btn-danger" onclick="destroy({{ $item->id }})">Delete</button>
        </div>
        </div>
    </div>
</div>
@endforeach
@foreach ($kredit as $key)
<div class="modal fade" tabindex="-1" role="dialog" id="modal-qrcode{{ $key->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5>Ubah Kode Berkas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" name="id" id="id_kredit" value="{{ $key->id }}">
                <div class="form-group">
                    <label for="qrcode">Kode Berkas</label>
                    <select name="kode_qr" id="kode_qr{{ $key->id }}" class="form-control">
                        <option>Pilih Kode Berkas</option>
                        @foreach ($kode_berkas as $item)
                            <option value="{{ $item->nama_kode }}">{{ $item->nama_kode }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="update_qrcode({{ $key->id }})">Save</button>
        </div>
        </div>
    </div>
</div>
@endforeach
@foreach ($kredit as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="modal-progress{{ $item->id }}">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="activities">
                    @foreach ($item->progres_pengajuan as $key)
                        <div class="activity">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                <i class="fas fa-comment-alt"></i>
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="text-job text-primary">{{ $key->created_at }}</span>
                                    <span class="bullet"></span>
                                    <a class="text-job">{{ $key->status_pengajuan }} - {{ $key->users->name }}</a>
                                    <p>{{ $key->komentar }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')
<script>
    function destroy(id) {
        $.ajax({
            type: "DELETE",
            url: "pengajuan-kredit/"+id,
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
                        window.location = "{{ route('pengajuan-kredit.index') }}"
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

    function update_qrcode(id) {
        var kode_qr = $('#kode_qr'+id).val();
        $.ajax({
            type: "PUT",
            url: "{!! route('pengajuan-kredit.qrcode',["id"]) !!}",
            data: {
                '_token' : '{{ csrf_token() }}',
                _method: 'PUT',
                id: id,
                kode_qr: kode_qr,
            },
            dataType: "json",
            success: function (data) {
                if (data["status"] == "success") {
                    iziToast.success({
                        message: data.message,
                        progressBar: false,
                    });
                    setTimeout(() => {
                        window.location = "{{ route('pengajuan-kredit.index') }}"
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