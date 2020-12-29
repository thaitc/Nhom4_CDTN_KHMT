

<?php $__env->startSection('title','Cập nhật điểm'); ?>

<?php $__env->startSection('content'); ?>
<?php if( Session::has('success') ): ?>
<div class="alert alert-success alert-dismissible" role="alert">
    <strong><?php echo e(Session::get('success')); ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
<?php endif; ?>
<?php if( Session::has('error') ): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong><?php echo e(Session::get('error')); ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
<?php endif; ?>
<form action="<?php echo e(url('danhsachlop/update')); ?>" method="post">
    <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>" />
    <input type="hidden" id="id" name="id" value="<?php echo $getTKBById[0]->id; ?>" />
    <div class="form-group">
        <label for="diem">Nhập điểm cho <?php echo e($getTKBById[0]->sinhvien); ?></label>
        <input type="text" class="form-control" id="diem" name="diem" placeholder="Nhập điểm" maxlength="255" value="<?php echo e($getTKBById[0]->diem); ?>" required />
    </div>

    <center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
</form>
</div>
<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/giangvien/edit_diem.blade.php ENDPATH**/ ?>