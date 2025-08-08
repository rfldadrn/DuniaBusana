<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; margin: 20px; }
        .receipt { max-width: 650px; margin: auto; border: 1px solid #ccc; padding: 25px; }
        h2 { text-align: center; margin-bottom: 10px; }
        .header, .footer { text-align: center; margin-bottom: 20px; }
        .contact { font-size: 12px; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 8px; border-bottom: 1px solid #ddd; text-align: left; }
        .price, .total td:last-child { text-align: right; }
        .total-row { font-weight: bold; }
        .no-border td { border: none; padding: 4px 8px; }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>Nota Transaksi</h2>
            <p><strong>CV. Dunia Busana Tailor</strong><br>
                Jl. Kis Mangunsarkoro no 8D, Padang Timur<br>
                <span class="contact">Telp: (0751 - 841813) | WA: 081363134646</span>
            </p>
        </div>

        <table class="no-border">
            <tr>
                <td>Nomor Transaksi</td>
                <td>:</td>
                <td>{{ $getTrx->order_id }}</td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td>:</td>
                <td>{{ $getTrx->customer->customer_name }} ({{ $getTrx->customer->phone }})</td>
            </tr>
            <tr>
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($getTrx->transaction_date)->format('d M Y') }}</td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($getTrx->completion_date)->format('d M Y') }}</td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail_order as $dt)
                    <tr>
                        <td>{{ $dt->items->name }}</td>
                        <td>{{ $dt->qty }}</td>
                        <td class="price">Rp. {{ number_format($dt->price, 0, ',', '.') }}</td>
                        <td class="price">Rp. {{ number_format($dt->qty * $dt->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td class="price">Rp. {{ number_format($getTrx->amount, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Uang Muka</td>
                    <td class="price">Rp. {{ number_format($getTrx->paid_amount, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Sisa Pembayaran</td>
                    <td class="price">Rp. {{ number_format($getTrx->balance_due, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda!</p>
        </div>
    </div>
</body>
</html>
