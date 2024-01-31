<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\ProductsM;
use App\Models\LogM;
use App\Models\TransactionsM;

use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsC extends Controller
{
    public function index()
    {
        $logM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Transaksi'
        ]);

        $subtitle = "Transactions";
       // Melakukan query dan join terlebih dahulu
       $query = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans','transactions.updated_at AS tanggal_trans' )
       ->join('products', 'products.id', '=', 'transactions.id_produk');

        // Menjalankan query dan menggunakan paginate()
           $transactionsM = $query->paginate(10);;
        return view('transactions_index', compact('subtitle', 'transactionsM', ));
    }

    public function create()
    {
        $subtitle = "Menambahkan Transaksi";
        $products = ProductsM::all();
        return view('create.transactions_create', compact('products', 'subtitle'));
    }

    public function store(Request $request)
    {
        $logM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan Transaksi'
        ]);
    
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'id_produk' => 'required|exists:products,id',
            'qty' => 'required|numeric|min:1',
            'uang_bayar' => 'required|numeric|min:0',
        ]);
    
        // Get product details
        $product = ProductsM::findOrFail($request->id_produk);
    
        // Calculate total price based on quantity
        $total_harga = $product->harga_produk * $request->qty;
    
        // Calculate uang_kembali
        $uang_kembali = $request->uang_bayar - $total_harga;
    
        // Check if stock is enough for the transaction
    if ($product->stok < $request->input('qty')) {
        return redirect()->route('transactions.create')->with('error', 'Stok produk tidak mencukupi.');
    }

    // Kurangi stok produk sesuai dengan qty
    $product->stok -= $request->input('qty');
    $product->save();

        // Store the transaction in the database
        TransactionsM::create([
            'nomor_unik' => random_int(1000000000, 9999999999),
            'nama_pelanggan' => $request->nama_pelanggan,
            'id_produk' => $request->id_produk,
            'qty' => $request->qty,
            'total_harga' => $total_harga,
            'uang_bayar' => $request->uang_bayar,
            'uang_kembali' => $uang_kembali, // Use the calculated value here
         
        ]);
    
        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully');
    }


    
    public function edit($id)
    {
        $subtitle = "Edit Transaksi Produk";
        $transactionsM = TransactionsM::find($id);
        $products = ProductsM::all();
        return view('edit.transactions_edit', compact('subtitle', 'products', 'transactionsM'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'id_produk' => 'required|exists:products,id',
            'qty' => 'required|numeric|min:1',
            'uang_bayar' => 'required|numeric|min:0',
        ]);
    
        // Find the transaction by ID
        $transaction = TransactionsM::findOrFail($id);
    
        // Get product details
        $product = ProductsM::findOrFail($request->id_produk);
    
        // Calculate total price based on quantity
        $total_harga = $product->harga_produk * $request->qty;
    
        // Calculate uang_kembali
        $uang_kembali = $request->uang_bayar - $total_harga;
    
        $original_qty = $transaction->qty; // Store the original quantity for later comparison

        $product = ProductsM::find($request->input('id_produk'));
        $request_qty = $request->input('qty');
    
        // Update the transaction in the database
        $transaction->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'id_produk' => $request->id_produk,
            'qty' => $request->qty,
            'total_harga' => $total_harga,
            'uang_bayar' => $request->uang_bayar,
            'uang_kembali' => $uang_kembali,
           
        ]);

              // Update product stock based on quantity change
         $stock_change = $request_qty - $original_qty;
         $product->stok -= $stock_change;
         $product->save();


    
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }
    
       
    
    

    public function destroy($id)
{
    // Find the transaction by ID
   
    // TransactionsM::where('id_transaksi', $id)->delete();
    // LogM::where('id_user', $id)->delete();
    TransactionsM::where('id', $id)->delete();
    // Perform the deletion
    
    // Redirect back to the index page with a success message
    return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
}
public function Struk($id){
    
    $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
        ->join('products', 'products.id', '=', 'transactions.id_produk')->where('transactions.id', $id)->get();
    
    $pdf = PDF::loadView('pdf.transactions_struk', ['transactionsM' => $transactionsM]);
    return $pdf->stream('transactions_struk.pdf');
}


public function pdf2(){
    $subtitle ="Halaman Print PDF";
    // $productsM = ProductsM::all();
    return view('transactions_date', compact('subtitle'));


}


// public function filterTransactionsByDate(Request $request, $startDate, $endDate)
// {
//     try {
//         // Validate date format
//         $validatedData = $request->validate([
//             'startDate' => 'required|date',
//             'endDate' => 'required|date',
//         ]);

//         // Use an Eloquent query to retrieve filtered transactions
//         $transactions = TransactionsM::whereBetween('transactions.created_at', [$startDate, $endDate])
//             ->join('products', 'products.id', '=', 'transactions.id_produk')
//             ->select('transactions.*', 'products.nama_produk as nama')
//             ->paginate(10); // Pagination for displaying in a view

//         // If you want to prepare data for a PDF export instead, you would collect the data without pagination:
//         // $transactionsForPdf = $transactions->get();

//         // Return the view with the transactions
//         return view('transactions.filtered', ['transactions' => $transactions]);

//         // If you were preparing a PDF, you would use:
//         // $pdf = PDF::loadView('pdf.transactions', ['transactions' => $transactionsForPdf]);
//         // return $pdf->download('transactions.pdf');
//     } catch (\Exception $e) {
//         // Handle the exception
//         return back()->withErrors('There was an error processing your request: ' . $e->getMessage());
//     }


public function pertanggal(Request $request)
{
    // Gunakan tanggal yang diterima sesuai kebutuhan
    $tgl_awal = $request->input('tgl_awal');
    $tgl_akhir = $request->input('tgl_akhir');
    
    $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans', 'transactions.updated_at AS tanggal_trans')
        ->join('products', 'products.id', '=', 'transactions.id_produk')
        ->whereBetween('transactions.created_at', [$tgl_awal . ' 00:00:00', $tgl_akhir . ' 23:59:59'])
        ->orderBy('transactions.created_at', 'desc')
        ->get();

    $pdf = PDF::loadview('transactions_pdf', ['transactionsM' => $transactionsM]);
    return $pdf->stream('stgl.pdf');
}








}


