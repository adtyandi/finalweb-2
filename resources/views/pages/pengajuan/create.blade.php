@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Buat Pengajuan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active">Buat Pengajuan</div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            {{ session()->get('success') }}
        </div>
    </div>
    @endif

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Formulir Pengajuan Kredit</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pengajuan-kredit.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Tempat/Tanggal Lahir</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="tempat_lahir" id="" required>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control datepicker" name="tanggal_lahir" id="date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Telepon</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">No.KTP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="no_ktp" id="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">NPWP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="npwp" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kewarganegaraan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kewarganegaraan" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="provinsi" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select name="gender" id="" class="form-control">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Status Perkawinan</label>
                        <div class="col-sm-9">
                            <select name="status" id="" class="form-control">
                                <option>Pilih Status Perkawinan</option>
                                <option value="menikah">Menikah</option>
                                <option value="lajang">Lajang</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ibu Kandung</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_ibu" id="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Alamat Sesuai Identitas</label>
                        <div class="col-sm-9">
                            <textarea name="alamat_identitas" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Alamat Terkini</label>
                        <div class="col-sm-9">
                            <textarea name="alamat_terkini" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Permohonan</label>
                        <div class="col-sm-9">
                            <input type="text" name="jumlah_permohonan" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tujuan Penggunaan</label>
                        <div class="col-sm-9">
                            <input type="text" name="tujuan_penggunaan" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan Penggunaan</label>
                        <div class="col-sm-9">
                            <textarea name="ket_penggunaan" id="" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jangka waktu</label>
                        <div class="col-sm-9">
                            <input type="text" name="jangka_waktu" id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jaminan Kredit</label>
                        <div class="col-sm-9">
                            <textarea name="jaminan_kredit" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Posisi Jaminan</label>
                        <div class="col-sm-9">
                            <select name="posisi_jaminan" class="form-control" id="">
                                <option>Pilih Posisi Jaminan</option>
                                <option value="sedang dijaminkan">sedang dijaminkan</option>
                                <option value="tidak sedang dijaminkan">tidak sedang dijaminkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Status Jaminan</label>
                        <div class="col-sm-9">
                            <select name="status_jaminan" class="form-control" id="">
                                <option>Pilih Status Jaminan</option>
                                <option value="milik keluarga">milik keluarga</option>
                                <option value="milik sendiri">milik sendiri</option>
                                <option value="milik orang lain">milik orang lain</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="alert alert-info alert-has-icon">
                        <div class="alert-icon"><i class="far fa-file-alt"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Perhatian!</div>
                            <ul>
                                <li>Harap upload berkas dengan format file: png, pdf, jpg, jpeg.</li>
                                <li>Batas maksimum ukuran file adalah 3 MB.</li>
                            </ul>
                        </div>
                    </div>
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
            </div>
        </div>
    </div>
</section>
</div> 
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
</script>
@endsection