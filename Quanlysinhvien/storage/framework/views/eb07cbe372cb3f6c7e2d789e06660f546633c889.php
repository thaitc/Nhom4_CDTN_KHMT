

<?php $__env->startSection('title','Quản lý học sinh'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header"><h4>Quản lý học sinh</h4></div>

<?php //Hiển thị thông báo thành công?>
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

<?php //Hiển thị form sửa học sinh?>
<p><a class="btn btn-primary" href="<?php echo e(url('/hocsinh')); ?>">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
	<center><h4>Sửa học sinh</h4></center>
	<form action="<?php echo e(url('/hocsinh')); ?>" method="post">
		<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>" />
		<input type="hidden" id="id" name="id" value="<?php echo $getHocSinhById[0]->id; ?>" />
		<div class="form-group">
			<label for="tenhocsinh">Tên học sinh</label>
			<input type="text" class="form-control" id="tenhocsinh" name="tenhocsinh" placeholder="Tên học sinh" maxlength="255" value="<?php echo e($getHocSinhById[0]->tenhocsinh); ?>" required />
		</div>
		<div class="form-group">
			<label for="sodienthoai">Số điện thoại</label>
			<input type="text" class="form-control" id="sodienthoai" name="sodienthoai" placeholder="Số điện thoại" maxlength="15" value="<?php echo e($getHocSinhById[0]->sodienthoai); ?>" required />
		</div>
		<center><button type="submit" class="btn btn-primary">Lưu lại</button></center>
	</form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\thaitc\resources\views/hocsinh/edit.blade.php ENDPATH**/ ?>