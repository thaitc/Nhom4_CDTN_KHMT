
<?php $__env->startSection('title','Quản lý giảng viên'); ?>
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
<?php //Hiển thị thông báo lỗi
?>
<?php if( Session::has('error') ): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong><?php echo e(Session::get('error')); ?></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
<?php endif; ?>
<?php //Hiển thị danh sách học sinh
?>
<br />
<div class="row">
    <div style="text-align: center;" class="col-md-4">
        <label>Ma sinh viên</label><br />
        <?php $__currentLoopData = $getSinhVienById; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a><?php echo e(($mama ->masinhvien)); ?></a><br />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div style="text-align: center;" class="col-md-4">
        <label>Tên sinh viên</label><br />
        <?php $__currentLoopData = $getSinhVienById; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $diem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a><?php echo e(($diem ->sinhvien)); ?></a><br />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="col-md-4">
        <label>Điểm</label><br />
        <?php $__currentLoopData = $diemtb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $diem1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a><?php echo e(($diem1 ->diem)); ?></a><br />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/xephang.blade.php ENDPATH**/ ?>