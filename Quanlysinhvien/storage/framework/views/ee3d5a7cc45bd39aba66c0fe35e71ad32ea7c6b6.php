

<?php $__env->startSection('title','Đăng ký môn học'); ?>

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
<form action="<?php echo e(url('thoikhoabieu/create')); ?>" method="post">
    <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>" />
    <div class="form-group">
        <label for="tenmon">Chọn môn</label>
        <select class="form-control" id="tenmon" name="tenmon" required>
            <option value="">-- Chọn môn --</option>
            <?php $__currentLoopData = $dstenmon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenmon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option id="tenmon" value="<?php echo $tenmon->tenmon; ?>"><?php echo $tenmon->tenmon; ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="tengiangvien">Chọn giảng viên</label>
        <select class="form-control" id="tengiangvien" name="tengiangvien" required>
            <option value="">-- Chọn giảng viên --</option>
            <?php $__currentLoopData = $dstengiangvien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tengiangvien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo $tengiangvien->tengiangvien; ?>"><?php echo $tengiangvien->tengiangvien; ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <center><button type="submit" class="btn btn-primary">Thêm</button></center>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/thoikhoabieu/create.blade.php ENDPATH**/ ?>