<div class="btn btn-primary btn-sm mb-3">No. Invoice: <?= $invoice->id ?></div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr class="text-center">
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Pesan</th>
            <th>Harga Satuan</th>
            <th>Kembalian</th>
            <th>Sub-Total</th>
        </tr>
    </thead>
    <?php
    $total = 0;
    foreach ($pesanan as $psn) :
        $subtotal = $psn->jumlah * $psn->harga_barang;
        $total += $subtotal; ?>
        <tbody>
            <tr class="text-center">
                <td><?= $psn->id_barang ?></td>
                <td><?= $psn->nama_barang ?></td>
                <td><?= $psn->jumlah ?></td>
                <td><?= number_format($psn->harga_barang, 0, ',', '.') ?></td>
                <td><?= number_format($psn->kembalian, 0, ',', '.') ?></td>
                <td align="right"><?= number_format($subtotal, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    <?php endforeach ?>
    <tr>
        <td colspan="3" align="right">Total Bayar:</td>
        <td align="right">Rp. <?= number_format($psn->total_bayar, 0, ',', '.') ?></td>
        <td align="right">Grand Total:</td>
        <td align="right">Rp. <?= number_format($total, 0, ',', '.') ?></td>
    </tr>
</table>

<a href="<?= base_url('transaksi/checkout') ?>" class="btn btn-danger btn-sm"><i class="fas fa-arrow-circle-left"></i> Kembali</a>