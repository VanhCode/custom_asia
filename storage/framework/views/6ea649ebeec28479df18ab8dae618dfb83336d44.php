<style>
    .menu_fix_mobile{
        overflow-y: scroll;
    }
    .contact-desktop{
        padding: 30px 50px;
    }
    .contact-desktop-top{
        margin-bottom: 40px !important;
    }
    .contact-desktop-picture{
        margin-bottom: 30px;
    }
    .contact-desktop-picture .row,
    .contact-desktop-picture .clm{
        --gutter: 7px;
    }
    .contact-desktop-picture .picture-box{
        margin-bottom: 14px;
        border-radius: 8px;
        overflow: hidden;
    }
    .contact-desktop-info h2{
        color: #000000;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5em;
        margin-bottom: 40px;
    }
    .contact-desktop-info ul li {
     margin-bottom: 40px;
    }
    .contact-desktop-info ul li span{
        font-size: 16px;
        font-weight: 600;
        line-height: 1.5em;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 12px;
    }
    .contact-desktop-info ul li p{
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5em;
        letter-spacing: 0px;
        color: gray;
        padding-bottom: 0px;
    }
    .contact-desktop-social li a{
        padding: 0 !important;
        height: 45px!important;
        width: 45px!important;
        display: flex!important;
        justify-content: center!important;
        align-items: center!important;
        background-color: #d67b4c!important;
        border-radius: 4px!important;
    }
    .contact-desktop-social li{
        width: fit-content !important;
        margin-right: 10px !important;
    }
    .contact-desktop-social li a svg{
        fill: white;
        height: 17px;
    }
    .contact-desktop-social li a svg path{
        fill: white;
    }
    .contact-desktop-desc{
        font-size: 16px;
        color: #686868;
        margin-top: 10px;
    }
    .close-menu span{
        display: none;
    }
    .nav-main{
        display: none;
    }
    @media (max-width: 1200px) {
        .close-menu span{
            display: block;
        }
        .contact-desktop{
            display: none;
        }
        .nav-main{
            display: block;
        }
    }
</style>
<div class="menu_fix_mobile">
    <div class="close-menu">
        <a href="javascript:;" id="close-menu-button" class="btn-menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
            </svg>
        </a>
        
    </div>

    <div class="contact-desktop">
        <?php if(isset($header['logo'])): ?>
            <div class="contact-desktop-top" style="--w-lg: 8; --w-xs: 12; margin: 0 auto;">
                <div class="contact-desktop__img">
                    <a href="/">
                        
                        <img src="<?php echo e(asset($header['logo']['image_path'])); ?>" alt="<?php echo e($header['logo']['name']); ?>">
                    </a>
                </div>
                <div class="contact-desktop-desc ta-center">
                    <?php echo $header['logo']['value']; ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(isset($header['categoryProductHot'])): ?>
            <div class="contact-desktop-picture">
                <?php $__currentLoopData = $header['categoryProductHot']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cateChilds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <?php $__currentLoopData = $cateChilds->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="clm" style="--w-xs: 4;">
                                <div class="picture-box">
                                    <img src="<?php echo e(asset($cate->avatar_path)); ?>" alt="<?php echo e($cate->name); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        
        
        
        <?php if(isset($header['contact'])): ?>
            <div class="contact-desktop-info">
                <h2><?php echo e($header['contact']['name']); ?></h2>
                <?php echo $header['contact']['description']; ?>

            </div>
        <?php endif; ?>
        
        <?php if(isset($header['network'])): ?>
            <div class="contact-desktop-info contact-desktop-social">
                <h2><?php echo e($header['network']['name']); ?></h2>
                <ul class="d-flex">
                    <?php $__currentLoopData = $header['network']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e($item->slug); ?>">
                                <?php echo $item->value; ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <ul class="nav-main">
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>
        
        <?php if(isset($header['introduce'])): ?>
            <div class="menu-product">
                <ul>
                    <li>
                        <div class="menu-mobile-1">
                            <a href="javascript:void(0);"><?php echo e($header['introduce']['name']); ?></a>
                            <?php if($header['introduce']->childs()->where('active', 1)->count() > 0): ?>
                                <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if($header['introduce']->childs()->where('active', 1)->count() > 0): ?>
                            <div class="menu-c2-mobile">
                                <ul>
                                    <?php $__currentLoopData = $header['introduce']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listAb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="menu-c2-mobiless">
                                            <div class="box-header2-mobile d-flex js-between">
                                                <a href="<?php echo e($listAb->slug_full); ?>"><?php echo e($listAb->name); ?></a>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if(isset($header['categoryProduct'])): ?>
            <?php $__currentLoopData = $header['categoryProduct']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="menu-product">
                    <ul>
                        <li>
                            <div class="menu-mobile-1">
                                <a href="javascript:void(0);"><?php echo e($listCate['name']); ?></a>
                                <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg></span>
                                <?php endif; ?>
                            </div>
                            <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                <div class="menu-c2-mobile">
                                    <ul>
                                        <?php $__currentLoopData = $listCate->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listAb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="menu-c2-mobiless">
                                                <div class="box-header2-mobile d-flex js-between">
                                                    <a href="<?php echo e($listAb->slug_full); ?>"><?php echo e($listAb->name); ?></a>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        
        <?php if(isset($header['categoryPost'])): ?>
            <?php $__currentLoopData = $header['categoryPost']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="menu-product">
                    <ul>
                        <li>
                            <div class="menu-mobile-1">
                                <a href="javascript:void(0);"><?php echo e($listCate['name']); ?></a>
                                <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg></span>
                                <?php endif; ?>
                            </div>
                            <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                <div class="menu-c2-mobile">
                                    <ul>
                                        <?php $__currentLoopData = $listCate->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listAb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="menu-c2-mobiless">
                                                <div class="box-header2-mobile d-flex js-between">
                                                    <a href="<?php echo e($listAb->slug_full); ?>"><?php echo e($listAb->name); ?></a>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(makeLink('contact')); ?>">Help me plan my trip</a>
        </li>
    </ul>
