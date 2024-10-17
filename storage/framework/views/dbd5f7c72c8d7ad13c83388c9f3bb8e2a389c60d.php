<?php $__env->startSection('content'); ?>
<style>
	body {
		font-family: 'Open Sans', sans-serif;
		background-color: #fff!important;
	}
	@import  url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap');
	.card-header {
		text-align: left;
		text-transform:uppercase;
		font-weight: 700;
		font-size: 20px;
	}
	.navbar-brand {
		font-size: 25px;
		font-weight:700; 
	}
	.container {
	}
	.card {
		background: #eee;
		margin-top: 50px;
	}
	.card-header {
		background: #a2000f;
		text-align: center;
		color: #fff;
	}
	.box_container {
		display: flex;
		align-items: center;
		justify-content: center;
		height: calc(100vh - 64px);
	}
	.card-body {
	}
	.navbar-light .navbar-brand {
		color: #a2000f
	}
	label:not(.form-check-label):not(.custom-file-label) {
		font-weight: 600;
	}
	.btn-primary {
		background: #a2000f;
		border: 0;
		padding: 5px 20px;
	}
	.btn-link {
		font-weight: 400;
		color: #a2000f;
		font-size: 15px;
		text-decoration: none;
	}
</style>
<div class="box_container">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Đăng nhập hệ thống quản trị</div>
					<div class="card-body">
						<form method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
							<?php echo csrf_field(); ?>
							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">Use Email</label>
								<div class="col-md-6">
									<input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
									<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<span class="invalid-feedback" role="alert">
											<strong><?php echo e($message); ?></strong>
										</span>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>
								<div class="col-md-6">
									<input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">
									<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<span class="invalid-feedback" role="alert">
											<strong><?php echo e($message); ?></strong>
										</span>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
										<label class="form-check-label" for="remember">
											Ghi nhớ đăng nhập
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button type="submit" class="btn btn-primary">
										Đăng Nhập
									</button>
									<?php if(Route::has('admin.password.request')): ?>
										<a class="btn btn-link" href="<?php echo e(route('admin.password.request')); ?>">
											Quên mật khẩu?
										</a>
									<?php endif; ?>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\demo22\resources\views/auth/admin-login.blade.php ENDPATH**/ ?>