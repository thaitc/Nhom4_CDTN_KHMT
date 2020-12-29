
<?php $__env->startSection('title','Thông tin cá nhân'); ?>
<?php $__env->startSection('content'); ?>

<?php if(Route::has('login')): ?>
<?php if(auth()->guard()->check()): ?>
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
<form action="<?php echo e(url('/profile')); ?>" method="post">
    <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>" />
    <input type="hidden" id="id" name="id" value="<?php echo $getSinhVienById[0]->id; ?>" />
    <div class="form-group">
        <label for="masinhvien">Mã sinh viên</label>
        <input type="text" class="form-control" id="masinhvien" name="masinhvien" placeholder="Mã học sinh" maxlength="255" value="<?php echo e($getSinhVienById[0]->masinhvien); ?>" required />
    </div>
    <div class="form-group">
        <label for="tensinhvien">Tên sinh viên</label>
        <input type="text" class="form-control" id="hoten" name="hoten" placeholder="Tên sinh viên" maxlength="255" value="<?php echo e($getSinhVienById[0]->hoten); ?>" required />
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" maxlength="200" value="<?php echo e($getSinhVienById[0]->email); ?>" required />
    </div>
    <div class="form-group">
        <label for="email">Địa chỉ</label>
        <input type="text" class="form-control" id="diachi" name="diachi" placeholder="Địa chỉ" maxlength="200" value="<?php echo e($getSinhVienById[0]->diachi); ?>" required />
    </div>
    <div class="form-group">
        <label for="khoi">Chọn khoa</label>
        <select class="form-control" id="tenkhoa" name="tenkhoa" required>
            <option value="">-- Chọn khoa --</option>
            <?php $__currentLoopData = $dskhoa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenkhoa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo $tenkhoa->tenkhoa; ?>" <?php echo ($getSinhVienById[0]->tenkhoa == $tenkhoa->tenkhoa) ? 'selected="selected"' : null; ?>><?php echo $tenkhoa->tenkhoa; ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <center><button type="submit" class="btn btn-success">Sửa</button></center>
</form>
<?php if(Route::has('register')): ?>
<a href="<?php echo e(route('register')); ?>">Register</a>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/profile.blade.php ENDPATH**/ ?>