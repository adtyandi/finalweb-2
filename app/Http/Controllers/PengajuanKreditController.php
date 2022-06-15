<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\KodeBerkas;
use Illuminate\Http\Request;
use App\Models\Kredit;
use App\Models\ProgresKredit;
use Illuminate\Support\Facades\Auth;

class PengajuanKreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari = $request->cari;
        if (!empty($cari)) {
            $kredit = Kredit::where('name', 'LIKE', "%$cari%")->orderBy('id', 'DESC')->paginate(5);
        } else {
            $kredit = Kredit::orderBy('id', 'DESC')->paginate(5);
        }
        $kode_berkas = KodeBerkas::all();
        return view('pages.pengajuan.index', compact('kredit', 'kode_berkas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'phone' => 'required',
            'no_ktp' => 'required',
            'npwp' => 'required',
            'kewarganegaraan' => 'required',
            'provinsi' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'nama_ibu' => 'required',
            'alamat_identitas' => 'required',
            'alamat_terkini' => 'required',
            'jumlah_permohonan' => 'required',
            'tujuan_penggunaan' => 'required',
            'ket_penggunaan' => 'required',
            'jangka_waktu' => 'required',
            'jaminan_kredit' => 'required',
            'posisi_jaminan' => 'required',
            'status_jaminan' => 'required',
            'berkas.*' => 'required|mimes:png,pdf,jpg,jpeg|max:3000',
        ]);
        $kredit = new Kredit();
        $kredit->name = $request->name;
        $kredit->tempat_lahir = $request->tempat_lahir;
        $kredit->tanggal_lahir = $request->tanggal_lahir;
        $kredit->phone = $request->phone;
        $kredit->no_ktp = $request->no_ktp;
        $kredit->npwp = $request->npwp;
        $kredit->kewarganegaraan = $request->kewarganegaraan;
        $kredit->provinsi = $request->provinsi;
        $kredit->gender = $request->gender;
        $kredit->status = $request->status;
        $kredit->nama_ibu = $request->nama_ibu;
        $kredit->alamat_identitas = $request->alamat_identitas;
        $kredit->alamat_terkini = $request->alamat_terkini;
        $kredit->jumlah_permohonan = $request->jumlah_permohonan;
        $kredit->tujuan_penggunaan = $request->tujuan_penggunaan;
        $kredit->ket_penggunaan = $request->ket_penggunaan;
        $kredit->jangka_waktu = $request->jangka_waktu;
        $kredit->jaminan_kredit = $request->jaminan_kredit;
        $kredit->posisi_jaminan = $request->posisi_jaminan;
        $kredit->status_jaminan = $request->status_jaminan;
        $kredit->save();

        $kredit_first = Kredit::latest()->first();
        $i = 0;
        foreach ($request->berkas as $item) {
            $berkas = new Berkas();
            $file = $item;
            //name file
            $filename = $file->getClientOriginalName();
            $a = explode(".", $filename);
            $fileExt = strtolower(end($a));
            $namaFile = substr(md5(date("YmdHis")), 0, 10) . $i . "." . $fileExt;

            //penyimpanan
            $destination_path = public_path() . '/berkas/';

            // simpan ke folder
            $item->move($destination_path, $namaFile);
            // simpan database
            $berkas->kredit_id = $kredit_first->id;
            $berkas->file_name = $namaFile;
            $berkas->save();
            $i++;
        }

        $progres = new ProgresKredit();
        $progres->kredit_id = $kredit_first->id;
        $progres->status_pengajuan = 'Pengajuan baru';
        $progres->komentar = 'Mohon tunggu proses verifikasi petugas.';
        $progres->users_id = Auth::user()->id;
        $progres->save();

        return redirect()->route('pengajuan-kredit.create')->with('success', 'Pengajuan Kredit Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kredit = Kredit::where('id', $id)->with('berkas')->get();
        return view('pages.pengajuan.edit', compact('kredit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'phone' => 'required',
            'no_ktp' => 'required',
            'npwp' => 'required',
            'kewarganegaraan' => 'required',
            'provinsi' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'nama_ibu' => 'required',
            'alamat_identitas' => 'required',
            'alamat_terkini' => 'required',
            'jumlah_permohonan' => 'required',
            'tujuan_penggunaan' => 'required',
            'ket_penggunaan' => 'required',
            'jangka_waktu' => 'required',
            'jaminan_kredit' => 'required',
            'posisi_jaminan' => 'required',
            'status_jaminan' => 'required',
        ]);

        $kredit = Kredit::findOrFail($request->id);
        $kredit->name = $request->name;
        $kredit->tempat_lahir = $request->tempat_lahir;
        $kredit->tanggal_lahir = $request->tanggal_lahir;
        $kredit->phone = $request->phone;
        $kredit->no_ktp = $request->no_ktp;
        $kredit->npwp = $request->npwp;
        $kredit->kewarganegaraan = $request->kewarganegaraan;
        $kredit->provinsi = $request->provinsi;
        $kredit->gender = $request->gender;
        $kredit->status = $request->status;
        $kredit->nama_ibu = $request->nama_ibu;
        $kredit->alamat_identitas = $request->alamat_identitas;
        $kredit->alamat_terkini = $request->alamat_terkini;
        $kredit->jumlah_permohonan = $request->jumlah_permohonan;
        $kredit->tujuan_penggunaan = $request->tujuan_penggunaan;
        $kredit->ket_penggunaan = $request->ket_penggunaan;
        $kredit->jangka_waktu = $request->jangka_waktu;
        $kredit->jaminan_kredit = $request->jaminan_kredit;
        $kredit->posisi_jaminan = $request->posisi_jaminan;
        $kredit->status_jaminan = $request->status_jaminan;
        $kredit->update();

        $i = 0;
        if (!empty($request->berkas)) {
            foreach ($request->berkas as $item) {
                $berkas = new Berkas();
                $file = $item;
                //name file
                $filename = $file->getClientOriginalName();
                $a = explode(".", $filename);
                $fileExt = strtolower(end($a));
                $namaFile = substr(md5(date("YmdHis")), 0, 10) . $i . "." . $fileExt;

                //penyimpanan
                $destination_path = public_path() . '/berkas/';

                // simpan ke folder
                $item->move($destination_path, $namaFile);
                // simpan database
                $berkas->kredit_id = $request->id;
                $berkas->file_name = $namaFile;
                $berkas->save();
                $i++;
            }
        }
        return redirect()->route('pengajuan-kredit.index')->with('success', 'Pengajuan Kredit Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data_berkas = Kredit::with('berkas')->where('id', $id)->get();
        foreach ($data_berkas[0]->berkas as $key) {
            unlink(public_path('berkas/' . $key->file_name));
        }
        Kredit::where('id', $id)->delete();
        return response()->json(["status" => "success", "message" => 'Pengajuan Kredit Berhasil dihapus!'], 200);
    }

    public function verifikasi(Request $request)
    {
        $cari = $request->cari;
        if (!empty($cari)) {
            $kredit = Kredit::where('name', 'LIKE', "%$cari%")->orderBy('id', 'DESC')->paginate(5);
        } else {
            $kredit = Kredit::orderBy('id', 'DESC')->paginate(5);
        }
        return view('pages.pengajuan.verifikasi', compact('kredit'));
    }

    public function berkas_destroy(Request $request)
    {
        $id = $request->id;
        $file_name = $request->file_name;
        unlink(public_path('berkas/' . $file_name));
        Berkas::where('id', $id)->delete();
        return response()->json(["status" => "success", "message" => 'Berkas Berhasil dihapus!'], 200);
    }

    public function update_qrcode(Request $request)
    {
        $id = $request->id;
        $kode_qr = $request->kode_qr;
        $kredit = Kredit::findOrFail($id);
        $kredit->kode_qr = $kode_qr;
        $kredit->update();
        return response()->json(["status" => "success", "message" => 'Kode Berkas Berhasil diubah!'], 200);
    }

    public function verifikasi_store(Request $request)
    {
        $id = $request->id;
        $status_pengajuan = $request->status_pengajuan;
        $komentar = $request->komentar;
        $users_id = $request->users_id;

        $progres = new ProgresKredit();
        $progres->kredit_id = $id;
        $progres->status_pengajuan = $status_pengajuan;
        $progres->komentar = $komentar;
        $progres->users_id = $users_id;
        $progres->save();
        return response()->json(["status" => "success", "message" => 'Pengajuan berhasil diverifikasi!'], 200);
    }
}
