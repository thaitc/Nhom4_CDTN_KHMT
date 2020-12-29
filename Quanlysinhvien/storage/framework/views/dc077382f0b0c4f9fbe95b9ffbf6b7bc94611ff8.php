
<?php $__env->startSection('title','Trang quản lý'); ?>
<?php $__env->startSection('content'); ?>
<?php //Hiển thị thông báo thành công
?>
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
<link href="/Quanlytruonghoc/resources/css/login.css" rel="stylesheet" >
<div class="wrapper fadeInDown">
	<div id="formContent">
		<!-- Tabs Titles -->

		<!-- Icon -->
		<div class="fadeIn first">
			<img src="/Quanlytruonghoc/logo.png" id="icon" alt="User Icon" />
		</div>

		<!-- Login Form -->
		<form role="form" method="POST" action="<?php echo e(url('/register')); ?>">
			<?php echo csrf_field(); ?>

			<input class="fadeIn first" placeholder="Họ và tên" name="name" type="text" value="<?php echo e(old('name')); ?>" autofocus>
			<input placeholder="Email" name="email" type="text" value="<?php echo e(old('email')); ?>" autofocus class="fadeIn ">
			<input placeholder="Mật khẩu" name="password" type="password" class="fadeIn">
			<input class="fadeIn" placeholder="Xác nhận mật khẩu" name="password_confirmation" type="password">
			<input type="submit" class="fadeIn fourth" value="Đăng Ký">
		</form>

		<!-- Remind Passowrd -->
		<div id="formFooter">
			<a href="<?php echo e(url('/login')); ?>" style="text-decoration: none;" class="underlineHover">Về Đăng nhập</a>
		</div>
		
	</div>
</div>
<br/>
<style>
	body {
		background: url('/Quanlytruonghoc/img/bia2.png');
	}

	.panel {
		border-radius: 5px;
	}

	.panel-heading {
		padding: 10px 15px;
	}

	.panel-title {
		text-align: center;
		font-size: 15px;
		font-weight: bold;
		color: #17568C;
	}

	.panel-footer {
		padding: 1px 15px;
		color: #A0A0A0;
	}

	.profile-img {
		width: 120px;
		height: 120px;
		margin: 0 auto 10px;
		display: block;
		-moz-border-radius: 50%;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\thaitc\resources\views/auth/register.blade.php ENDPATH**/ ?>