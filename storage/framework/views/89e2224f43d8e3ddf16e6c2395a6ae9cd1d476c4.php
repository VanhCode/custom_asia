<style>
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #fff !important;
    }

    @import  url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap');

    .nav-item i {
        padding-right: 5px;
    }

    .nav-sidebar>.nav-item a p {
        font-size: 14px;
    }

    .nav-treeview>.nav-item>.nav-link {
        color: #eee;
        padding: 4px 20px 4px 32px;
    }

    .nav-item i {
        color: #b3cbdd;
        padding-right: 5px;
    }

    .nav-treeview>.nav-item>.nav-link p {
        font-size: 12px;
        color: #b3cbdd
    }

    .nav-treeview>.nav-item>.nav-link i {
        font-size: 12px;
        color: #b3cbdd
    }

    .sidebar {
        background: #2A3F54;
        padding: 0;
    }

    .sidebar a {
        color: #17a2b8;
    }

    .form-inline {
        padding: 15px 0;
    }

    .nav-sidebar>.nav-item {
        color: #b3cbdd;
        font-size: 14px;
        padding-left: 0px;
        border-bottom: 1px solid #25384c;
        border-top: 1px solid #304558;
    }
</style>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #2A3F54;">
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3  d-flex" style="padding: 0px 0 0 0;">
            <div class="image">
                <img src="<?php echo e(Auth::guard('admin')->user()->avatar_path ? Auth::guard('admin')->user()->avatar_path : asset('admin_asset/images/username.png')); ?>"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    <?php if(Auth::guard('admin')->check()): ?>
                        <?php echo e(Auth::guard('admin')->user()->name); ?>

                    <?php endif; ?>
                </a>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <?php
            $routerName = request()->route()->getName();
        ?>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.index')); ?>" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>BẢNG ĐIỀU KHIỂN</p>
                    </a>
                </li>

                

                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                            Quản lý tour
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-product-list')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.categoryproduct.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Danh mục tour</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-list')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.product.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Tour</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product-list')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.attribute.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Danh sách thuộc tính</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-globe-americas"></i>
                        <p>
                            Tin tức
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-post-list')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.categorypost.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Danh mục</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('post-list')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.post.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Tin tức</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.destination.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Danh sách điểm đến</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.topic.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Danh sách chủ đề</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.post.comment')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Danh sách bình luận</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                            Quản lý Thư viện
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.categorygalaxy.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Danh mục Video/Hình ảnh</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.galaxy.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Danh sách Video/Hình ảnh</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting-list')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.setting.index')); ?>" class="nav-link">
                            <i class="fas fa-cog"></i>
                            <p>Trang thông tin</p>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slider-list')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('admin.slider.index')); ?>" class="nav-link">
                            <i class="fas fa-images"></i>
                            <p>Quản lý slide</p>
                        </a>
                    </li>
                <?php endif; ?>
                
                
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.contact.booking')); ?>" class="nav-link">
                        <i class="fas fa-id-card-alt"></i>
                        <p>Thông tin liên hệ</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?php echo e(route('admin.code.index')); ?>" class="nav-link">
                        <i class="fas fa-cart-plus"></i>
                        <p>Quản lý Mã Code</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <p>
                            Hệ thống
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-user-list')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.user.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Quản trị viên</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-add')): ?>
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.role.index')); ?>" class="nav-link">
                                    <i class="fas fa-angle-double-right"></i>
                                    <p>Vai trò</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <p>
                            Suppliers
                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.service.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Service</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.service-full.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Service Full Tour</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.service-class.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Service class</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.service-other.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Service other</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.service-type.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Service type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.additional-fee.index')); ?>" class="nav-link">
                                <i class="fas fa-angle-double-right"></i>
                                <p>Additional Fee</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.my-trip.index')); ?>" class="nav-link">
                        <i class="fas fa-cart-plus"></i>
                        <p>My Trip</p>
                    </a>
                </li>
                
            </ul>
        </nav>
    </div>
</aside>
<?php /**PATH C:\Users\MinhDuc\Desktop\custom_asia\resources\views/admin/partials/sidebar.blade.php ENDPATH**/ ?>