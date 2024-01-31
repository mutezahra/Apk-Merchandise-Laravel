<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>U-DAEBAK</title>
  <style>
    body {
      font-family: 'Courier New', Courier, monospace;
      width: 300px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .header {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
      text-transform: uppercase;
    }
    .sub-header {
      text-align: center;
      font-size: 18px;
      margin-bottom: 20px;
      color: #333;
      text-transform: uppercase;
    }
    .transaction-info {
      font-size: 14px;
      margin-bottom: 10px;
    }
    .transaction-info p {
      margin: 5px 0;
    }
    .total {
      font-weight: bold;
      color: #333;
      text-align: right;
      margin-top: 20px; /* Add margin-top for spacing */
    }
    .total p {
      margin: 5px 0; /* Adjust margin for better spacing */
    }
    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 16px;
      color: #333;
    }
  </style>
</head>
<body>
  <div class="header">U-DAEBAK</div>

  <div class="sub-header">Jln.Gimceon No.45</div>
  <p>----------------------------------</p>
  <p>Customer: {{ $transactionsM[0]->nama_pelanggan }}</p>
  <p>Tanggal: <?php echo date("Y-m-d"); ?></p>
  <p>-----------------------------------</p>

  @foreach ($transactionsM as $data)
    <div class="transaction-info">
      <p> {{ $data->nama_produk }} </p>
      <p> {{ $data->qty }} / {{ $data->harga_produk }} =  {{ $data->qty * $data->harga_produk }}</p>
    </div>
  @endforeach

  <div class="total">
    <p>-------------------------------</p>
    <p>Total Harga: {{ $transactionsM[0]->total_harga }}</p>
    <p>Uang Bayar: {{ $transactionsM[0]->uang_bayar }}</p>
    <p>Uang Kembali: {{ $transactionsM[0]->uang_kembali }}</p>
  </div>
  
  <div class="footer">
    <p>---------------------------------</p>

    <p> {{ $transactionsM[0]->updated_at}}/{{ Auth::user()->nama }}/{{ $transactionsM[0]->nomor_unik }}</p>
    <p>Terima Kasih Telah Berbelanja</p>
  </div>

  
</body>
</html>
