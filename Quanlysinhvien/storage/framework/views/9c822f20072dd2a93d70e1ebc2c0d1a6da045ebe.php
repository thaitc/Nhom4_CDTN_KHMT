
<?php $__env->startSection('title','Quản lý môn học'); ?>
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
<form action="<?php echo e(url('admin/monhoc/update')); ?>" method="post">
    <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>" />
    <input type="hidden" id="id" name="id" value="<?php echo $getMonhocById[0]->id; ?>" />
    <div class="form-group">
        <label for="tenmon">Tên môn</label>
        <input type="text" class="form-control" id="tenmon" name="tenmon" placeholder="Tên môn học" maxlength="255" value="<?php echo e($getMonhocById[0]->tenmon); ?>" required />
    </div>
    <div class="form-group">
        <label for="tengiangvien">Chọn khoa</label>
        <select class="form-control" id="tenkhoa" name="tenkhoa" required>
            <option value="">-- Chọn khoa --</option>
            <?php $__currentLoopData = $dskhoa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenkhoa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo $tenkhoa->tenkhoa; ?>" <?php echo ($getMonhocById[0]->tenkhoa == $tenkhoa->tenkhoa) ? 'selected="selected"' : null; ?>><?php echo $tenkhoa->tenkhoa; ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="sodienthoai">Tín chỉ</label>
        <input type="text" class="form-control" id="tinchi" name="tinchi" placeholder="Tín chỉ" maxlength="255" value="<?php echo e($getMonhocById[0]->tinchi); ?>" required />
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
<?php echo $__env->make('templates.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/monhoc/edit.blade.php ENDPATH**/ ?>