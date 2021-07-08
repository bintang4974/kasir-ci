<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr class="text-center">
            <th>ID Invoice</th>
            <th>Waktu Pemesanan</th>
            <th>Total Harga</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php $no = 1;
    foreach ($checkout as $item) : ?>
        <tbody>
            <tr class="text-center">
                <td><?= $item->id ?></td>
                <td><?= $item->waktu_pesan ?></td>
                <td><?= $item->total_harga ?></td>
                <td width="200px">
                    <a href="<?= base_url('transaksi/detail_checkout/' . $item->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                    <a href="<?= base_url('transaksi/print/' . $item->id) ?>" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Print</a>
                </td>
            </tr>
        </tbody>
    <?php endforeach ?>
</table>