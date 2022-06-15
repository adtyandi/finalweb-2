<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth, DB;
use Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.profile.index');
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
        //
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
            'name' => 'required',
            'email' => 'required|string|max:255|email',
            'nip' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return redirect()->back();
        }
        $profile = User::where('id', Auth::user()->id)->first();
        if ($request->hasFile('photo')) {
            $rules = array(
                'photo' => 'required|file|image',
            );
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $messages = $validator->messages();
                $errors = $messages->all();
                return response()->json(["status" => "error", "message" => $errors[0]], 200);
            }

            $image = $request->file('photo');

            //name file
            $imagename = $image->getClientOriginalName();
            $a = explode(".", $imagename);
            $fileExt = strtolower(end($a));
            $namaFile = substr(md5(date("YmdHis")), 0, 10) . "." . $fileExt;

            //penyimpanan
            $destination_path = public_path() . '/images/';

            // simpan ke folder
            $request->file('photo')->move($destination_path, $namaFile);
            // simpan database
            $profile->photo = $namaFile;
        }

        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->nip = $request->nip;
        $profile->email = $request->email;
        $profile->update();
        return redirect()->back()->with('success', 'Profil berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
