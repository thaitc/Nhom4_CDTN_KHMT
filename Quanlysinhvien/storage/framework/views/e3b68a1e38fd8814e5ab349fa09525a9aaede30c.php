
<?php $__env->startSection('title','Điểm học tập'); ?>
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
    <div class="col-md-6">
        Điểm TB chung: <?php echo e($diemtb); ?> |
        Xếp loại:
        <?php if ((float)($diemtb) == null) { ?> Null <?php } ?>
        <?php if ((float)($diemtb) < 5 && (float)($diemtb) >0) { ?> Yếu <?php } ?>
        <?php if ((float)($diemtb) < 6.5 && (float)($diemtb) >=5) { ?> Trung bình <?php } ?>
        <?php if ((float)($diemtb) >= 8) { ?> Giỏi <?php } ?>
        <?php if ((float)($diemtb) < 8 && (float)($diemtb) >= 6.5) { ?> Khá <?php } ?>
    </div>

</div>
<br />
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên môn</th>
                        <th>Điểm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $getSinhVienById; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $diem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center; vertical-align: middle;"><?php echo e($key+1); ?></td>
                        <td style="vertical-align: middle;"><a href="#"><?php echo e($diem->tenmon); ?></a></td>
                        <td style="text-align: center; vertical-align: middle;">
                            <?php echo e($diem->diem); ?>

                        </td>
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
    $(document).ready(function () {
        $('#example').DataTable({
            language: {
                lengthMenu: "Số bản ghi trên 1 trang _MENU_ ",
                search: "Tìm kiếm",
                info: "Tổng cộng: <b>_TOTAL_</b> bản ghi",
                infoFiltered:'',
                zeroRecords: "Không tìm thấy bản ghi nào",
                infoEmpty: "Không có dữ liệu ",
                paginate: {
                    first: "Trang đầu",
                    previous: "Trang trước",
                    next: "Trang sau",
                    last: "Trang cuối"
                },
            }

        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/diemhoctap.blade.php ENDPATH**/ ?>