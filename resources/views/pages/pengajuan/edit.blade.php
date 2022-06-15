@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Edit Pengajuan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ route('pengajuan-kredit.index') }}">Data Pengajuan Kredit</a></div>
            <div class="breadcrumb-item active">Edit Pengajuan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Formulir Pengajuan Kredit</h4>
            </div>
            <div class="card-body">
                @foreach ($kredit as $item)
                <form action="{{ route('pengajuan-kredit.update',[$item->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="" required value="{{ $item->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Tempat/Tanggal Lahir</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="tempat_lahir" id="" required value="{{ $item->tempat_lahir }}">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control datepicker" name="tanggal_lahir" id="date" required value="{{ $item->tanggal_lahir }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Telepon</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone" id="" required value="{{ $item->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">No.KTP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="no_ktp" id="" required value="{{ $item->no_ktp }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">NPWP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="npwp" id="" value="{{ $item->npwp }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kewarganegaraan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kewarganegaraan" id="" required value="{{ $item->kewarganegaraan }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="provinsi" id="" required value="{{ $item->provinsi }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select name="gender" id="" class="form-control">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="laki-laki" {{ $item->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ $item->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Status Perkawinan</label>
                        <div class="col-sm-9">
                            <select name="status" id="" class="form-control">
                                <option>Pilih Status Perkawinan</option>
                                <option value="menikah" {{ $item->status == 'menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="lajang" {{ $item->status == 'lajang' ? 'selected' : '' }}>Lajang</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ibu Kandung</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_ibu" id="" required value="{{ $item->nama_ibu }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Alamat Sesuai Identitas</label>
                        <div class="col-sm-9">
                            <textarea name="alamat_identitas" id="" cols="30" rows="10" class="form-control" required>{{ $item->alamat_identitas }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Alamat Terkini</label>
                        <div class="col-sm-9">
                            <textarea name="alamat_terkini" id="" cols="30" rows="10" class="form-control" required>{{ $item->alamat_terkini }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Permohonan</label>
                        <div class="col-sm-9">
                            <input type="number" name="jumlah_permohonan" id="" class="form-control" required value="{{ $item->jumlah_permohonan }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tujuan Penggunaan</label>
                        <div class="col-sm-9">
                            <input type="text" name="tujuan_penggunaan" id="" class="form-control" required value="{{ $item->tujuan_penggunaan }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan Penggunaan</label>
                        <div class="col-sm-9">
                            <textarea name="ket_penggunaan" id="" class="form-control" cols="30" rows="10">{{ $item->ket_penggunaan }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jangka waktu</label>
                        <div class="col-sm-9">
                            <input type="text" name="jangka_waktu" id="" class="form-control" required value="{{ $item->jangka_waktu }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jaminan Kredit</label>
                        <div class="col-sm-9">
                            <textarea name="jaminan_kredit" class="form-control" id="" cols="30" rows="10">{{ $item->jaminan_kredit }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Posisi Jaminan</label>
                        <div class="col-sm-9">
                            <select name="posisi_jaminan" class="form-control" id="">
                                <option>Pilih Posisi Jaminan</option>
                                <option value="sedang dijaminkan" {{ $item->posisi_jaminan == 'sedang dijaminkan' ? 'selected' : '' }}>sedang dijaminkan</option>
                                <option value="tidak sedang dijaminkan" {{ $item->posisi_jaminan == 'tidak sedang dijaminkan' ? 'selected' : '' }}>tidak sedang dijaminkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Status Jaminan</label>
                        <div class="col-sm-9">
                            <select name="status_jaminan" class="form-control" id="">
                                <option>Pilih Status Jaminan</option>
                                <option value="milik keluarga" {{ $item->status_jaminan == 'milik keluarga' ? 'selected' : '' }}>milik keluarga</option>
                                <option value="milik sendiri" {{ $item->status_jaminan == 'milik sendiri' ? 'selected' : '' }}>milik sendiri</option>
                                <option value="milik orang lain" {{ $item->status_jaminan == 'milik orang lain' ? 'selected' : '' }}>milik orang lain</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered text-center table-responsive">
                        <thead>
                            <tr>
                                <th>Berkas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->berkas as $item)
                            <tr>
                                <td>Nama file dalam server: {{ $item->file_name }}</td>
                                <td>
                                    <a href="{{ asset('berkas/'.$item->file_name) }}" class="btn btn-icon btn-primary"><i class="fas fa-file-download"></i> Download</a>
                                    <a href="#" type="button" data-toggle="modal" data-target="#modal-hapus{{ $item->id }}" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="form-group">
                        <label for="berkas">Upload Berkas Jaminan</label>
                        <table class="table" id="dynamic-field">
                            <tbody>
                                <tr>
                                    <td class="px-0" width="85%"><input type="file" name="berkas[]" id="" class="form-control"></td>
                                    <td><button class="btn btn-icon btn-success" id="add-field"><i class="fas fa-plus"></i></button></td>
                                </tr>
                            </tbody>
                        </table>                        
                    </div>
                    <div class="text-right">
                        <button class="btn btn-lg btn-icon icon-left btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</section>
</div> 
@foreach ($kredit as $item)
    @foreach ($item->berkas as $item)
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
                <input type="hidden" name="" id="file_name{{ $item->id }}" value="{{ $item->file_name }}">
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="destroy({{ $item->id }})" id="destroy" class="btn btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>
    @endforeach
@endforeach
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    var i=1;
    $('#add-field').on('click', function(e) {
        e.preventDefault();
        i++;
        $('#dynamic-field').append('<tr id="row'+i+'">'+
                                    '<td class="px-0"><input type="file" class="form-control" id="images'+i+'" name="berkas[]"></td>'+
                                    '<td><button type="button" class="btn btn-icon btn-danger btn-remove" id="'+i+'"><i class="fas fa-trash"></i></button></td>'+
                                '</tr>');
        iziToast.success({
            message: 'Field berhasil ditambahkan!',
            position: 'topRight'
        });
    });
    $(document).on('click', '.btn-remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove(); 
        iziToast.success({
            message: 'Field berhasil dihapus!',
            position: 'topRight'
        });
    });

    $(function () {
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    function destroy(id) {
        var file_name = $('#file_name'+id).val();
        $.ajax({
            type: "delete",
            url: "{!! route('berkas.destroy',["id"]) !!}",
            data: {
                '_token' : '{{ csrf_token() }}',
                _method: 'DELETE',
                id: id,
                file_name: file_name,
            },
            dataType: "json",
            success: function (data) {
                if (data["status"] == "success") {
                    iziToast.success({
                        message: data.message,
                        progressBar: false,
                    });
                    setTimeout(() => {
                        window.location.reload()
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