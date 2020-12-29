

<?php $__env->startSection('title','Thêm mới môn học'); ?>

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
<div class="col-xs-4 col-xs-offset-4">
    <center>
        <h4>Thêm môn học</h4>
    </center>
    <form action="<?php echo e(url('admin/monhoc/create')); ?>" method="post">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>" />
        <div class="form-group">
            <label for="tenmon">Tên môn</label>
            <input type="text" class="form-control" id="tenmon" name="tenmon" placeholder="Tên môn" maxlength="255" required />
        </div>
        <div class="form-group">
            <label for="tengiangvien">Chọn khoa</label>
            <select class="form-control" id="tenkhoa" name="tenkhoa" required>
                <option value="">-- Chọn khoa --</option>
                <?php $__currentLoopData = $dskhoa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenkhoa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo $tenkhoa->tenkhoa; ?>"><?php echo $tenkhoa->tenkhoa; ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tinchi">Tín chỉ</label>
            <input type="text" class="form-control" id="tinchi" name="tinchi" placeholder="Tín chỉ" maxlength="10" required />
        </div>
        <center><button type="submit" class="btn btn-primary">Thêm</button></center>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/monhoc/create.blade.php ENDPATH**/ ?>