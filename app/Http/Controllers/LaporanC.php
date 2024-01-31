<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TransactionsM;
use Carbon\Carbon;
use PDF;

class LaporanC extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subtitle = "Laporan Transaksi";
        $transactionsM = TransactionsM::all();
        return view('laporan_index',compact('subtitle','transactionsM'));
    }

    public function filter(Request $request)
    {
        $subtitle = "Filter Transaksi";
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $transactionsM = TransactionsM::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        return view('laporan_index', compact('subtitle','transactionsM' ,'startDate','endDate'));

    }


    public function export(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $transactionsM = TransactionsM::whereBetween('created_at',[$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        $pdf = Pdf::loadView('laporan_pdf', compact('transactionsM','startDate','endDate'));
        return $pdf->stream();
    }

       
}   



    