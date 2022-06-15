@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Verifikasi Pengajuan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Verifikasi Pengajuan</div>
        </div>
    </div>

    <div class="section-body">
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
                                    @can('pengajuan-kredit-verifikasi')
                                    <th>Aksi</th>                                    
                                    @endcan
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
                                            <a href="#" type="button"data-toggle="modal" data-target="#modal-verifikasi{{ $item->id }}" class="btn btn-icon btn-primary"><i class="fas fa-user-check"></i> Verifikasi</a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modal-verifikasi{{ $item->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5>Verifikasi Pengajuan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="form-group">
                    <label for="status_pengajuan">Status Pengajuan</label>
                    <select name="status_pengajuan" id="status_pengajuan{{ $item->id }}" class="form-control">
                        <option>Pilih Status Pengajuan</option>
                        <option value="disetujui">Setuju</option>
                        <option value="disetujui">Tolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="komentar">Komentar</label>
                    <textarea name="komentar" id="komentar{{ $item->id }}" cols="30" rows="10" class="form-control" placeholder="Mohon isikan komentar..."></textarea>
                </div>
            </form>
            <input type="hidden" name="users_id" id="users_id{{ $item->id }}" value="{{ Auth::user()->id }}">
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="verify({{ $item->id }})">Verify</button>
        </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('script')
<script>
    function verify(id) {
        var status_pengajuan = $('#status_pengajuan'+id).val();
        var komentar = $('#komentar'+id).val();
        var users_id = $('#users_id'+id).val();
        var form_data = new FormData();
        form_data.append('_token', '{{ csrf_token() }}');
        form_data.append('id', id);
        form_data.append('status_pengajuan', status_pengajuan);
        form_data.append('komentar', komentar);
        form_data.append('users_id', users_id);
        $.ajax({
            type: "POST",
            url: "{{ route('verifikasi.store') }}",
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
                        window.location = "{{ route('pengajuan-kredit.verifikasi') }}"
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