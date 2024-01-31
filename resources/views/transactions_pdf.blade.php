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
            font-family: Arial, sans-serif;
        }

    

h3 {
    text-align: center;
    background-color: ;
    color: #08CCCA;
    padding: 10px;
}

table {
    width: 100%;
    border: 1px solid #000000;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #000000;
    padding: 5px;
}

th {
    background-color: #08CCCA;
    color: #0000000;
}

tr:nth-child(even) {
    background-color: #ffffff; /* Warna latar belakang baris genap */
}



tr:hover {
            background-color: #000000;
        }
    </style>
</head>
<body>
    <h3>DAFTAR TRANSAKSI</h3>
    <table id="myTable">
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
            @foreach ($transactionsM as $data)
            <tr>
                <td>{{ $data->nomor_unik }}</td>
                <td>{{ $data->nama_pelanggan }}</td>
                <td>{{ $data->nama_produk }}</td>
                <td>{{ $data->harga_produk }}</td>
                <td>{{ $data->qty }}</td>
                <td>{{ $data->total_harga }}</td>
                <td>{{ $data->uang_bayar }}</td>
                <td>{{ $data->uang_kembali }}</td>
                <td>{{ $data->tanggal_trans}}</td>
                @endforeach
        </tbody>

    </table>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>