<?php

namespace App\Http\Controllers;

use App\Models\metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class profileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }
    public function update(request $request)
    {
        $request->validate([
            '_foto' => 'mimes:jpeg,jpg,png,gif',
            '_email' => 'required|email',
        ], [
            '_foto.mimes' => 'Format Tidak Diizinkan',
            '_email.required' => 'Email Wajib Diisi',
            '_email.email' => 'Format Email Tidak Valid',
        ]);

        if($request->hasFile('_foto')) {
            $foto_file = $request->file('_foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymdhis').".$foto_ekstensi";
            $foto_file->move(public_path('foto'), $foto_baru);
            // alau ada update foto
            $foto_lama = get_meta_value('_foto');
            File::delete(public_path('foto'). "/". $foto_lama);
            metadata::updateOrCreate(['metakey' => '_foto'], ['meta_value' => $foto_baru]);
        }

        metadata::updateOrCreate(['metakey' => '_email'], ['meta_value' => $request->_email]);
        metadata::updateOrCreate(['metakey' => '_kota'], ['meta_value' => $request->_kota]);
        metadata::updateOrCreate(['metakey' => '_provinsi'], ['meta_value' => $request->_provinsi]);
        metadata::updateOrCreate(['metakey' => '_nohp'], ['meta_value' => $request->_nohp]);

        metadata::updateOrCreate(['metakey' => '_facebook'], ['meta_value' => $request->_facebook]);
        metadata::updateOrCreate(['metakey' => '_twitter'], ['meta_value' => $request->_twitter]);
        metadata::updateOrCreate(['metakey' => '_linkedin'], ['meta_value' => $request->_linkedin]);
        metadata::updateOrCreate(['metakey' => '_github'], ['meta_value' => $request->_github]);

        return redirect()->route('profile.index')->with('success', 'Berhasil Update Data Profile');
    }
}
