<?php

namespace App\Http\Controllers;
use App\Models\KategoriM;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KategoriC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {   
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Kategori'
        ]);
        
        $subtitle = "Daftar Kategori";
        $kategoriM = KategoriM::all();
        return view('kategori_index', compact('kategoriM','subtitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { $subtitle = "Daftar Kategori";
        return view('create.kategori_create', compact('subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan Data Kategori'
        ]);
        $validatedData =$request->validate([
            'kategori' => 'required',
            'keterangan' => 'required',
          
        ]);

        $kategori =  new KategoriM([
            'kategori' => $validatedData['kategori'],
            'keterangan' => $validatedData['keterangan'],
            
        ]);
        $kategori ->save();

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Ditambahkan!');
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
        $subtitle = "Edit Data Kategori";
        $kategoriM = KategoriM::find($id);
        return view('edit.kategori_edit', compact('kategoriM','subtitle'));
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

        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengedit Kategori'
        ]);
        $kategoriM = KategoriM::FindOrFail($id);

        $kategoriM->update([
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
           
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Kategori'
        ]);
        KategoriM::where('id', $id)->delete();

        return redirect()->route('kategori.index')->with('success', 'User Berhasil Dihapus');
    }
}
