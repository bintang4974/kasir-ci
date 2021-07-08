<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barang</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Stok Barang</th>
        </tr>
        <?php $no = 1;
        foreach ($barang as $brg) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $brg->nama_barang ?></td>
                <td><?= $brg->harga_barang ?></td>
                <td><?= $brg->stok_barang ?></td>
            </tr>
        <?php endforeach ?>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>