</div>
<header class="header-fix-mobile" style="background-image: url('https://elementor-kits-03.nicdark.com/travel-booking-wordpress-elementor-kit/wp-content/uploads/sites/8/2024/03/clear-08.jpg');">
    <div class="ctnr-fluid">
        <div class="header-content d-flex ai-center js-between">
            <div class="list-bar list-bar--mobile btn-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="header-logo d-flex ai-center">
                <div class="list-bar list-bar--desktop btn-menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <?php if(isset($header['logo'])): ?>
                    <a href="/" class="d-block">
                        <img src="<?php echo e(asset($header['logo']['image_path'])); ?>"
                            alt="<?php echo e($header['logo']['name']); ?>">
                    </a>
                <?php endif; ?>
            </div>
            <div class="header-menu  d-flex ai-center">
                <nav>
                    <ul class="d-flex ai-center">
                        <li>
                            <a href="/" class="d-flex ai-center">Home</a>
                        </li>

                        <?php if(isset($header['introduce'])): ?>
                            <li>
                                <a href="<?php echo e($header['introduce']->childs()->where('active', 1)->count() > 0 ? 'javascript:void(0)' : $header['introduce']->slug_full); ?>" 
                                    class="d-flex ai-center"><?php echo e($header['introduce']['name']); ?>

                                    <?php if($header['introduce']->childs()->where('active', 1)->count() > 0): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                        </svg>
                                    <?php endif; ?>
                                </a>
                                <?php if($header['introduce']->childs()->where('active', 1)->count() > 0): ?>
                                    <ul>
                                        <?php $__currentLoopData = $header['introduce']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listAb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e($listAb->slug_full); ?>"><?php echo e($listAb->name); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <?php if(isset($header['categoryProduct'])): ?>
                            <?php $__currentLoopData = $header['categoryProduct']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($listCate->childs()->where('active', 1)->count() > 0 ? 'javascript:void(0)' : $listCate->slug_full); ?>" 
                                        class="d-flex ai-center"><?php echo e($listCate['name']); ?>

                                        <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                            </svg>
                                        <?php endif; ?>
                                    </a>
                                    <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                        <ul>
                                            <?php $__currentLoopData = $listCate->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e($cate->slug_full); ?>"><?php echo e($cate->name); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if(isset($header['categoryPost'])): ?>
                            <?php $__currentLoopData = $header['categoryPost']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listCate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($listCate->slug_full); ?>" 
                                        class="d-flex ai-center"><?php echo e($listCate['name']); ?>

                                        <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path
                                                    d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                            </svg>
                                        <?php endif; ?>
                                    </a>
                                    <?php if($listCate->childs()->where('active', 1)->count() > 0): ?>
                                        <ul>
                                            <?php $__currentLoopData = $listCate->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <a href="<?php echo e($cate->slug_full); ?>"><?php echo e($cate->name); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php if(isset($header['hotline'])): ?>
                    <div class="hotline ai-center">
                        <a class="d-flex" target="_blank" href="<?php echo e($header['hotline']['slug']); ?>">
                            <?php echo $header['hotline']['value']; ?>

                            <?php echo e($header['hotline']['name']); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="header-btn-plan">
                <div class="btn-plan">
                    <a href="<?php echo e(makeLink('contact')); ?>">
                        <span>Help me plan my trip</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
 document.addEventListener('DOMContentLoaded', function() {
        var tinTucLinks = document.querySelectorAll('.menu-mobile-1 span');
        tinTucLinks.forEach(function(tinTucLink) {
            tinTucLink.addEventListener('click', function(event) {
                event.preventDefault();

                var menuC2Mobile = tinTucLink.parentElement.nextElementSibling;

                if (menuC2Mobile && menuC2Mobile.classList.contains('menu-c2-mobile')) {
                    menuC2Mobile.classList.toggle('active-2');
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var header = document.querySelector('.header-fix-mobile');
        
        window.addEventListener('scroll', function () {
            if (window.scrollY >= 30) {
                header.classList.add('header-bg');
            } else {
                header.classList.remove('header-bg');
            }
        });
    });
</script><?php /**PATH C:\laragon\www\demo22\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>