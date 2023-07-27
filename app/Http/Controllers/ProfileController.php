<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Exports\ProfileExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
// use App\Http\Requests\ProfileFormRequest;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profiles = Profile::where('user_id', Auth::id())->paginate(15);   
        return view('home', compact('profiles'));
    
    }

    public function search(Request $request)
    {
        // $request->$keyword = $request->keyword;
        $keyword = $request->input('keyword');
        $profiles = Profile::where('user_id', Auth::id())
                            ->where('nama', 'LIKE', '%'.$keyword.'%')
                            ->paginate(15);

        return view('home', compact('profiles'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nik' => "required|unique:profiles| max:16",
            'nama' => "required|max:100",
            'nohp' => "required|max:15",
            'rt' => "required|max:5",
            'kelurahan' =>'required|max:100',
        ], [
            'nik.required' => 'NIK Wajib Di Isi',
            'nama.required' => 'Nama Wajib Di Isi',
            'nohp.required' => 'No. HP Wajib Di Isi',
            'rt.required' => 'RT Wajib Di Isi',
            'kelurahan.required' => 'Kelurahan Wajib Di Isi',
            'nik.unique' => 'NIK Sudah Tersedia',
            'nik.max' => 'NIK Maksimal :max Karakter',
            'nohp.max' => 'No. Hp Maksimal :max Karakter',
            'rt.max' => 'RT Maksimal :max Karakter',
            'kelurahan.max' => 'Kelurahan Maksimal :max Karakter',
        ]);
    
        // $profile = Profile::create($request->all());
        $profile = new Profile();
        $profile->user_id = Auth::id();
        $profile->nik = $request->input('nik');
        $profile->nama = $request->input('nama');
        $profile->nohp = $request->input('nohp');
        $profile->rt = $request->input('rt');
        $profile->kelurahan = $request->input('kelurahan');
        // dd($profile);
        $profile->save();
        if($profile){
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil Menambahkan Data!');
        }
        return redirect('/');
    }
    
    public function edit(Request $request, $id)
    {
        $request->validate([
            'nik' => "required|unique:profiles,nik,$id| max:16",
            'nama' => "required|max:100",
            'nohp' => "required|max:15",
            'rt' => "required|max:5",
            'kelurahan' =>'required|max:100',
        ], [
            'nik.required' => 'NIK Wajib Di Isi',
            'nama.required' => 'Nama Wajib Di Isi',
            'nohp.required' => 'No. HP Wajib Di Isi',
            'rt.required' => 'RT Wajib Di Isi',
            'kelurahan.required' => 'Kelurahan Wajib Di Isi',
            'nik.unique' => 'NIK Sudah Tersedia',
            'nik.max' => 'NIK Maksimal :max Karakter',
            'nohp.max' => 'No. Hp Maksimal :max Karakter',
            'rt.max' => 'RT Maksimal :max Karakter',
            'kelurahan.max' => 'Kelurahan Maksimal :max Karakter',
        ]);

        $profile = Profile::where('id',$id)->firstOrFail();
        $profile->update($request->all());
        if($profile){
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil Mengubah Data!');
        }
        return redirect('/');
    }
    
    public function destroy(Request $request, $id)
    {
        $deletedProfile = Profile::findOrFail($id);
        $deletedProfile->delete();
        if($deletedProfile){
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil Menghapus Data!');
        }
        return redirect('/');
    }

    public function exportExcel()
    {
        return Excel::download(new ProfileExport, 'Profile Data.xlsx');
    }
}