<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nota Transaksi</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; }
    .receipt { max-width: 600px; margin: auto; border: 1px solid #ccc; padding: 20px; }
    h2 { text-align: center; }
    .header, .footer { text-align: center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 8px; border-bottom: 1px solid #ddd; text-align: left; }
    .total { font-weight: bold; }
    .price{
        text-align: right;
    }
    .tbl-detail, table {
        font-size: 14px;
    }
    .text-sm{
        font-size: 12px;
    }
  </style>
  <script>
    window.onload = function() {
      window.print();
    };
  </script>
</head>
<body>
  <div class="receipt">
    <div class="header">
      <h2>Nota Transaksi</h2>
      <p>CV. Dunia Busana Tailor<br>Jl. Kis Mangunsarkoro no 8D, Padang Timur <br><span class="text-sm">Telp : (0751 - 841813) - Whatsapp : 081363134646</span></p>
      <hr>
      <table>
        <tr>
            <td>Nomor Transaksi</td>
            <td>:</td>
            <td>{{ $getTrx->order_id }}</td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td>:</td>
            <td>{{ $getTrx->customer->customer_name . " (" . $getTrx->customer->phone . ")" }}</td>
        </tr>
        <tr>
            <td>Tanggal Masuk</td>
            <td>:</td>
            <td>{{ $getTrx->transaction_date }}</td>
        </tr>
        <tr>
            <td>Tanggal Selesai</td>
            <td>:</td>
            <td>{{ $getTrx->completion_date }}</td>
        </tr>
      </table>
    </div>

    <table class="tbl-detail">
      <thead>
        <tr>
          <th>Item</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($detail_order as $dt)
            <tr>
                <td>{{ $dt->items->name }}</td>
                <td>{{ $dt->qty }}</td>
                <td id="price" class="price">{{ $dt->price }}</td>
                <td id="price" class="price">{{ ($dt->qty * $dt->price) }}</td>
            </tr>
        @endforeach
        <tr>
          <td class="total" colspan="3">Total</td>
          <td id="price" class="total price">{{$getTrx->amount}}</td>
        </tr>
        <tr>
          <td class="total" colspan="3">Uang Muka</td>
          <td id="price" class="total price">{{$getTrx->paid_amount}}</td>
        </tr>
        <tr>
          <td class="total" colspan="3">Sisa Pembayaran</td>
          <td id="price" class="total price">{{$getTrx->balance_due}}</td>
        </tr>
      </tbody>
    </table>

    <div class="footer">
      <p>Thank you for your purchase! 🙏</p>
    </div>
  </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const amountElement = document.querySelectorAll('#price');
        console.log(amountElement);
        for (let i = 0; i < amountElement.length; i++){
            const rawValue = amountElement[i].textContent;
            amountElement[i].textContent = formatRupiah(rawValue);
        }
    });


    function formatRupiah(nominal){
        let rawValue = nominal.replace(/\D/g, '');
        let result = '';
        if (rawValue) {
        let numericValue = parseInt(rawValue, 10);
        result = convertIDR(numericValue);
        } else {
        result = '';
        }

        function convertIDR(nominal) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(nominal);
        }
        return result;
    }
</script>
</html>
