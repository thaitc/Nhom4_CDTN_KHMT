
<?php $__env->startSection('title','Đánh giá giảng viên'); ?>
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
<div class="text-center">
<h4>Danh sách các môn học và giảng viên đã đăng ký</h4>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="table-primary">
                        <th>STT</th>
                        <th>Giảng viên</th>
                        <th>Tên môn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listthoikhoabieu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $thoikhoabieu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center;"><?php echo e($key+1); ?></td>
                        <td style="vertical-align: middle;"><a href="danhgia/<?php echo e($thoikhoabieu->id); ?>/create"><?php echo e($thoikhoabieu->tengiangvien); ?></a></td>
                        <td style="vertical-align: middle;"><?php echo e($thoikhoabieu->tenmon); ?></td>
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
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                lengthMenu: "Số bản ghi trên 1 trang _MENU_ ",
                search: "Tìm kiếm",
                info: "Tổng cộng: <b>_TOTAL_</b> bản ghi",
                infoFiltered: '',
                zeroRecords: "Không tìm thấy bản ghi nào",
                infoEmpty: "Không có dữ liệu ",
                paginate: {
                    first: "Trang đầu",
                    previous: "Trang trước",
                    next: "Trang sau",
                    last: "Trang cuối"
                },
            },
            searching: false, paging: true, info: false,
            

        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/sinhvien/danhgia.blade.php ENDPATH**/ ?>