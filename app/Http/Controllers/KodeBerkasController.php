<?php

namespace App\Http\Controllers;

use App\Models\KodeBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KodeBerkasController extends Controller
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
            $kode = KodeBerkas::where('nama_kode', 'LIKE', "%$cari%")->paginate(2);
        } else {
            $kode = KodeBerkas::paginate(2);
        }
        return view('pages.kode-berkas.index', compact('kode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nama_kode' => 'required|unique:kode_berkas',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response()->json(["status" => "error", "message" => $errors[0]], 200);
        };

        $kode_berkas = KodeBerkas::create($request->all());
        $kode_berkas->save();
        return response()->json(["status" => "success", "message" => 'kode berkas berhasil ditambahkan!'], 200);
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
        //
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
        $rules = array(
            'nama_kode' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response()->json(["status" => "error", "message" => $errors[0]], 200);
        };

        $kode_berkas = KodeBerkas::findOrFail($request->id);
        $kode_berkas->nama_kode = $request->nama_kode;
        $kode_berkas->update();
        return response()->json(["status" => "success", "message" => 'kode berkas berhasil diubah!'], 200);
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
        KodeBerkas::where('id', $id)->delete();
        return response()->json(["status" => "success", "message" => 'Kode berhasil dihapus!'], 200);
    }
}
