<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            position: relative;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            position: relative;
            padding-bottom: 100px;
        }

        .header {
            border-bottom: 3px solid #8b5b12;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header table {
            width: 100%;
            border-collapse: collapse;
        }

        .header td {
            vertical-align: middle; /* Vertically center items in the table cell */
            padding: 0 30px; /* Horizontal padding to create space between cells */
        }

        .header img {
            max-width: 100px; /* Sesuaikan ukuran logo */
            height: auto;
            text-align: left;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #8b5b12;
            text-align: right;
        }

        .header p {
            margin: 5px 0;
            font-size: 16px;
            color: #495057;
            text-align: right;
        }

        .pos-pelanggan {
            position: relative;
            left: 244px;
        }

        .pos-nomor {
            position: relative;
            left: 86px;
        }

        .info-wrapper {
            margin-bottom: 20px;
        }

        .info-wrapper p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 16px;
            color: #495057;
        }

        .from, .billed-to {
            display: inline-block;
            margin-right: 250px; /* Menambahkan jarak antara "From" dan "Billed To" */
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .items-table th {
            background-color: #8b5b12;
            color: #fff;
            font-weight: bold;
        }

        .items-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .items-table tbody tr:hover {
            background-color: #e6e6e6;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #8b5b12;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 10px;
            border-top: 3px solid #8b5b12;
            font-size: 14px;
            color: #6c757d;
        }

        .footer p {
            margin: 5px 0;
        }

        .signature {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 200px;
            text-align: center;
        }

        .signature img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td><img src="{{ public_path('images/logo-pdf.png') }}" alt="Logo"></td>
                    <td>
                        <h1>INVOICE #{{ $invoice->no_invoice }}</h1>
                        <p>Tanggal: {{ $invoice->tanggal }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="info-wrapper">
            <span class="from"><strong>From: </strong></span>
            <span class="billed-to"><strong>Billed To:</strong></span>
            <p>
                Telkom 
                <span class="pos-pelanggan">{{ $invoice->esmdiid->nama }}</span>
            </p>
            <p>
                Jl. Pahlawan No.10, Pleburan 
                <span class="pos-nomor">{{ $invoice->espelanggan->no_customer }}</span>
            </p>
            <p>Kota Semarang</p>
            <p>(024) 8302006</p>
        </div>

        <h2>Produk</h2>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->barang as $item)
                    <tr>
                        <td>
                            @php
                                $produkName = '';
                                if ($item['produk_id'] == 1) {
                                    $produkName = 'Telepon';
                                } elseif ($item['produk_id'] == 2) {
                                    $produkName = 'Internet';
                                } else {
                                    $produkName = 'Produk Tidak Diketahui';
                                }
                            @endphp
                            {{ $produkName }}
                        </td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['total'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <p>Total Invoice: {{ number_format($invoice->total_invoice, 0, ',', '.') }}</p>
        </div>

        <div class="footer">
            <p>Terima kasih telah berbisnis dengan kami.</p>
            <p>Untuk pertanyaan atau bantuan lebih lanjut, silakan hubungi kami.</p>
        </div>

        <div class="signature">
            <p>Tanda Tangan</p>
            <img src="{{ public_path('images/Logo-Dark.png') }}" alt="Sovian">
            <p>Sovian</p>
        </div>
    </div>
</body>
</html>
