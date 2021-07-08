<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-secondary">
                Pilih Barang
            </div>
            <div class="card-body">

                <form action="" method="post">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <?php $no = 1;
                        foreach ($barang as $brg) : ?>
                            <tbody>
                                <tr class="text-center">
                                    <td><?= $no++ ?></td>
                                    <td><?= $brg->nama_barang ?></td>
                                    <td><?= $brg->harga_barang ?></td>
                                    <td><?= $brg->stok_barang ?></td>
                                    <td><img src="<?= base_url('assets/foto/' . $brg->foto_barang) ?>" width="40px" height="40px"></td>
                                    <td><a href="<?= base_url('transaksi/tambah_keranjang/' . $brg->id_barang) ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Keranjang</a></td>
                                </tr>
                            </tbody>
                        <?php endforeach ?>
                    </table>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-info">
                Pembayaran
            </div>
            <div class="card-body">

                <form action="<?= base_url('transaksi/tambah_aksi') ?>" method="post">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total Harga</label>
                        <div class="input-group col-sm-9">
                            <div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                            </div>
                            
                            <input type="text" name="total_harga" id="harga" class="form-control" value="<?php
                            $grand_total = 0;
                            if ($keranjang = $this->cart->contents()) {
                                foreach ($keranjang as $item) {
                                    $grand_total = $grand_total + $item['subtotal'];
                                }
                                echo $grand_total;
                            } ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total Bayar</label>
                        <div class="input-group col-sm-9">
                            <div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" id="bayar" name="total_bayar" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kembalian</label>
                        <div class="input-group col-sm-9">
                            <div class="input-group-append">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" id="kembalian" name="kembalian" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="input-group col-sm-9">
                            <input type="text" name="tgl_pembayaran" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" disabled>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm float-right"><i class="fas fa-money-check-alt"></i> Bayar</button>
                </form>

            </div>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header bg-primary">
        Keranjang Belanja
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr class="text-center">
                    <td>#</td>
                    <td>Nama Barang</td>
                    <td>Jumlah Barang</td>
                    <td>Harga Barang</td>
                    <td>Sub-Total</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($this->cart->contents() as $items) : ?>
                    <tr class="text-center">
                        <td><?= $no++ ?></td>
                        <td><?= $items['name'] ?></td>
                        <td><?= $items['qty'] ?></td>
                        <td align="right">Rp. <?= number_format($items['price'], 0, ',', '.') ?></td>
                        <td align="right">Rp. <?= number_format($items['subtotal'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="4" align="center">Total</td>
                    <td align="right">Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
        <a href="<?= base_url('transaksi/hapus_keranjang') ?>" class="btn btn-danger btn-sm float-right mt-3"><i class="fas fa-trash"></i> Hapus Keranjang</a>
    </div>
</div>
