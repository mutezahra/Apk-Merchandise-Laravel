<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Transaksi</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: Arial, arial;
        }

    

h3 {
    text-align: center;
    background-color: ;
    color: #000000 ;
    padding: 10px;
}

table {
    width: 100%;
    border: 1px solid #000000;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #000000;
    padding: 10px;
    font-size: 9px;
}

th {
    background-color: #ffffff;
    color: #000000;
}

tr:nth-child(even) {
    background-color: #ffffff; /* Warna latar belakang baris genap */
}



tr:hover {
            background-color: #000000;
        }




/* Add this style for the second table with tfoot */
table.summary-table {
    width: 100%;
    border: 1px solid #000000;
    border-collapse: collapse;
    margin-top: 10px; /* Adjust the margin as needed */
}

/* Style for tfoot in the second table */
table.summary-table tfoot td {
    background-color: #ffffff;
    color: #000000;
    font-weight: bold;
    text-align: center;
    padding: 10px;
}

/* Ensure the total Keseluruhan text is centered */
table.summary-table tfoot td[colspan="10"] {
    text-align: center;
}
    </style>
</head>
<body>
    <h3>LAPORAN TRANSAKSI</h3>
    <table id="">
        <thead>
            <tr>
                <th>Nomor Unik</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Harga Produk</th>
                <th>Qty</th>
                <th>Total Harga</th>
                <th>Uang Bayar</th>
                <th>Uang Kembali</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        @php
                $totalHargaProduk = 0; // Initialize the total harga_produk variable
            @endphp
            @foreach ($transactionsM as $data)
            <tr>
                <td>{{ $data->nomor_unik }}</td>
                <td>{{ $data->nama_pelanggan }}</td>
                <td>{{ $data->products->nama_produk }}</td>
                <td>{{ $data->products->harga_produk }}</td>
                <td>{{ $data->qty }}</td>
                <td>{{ $data->total_harga }}</td>
                <td>{{ $data->uang_bayar }}</td>
                <td>{{ $data->uang_kembali }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            @php
                $totalHargaProduk += $data->products->harga_produk * $data->qty; // Accumulate the total harga_produk
            @endphp
                @endforeach
        </tbody>

    </table>
    <table class="summary-table">
        <tfoot>
            <tr>
                <td colspan="10">Total Keseluruhan : {{$totalHargaProduk}}</td>
            </tr>
        </tfoot>
    </table>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>