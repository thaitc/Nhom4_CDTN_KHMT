

<?php $__env->startSection('title','Quản lý học sinh'); ?>

<?php $__env->startSection('content'); ?>

<?php //Hiển thị thông báo thành công?>
<div class="page-header"><h4>Quản lý học sinh</h4></div>

<?php if( Session::has('success') ): ?>
	<div class="alert alert-success alert-dismissible" role="alert">
		<strong><?php echo e(Session::get('success')); ?></strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
<?php endif; ?>

<?php //Hiển thị thông báo lỗi?>
<?php if( Session::has('error') ): ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<strong><?php echo e(Session::get('error')); ?></strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
	</div>
<?php endif; ?>

<?php //Hiển thị danh sách học sinh?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="table-responsive">
			<p><a class="btn btn-primary" href="<?php echo e(url('/hocsinh/create')); ?>">Thêm mới</a></p>
			<table id="DataList" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên học sinh</th>
						<th>Số điện thoại</th>
						<th>Sửa</th>
						<th>Xóa</th>
					</tr>
				</thead>
				<tbody>
				<?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
				<?php $__currentLoopData = $listhocsinh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hocsinh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<?php //Điền số thứ tự?>
						<td><?php echo e($key+1); ?></td>
						<?php //Lấy tên học sinh?>
						<td><?php echo e($hocsinh->tenhocsinh); ?></td>
						<?php //Lấy số điện thoại?>
						<td><?php echo e($hocsinh->sodienthoai); ?></td>
						<?php //Tạo nút sửa học sinh?>
						<td><a href="hocsinh/<?php echo e($hocsinh->id); ?>/edit">Sửa</a></td>
						<?php //Tạo nút xóa học sinh?>
						<td><a href="hocsinh/<?php echo e($hocsinh->id); ?>/delete">Xóa</a></td>
					</tr>
				<?php //Kết thúc vòng lập foreach?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\thaitc\resources\views/hocsinh/list.blade.php ENDPATH**/ ?>