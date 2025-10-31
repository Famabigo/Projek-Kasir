
<?php $__env->startSection('title','Buat Transaksi'); ?>
<?php $__env->startSection('content'); ?>
<h1>Buat Transaksi</h1>
<form method="POST" action="<?php echo e(route('kasir.transaksi.store')); ?>">
  <?php echo csrf_field(); ?>
  <div class="mb-3">
    <label>Member (opsional)</label>
    <select name="member_id" class="form-control">
      <option value="">-- Pilih --</option>
      <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($m->id); ?>"><?php echo e($m->nama_member); ?> (<?php echo e($m->kode_member); ?>)</option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </div>

  <h5>Item</h5>
  <div id="items">
    <?php $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="<?php echo e($b->id); ?>" id="b<?php echo e($b->id); ?>" data-harga="<?php echo e($b->harga_jual); ?>">
        <label class="form-check-label" for="b<?php echo e($b->id); ?>"><?php echo e($b->nama_barang); ?> - Rp <?php echo e(number_format($b->harga_jual,0,',','.')); ?> (stok: <?php echo e($b->stok); ?>)</label>
        <input type="number" name="items[<?php echo e($b->id); ?>][jumlah]" min="1" max="<?php echo e($b->stok); ?>" class="form-control mt-1" placeholder="Jumlah">
        <input type="hidden" name="items[<?php echo e($b->id); ?>][barang_id]" value="<?php echo e($b->id); ?>">
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <div class="mb-3 mt-3">
    <label>Diskon</label>
    <input type="number" name="diskon" class="form-control" value="0">
  </div>

  <button class="btn btn-success">Simpan Transaksi</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\kasir\resources\views/kasir/transaksi/create.blade.php ENDPATH**/ ?>