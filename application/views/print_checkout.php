<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Belanjaan</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Jumlah Pesan</th>
            <th>Harga Satuan</th>
            <th>Kembalian</th>
            <th>Sub-Total</th>
        </tr>
        <?php $no = 1;
        $total = 0;
        foreach ($pesanan as $psn) :
            $subtotal = $psn->jumlah * $psn->harga_barang;
            $total += $subtotal; ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $psn->nama_barang ?></td>
                <td><?= $psn->jumlah ?></td>
                <td>Rp. <?= number_format($psn->harga_barang, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($psn->kembalian, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="3" align="right">Total Bayar:</td>
            <td align="right">Rp. <?= number_format($psn->total_bayar, 0, ',', '.') ?></td>
            <td align="right">Grand Total:</td>
            <td align="right">Rp. <?= number_format($total, 0, ',', '.') ?></td>
        </tr>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>