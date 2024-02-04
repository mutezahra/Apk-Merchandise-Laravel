<?php

namespace App\Http\Controllers;
use App\Models\ProductsM;
use App\Models\KategoriM;
use App\Models\LogM;
use App\Models\TransactionsM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class ProductsC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{ 
    $subtitle = "Daftar Produk";
    
    // Get the search query from the request
    $vcari = request('search');

    // Create a query to retrieve products with their category information
    $query = ProductsM::select('products.*', 'kategori.*', 'products.id')
        ->join('kategori', 'kategori.id', '=', 'products.id_kategori')
        ->when($vcari, function ($query) use ($vcari) {
            // Apply search condition if search query is provided
            return $query->where('nama_produk', 'like', '%' . $vcari . '%')
                ->orWhere('harga_produk', 'like', '%' . $vcari . '%')
                ->orWhere('stok', 'like', '%' . $vcari . '%')
                ->orWhere('kategori.kategori', 'like', '%' . $vcari . '%');
        });

    // Paginate the results
    $products = $query->paginate(10);

    return view('products_index', compact('products', 'subtitle','vcari'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $subtitle = "Menambahkan Produk";
        $kategoriM = KategoriM::all();
        return view('create.products_create', compact('kategoriM','subtitle'));
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
            'activity' => 'User Menambahkan  Data Produk'
        ]);
       
       
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'stok' => 'required',
            'id_kategori' => 'required',
            'dproduk' => 'required',
            'tanggal_masuk' => 'required',
        ]);

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
    
        $products = new ProductsM;
        $products->foto_produk = $fileName;
        $products->nama_produk = $request->input('nama_produk');
        $products->harga_produk = $request->input('harga_produk');
        $products->stok = $request->input('stok');
        $products->id_kategori = $request->input('id_kategori');
        $products->dproduk = $request->input('dproduk');
        $products->tanggal_masuk = $request->input('tanggal_masuk');
        $products->save();
    
        return redirect()->route('products.index')->with('success', ' Data Produk Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subtitle = "Edit Produk Produk";
        $products = ProductsM::find($id);
        $kategoriM = KategoriM::all();
        return view('edit.products_edit', compact( 'products', 'kategoriM', 'subtitle'));
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
        'activity' => 'User Mengedit Data Produk'
    ]);

    $request->validate([
        'foto_produk' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'nama_produk' => 'required',
        'harga_produk' => 'required',
        'stok' => 'required',
        'id_kategori' => 'required',
        'dproduk' => 'required',
        'tanggal_masuk' => 'required',
    ]);

   $file = $request->file('foto');

if ($file) {
    // Handle file upload only if a new file is provided
    $fileName = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads'), $fileName);

    // Update the file name in the database only if a new file is provided
}

    $products = ProductsM::find($id);
    if ($file) {
        $products->foto_produk = $fileName;
    }
    $products->nama_produk = $request->input('nama_produk');
    $products->harga_produk = $request->input('harga_produk');
    $products->stok = $request->input('stok');
    $products->id_kategori = $request->input('id_kategori');
    $products->dproduk = $request->input('dproduk');
    $products->tanggal_masuk = $request->input('tanggal_masuk');
    $products->save();

    return redirect()->route('products.index')->with('success', 'Data Produk Berhasil Diperbaharui');
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
            'activity' => 'User Menghapus Data Produk'
        ]);
       
        ProductsM::where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Data Produk Berhasil Dihapus');
    }

    // public function pdf($id){

    //     $log = LogM::create([
    //         'id_user' =>Auth::user()->id,
    //         'activity' => 'user melihat halaman PDF Satu transaksi'
    //     ]);
    //     $TransactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
    //     ->join('products', 'products.id', '=', 'transactions.id_produk')->where('transactions.id',$id)->get();
    //     $pdf= Pdf ::loadView('products_pdf',['TransactionsM'=>$TransactionsM]);
    //    return $pdf->stream('transactions.pdf');

    // }


    public function export(Request $request)
    {
        $vcari = $request->input('search');
    
        $query = ProductsM::select('products.*', 'kategori.*', 'products.id')
            ->join('kategori', 'kategori.id', '=', 'products.id_kategori');
    
        if ($vcari) {
            $query->where(function ($q) use ($vcari) {
                $q->where('nama_produk', 'like', '%' . $vcari . '%')
                    ->orWhere('harga_produk', 'like', '%' . $vcari . '%')
                    ->orWhere('stok', 'like', '%' . $vcari . '%')
                    ->orWhere('kategori.kategori', 'like', '%' . $vcari . '%');
            });
        }
    
        $products = $query->get();
    
        $pdf = PDF::loadView('pdf.products_pdf', compact('products', 'vcari'));
        return $pdf->stream();
    }
    
    
    

    
}
