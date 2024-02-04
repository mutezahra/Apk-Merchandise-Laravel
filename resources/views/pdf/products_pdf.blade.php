<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Products</title>

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
    color: #000000;
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
    font-size: 9px
}

th {
    background-color: #ffffff;
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
    <h3>DAFTAR PRODUK</h3>
    <table id="myTable">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Produk</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Tanggal Masuk</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
            <tr>
                <td>{{ $p->nama_produk}}</td>
                <td>{{ $p->category->kategori }}</td>
                <td>{{ $p->harga_produk }}</td>
                <td>{{ $p->dproduk }}</td>
                <td>{{ $p->stok }}</td>
                <td>{{ $p->tanggal_masuk}}</td>
                
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