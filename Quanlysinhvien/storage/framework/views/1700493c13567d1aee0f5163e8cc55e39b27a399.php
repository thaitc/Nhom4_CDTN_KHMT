
<?php $__env->startSection('title','Liên hệ'); ?>
<?php $__env->startSection('content'); ?>
<style>
    .container {
        width: 30%;
        margin: auto;
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }

    input[type=text] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }
</style>
<div class="row">
    <table>
        <?php $__currentLoopData = $lienhe; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>
                <h7 class="a"><label>Hòm thư: <?php echo e($lh->email); ?></label></h7>
            </td>
        </tr>

        <tr>
            <td style="width: 800px">Nội dung: <?php echo e($lh->noidung); ?> </td>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tr>


    </table>
</div>
<hr />
<div class="row">
    <form action="<?php echo e(url('lienhe/update')); ?>" method="post">
        <label for="lname">Email</label>
        <input type="text" id="email" class="form-control" name="email" placeholder="Nhập email...">
        <label for="country">Số Điện Thoại</label>
        <textarea id="noidung" class="form-control" name="noidung" placeholder="Nhập nội dung..."></textarea>
        <area></area>
        <button type="submit" class="btn btn-primary">Thêm</button>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Quanlysinhvien\resources\views/lienhe.blade.php ENDPATH**/ ?>