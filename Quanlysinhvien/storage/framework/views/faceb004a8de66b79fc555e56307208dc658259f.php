
<?php $__env->startSection('title','Quản lý thời khóa biểu'); ?>
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
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <p><a class="btn btn-primary" href="<?php echo e(url('thoikhoabieu/create')); ?>">Thêm mới</a></p>
            <table id="DataList" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sinh viên</th>
                        <th>Môn học</th>
                        <th>Tín chỉ</th>
                        <th>Giảng viên</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listthoikhoabieu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $thoikhoabieu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center; vertical-align: middle;"><?php echo e($key+1); ?></td>
                        <td style="vertical-align: middle;"><a href="#"><?php echo e($thoikhoabieu->sinhvien); ?></a></td>
                        <td style="vertical-align: middle;"><a href="#"><?php echo e($thoikhoabieu->tenmon); ?></a></td>
                        <td style="vertical-align: middle;"><?php echo e($thoikhoabieu->tinchi); ?></td>
                        <td style="vertical-align: middle;"><?php echo e($thoikhoabieu->tengiangvien); ?></td>
                        <td style="text-align: center; vertical-align: middle;"><a href="thoikhoabieu/<?php echo e($thoikhoabieu->id); ?>/edit">Sửa</a></td>
                        <td style="text-align: center; vertical-align: middle;"><a href="thoikhoabieu/<?php echo e($thoikhoabieu->id); ?>/delete">Xóa</a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
<script>
    function MymodalImage(e) {
        // Get the modal
        var modal = document.getElementById('myModal');
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = e.src;
        captionText.innerHTML = e.alt;
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\thaitc\resources\views/thoikhoabieu/list.blade.php ENDPATH**/ ?>