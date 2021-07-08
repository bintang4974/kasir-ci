<?php echo form_open_multipart('barang/tambah_aksi') ?>

<div class="form-group">
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" class="form-control">
    <?= form_error('nama_barang', '<div class="text-small text-danger">', '</div>') ?>
</div>
<div class="form-group">
    <label>Harga Barang</label>
    <input type="text" name="harga_barang" class="form-control">
    <?= form_error('harga_barang', '<div class="text-small text-danger">', '</div>') ?>
</div>
<div class="form-group">
    <label>Stok Barang</label>
    <input type="text" name="stok_barang" class="form-control">
    <?= form_error('stok_barang', '<div class="text-small text-danger">', '</div>') ?>
</div>
<div class="form-group">
    <label>Foto Barang</label>
    <input type="file" name="foto_barang" class="form-control">
</div>

<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>

<?php echo form_close() ?>