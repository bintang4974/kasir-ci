<!DOCTYPE html>
<html lang="en"><head>
    <title>Print Barang</title>
</head><body>

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
    
</body></html>