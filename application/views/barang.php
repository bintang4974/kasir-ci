<?= $this->session->flashdata('pesan'); ?>

<div class="card">
    <div class="card-header">
        <a href="<?= base_url('barang/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        <a href="<?= base_url('barang/print') ?>" class="btn btn-success btn-sm"><i class="fas fa-print"></i> Print</a>
        <a href="<?= base_url('barang/pdf') ?>" class="btn btn-info btn-sm"><i class="fas fa-file"></i> Cetak Pdf</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Stok Barang</th>
                    <th>Foto Barang</th>
                    <th>Actions</th>
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
                        <td><img src="<?= base_url('assets/foto/' . $brg->foto_barang) ?>" width="80px" height="60px"></td>
                        <td>
                            <button data-toggle="modal" data-target="#edit<?= $brg->id_barang ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <a href="<?= base_url('barang/delete/' . $brg->id_barang) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>


<!-- Modal -->
<?php foreach ($barang as $brg) : ?>
    <div class="modal fade" id="edit<?= $brg->id_barang ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('barang/edit/' . $brg->id_barang) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="hidden" name="id_barang" value="<?= $brg->id_barang ?>">
                            <input type="text" name="nama_barang" class="form-control" value="<?= $brg->nama_barang ?>">
                        </div>
                        <div class="form-group">
                            <label>Harga Barang</label>
                            <input type="text" name="harga_barang" class="form-control" value="<?= $brg->harga_barang ?>">
                        </div>
                        <div class="form-group">
                            <label>Stok Barang</label>
                            <input type="text" name="stok_barang" class="form-control" value="<?= $brg->stok_barang ?>">
                        </div>
                        <div class="form-group">
                            <label>Foto Barang</label><br>
                            <img src="<?= base_url('assets/foto/' . $brg->foto_barang) ?>" width="50px" height="50px">
                            <input type="file" name="foto_barang" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
