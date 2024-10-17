
<?php $__env->startSection('title', $header['seo_home']->name); ?>
<?php $__env->startSection('image', asset($header['seo_home']->image_path)); ?>
<?php $__env->startSection('keywords', $header['seo_home']->slug); ?>
<?php $__env->startSection('description', $header['seo_home']->value); ?>
<?php $__env->startSection('abstract', $header['seo_home']->slug); ?>
<?php $__env->startSection('canonical'); ?>
    <link rel="canonical" href="<?php echo e(makeLink('home')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(isset($sliders)): ?>
        <section class="slideshow">
            <div class="slide-box">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo e($item->name); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($supportHome)): ?>
        <section class="service pd-section-top pd-section-bottom" 
            style="background-image: url(<?php echo e(asset($supportHome->image_path1)); ?>)">
            <div class="ctnr">
                <div class="row js-center">
                    <?php $__currentLoopData = $supportHome->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="clm" style="--w-lg: 3; --w-md: 4; --w-sm: 6; --w-xs: 12;">
                            <div class="service-card">
                                <div class="service-img ta-center">
                                    <img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo e($item->name); ?>">
                                </div>
                                <div class="service-text">
                                    <h3 class="ta-center"><?php echo e($item->name); ?></h3>
                                    <div class="desc ta-center">
                                        <p><?php echo $item->value; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    

    <section class="destination pd-section-bottom" 
        style="background-image: url(<?php echo e(asset($ourTour->image_path1) ?? ''); ?>)">
        <div class="destination-body p-relative">   
            <div class="ctnr">
                <div class="row">
                    <div class="clm" style="--w-lg: 3.2; --w-xs: 12;">
                        <h4 class="title-small"><?php echo e($ourTour->name ?? ''); ?></h4>
                        <h2 class="title-section"><?php echo $ourTour->value ?? ''; ?></h2>
                        <div class="desc">
                            <?php echo $ourTour->description ?? ''; ?>

                        </div>
                        <?php if(isset($listAttr)): ?>
                            <ul class="d-flex fw-wrap">
                                <?php $__currentLoopData = $listAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $countAttrId = App\Models\ProductAttribute::where('attribute_id', $item->id)->pluck('product_id')->toArray();
                                        $coutAttr = App\Models\Product::whereIn('id', $countAttrId)->where('active', 1)->count();
                                    ?>
                                    <li>
                                        
                                        <a href="<?php echo e(route('listAttribute', ['name' => str_replace(' ', '-', $item->name), 'attribute' => $item->id])); ?>" value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?><span>(<?php echo e($coutAttr); ?>)</span></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="slide-images p-absolute right-0 top-0 bottom-0" style="--w-lg:7.6;">
                    <?php if(isset($listAttr)): ?>
                        <div class="slide-images-body slide-4 h-100">
                            <?php $__currentLoopData = $listAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $countAttrId = App\Models\ProductAttribute::where('attribute_id', $item->id)->pluck('product_id')->toArray();
                                    $coutAttr = App\Models\Product::whereIn('id', $countAttrId)->where('active', 1)->count();
                                ?>
                                <div class="slide-images-box h-100 p-relative">
                                    <a href="<?php echo e(route('listAttribute', ['name' => str_replace(' ', '-', $item->name), 'attribute' => $item->id])); ?>" class="d-block w-100 h-100 hover-effect_1">
                                        <img class="h-100 w-100" src="<?php echo e(asset($item->image)); ?>" alt="<?php echo e($item->name); ?>">
                                        <div class="slide-images-text p-absolute top-0 left-0 right-0 bottom-0">
                                            <div class="d-flex ai-end w-100 js-between">
                                                <h3><?php echo e($item->name); ?></h3>
                                                <span><?php echo e($coutAttr); ?> Tours</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if(isset($videoHome)): ?>
        <section class="video pd-section-bottom">
            <div class="ctnr">
                <div class="video-body overlay p-relative"
                    style="background-image: url(<?php echo e(asset($videoHome->image_path1)); ?>);">
                    <div class="row ai-center p-relative ">
                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                            
                            <h2 class="title-section cl--white">
                                <?php echo e($videoHome->name); ?>

                            </h2>
                            <div class="desc">
                                <p class="cl--white"><?php echo $videoHome->description; ?></p>
                            </div>
                            <a href="<?php echo e($videoHome->slug); ?>" class="see-more d-flex ai-center">
                                Watch more testimonials
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z" />
                                </svg>
                            </a>
                        </div>
                        <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                            <div class="video-box p-relative">

                                <a href="<?php echo $videoHome->value; ?>" data-fancybox="video">
                                    <iframe class="w-100" src="<?php echo $videoHome->value; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($productHot)): ?>
        <section class="products pd-section-top pd-section-bottom" 
            style="background-image: url(<?php echo e(asset($title_pr_hot->image_path1)); ?>)">
            <div class="ctnr">
                <?php if(isset($title_pr_hot)): ?>
                    <h4 class="title-small ta-center"><?php echo e($title_pr_hot->name); ?></h4>
                    <h2 class="title-section ta-center"><?php echo e($title_pr_hot->value); ?></h2>
                <?php endif; ?>
                <div class="row js-center pd-section-content">
                    <?php $__currentLoopData = $productHot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="clm" style="--w-lg: 4; --w-md: 6; --w-sm: 6; --w-xs: 12;">
                            <div class="products-card">
                                <a href="<?php echo e($product->slug); ?>" class="products-card__img d-block hover-effect_1">
                                    <img src="<?php echo e(asset($product->avatar_path)); ?>" alt="<?php echo e($product->name); ?>">
                                </a>
                                <div class="products-card-content">
                                    <a href="<?php echo e($product->slug); ?>">
                                        <h3><?php echo e($product->name); ?></h3>
                                    </a>
                                    <ul class="d-flex">
                                        <li><?php echo e($product->masp); ?></li>
                                        <li><?php echo e($product->content2); ?></li>
                                        <li class="d-flex ai-center">
                                            <?php echo e($product->number); ?> days
                                        </li>
                                        <li class="d-flex ai-center trip-map" data-id="<?php echo e($product->id); ?>">
                                            Trip map
                                        </li>
                                    </ul>
                                    <div class="desc">
                                        <?php echo $product->description; ?>

                                    </div>
                                    <div class="d-flex ai-end js-between products-card-bottom">
                                        <a href="<?php echo e($product->slug); ?>" class="see-more">
                                            Details
                                        </a>
                                        <div class="price">
                                            <div class="price-top">
                                                Price from: <span>$<?php echo e(number_format($product->price)); ?></span>
                                                 
                                            </div>
                                            <div class="price-bottom">
                                                Per Person (Group of 2)
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($create_trip)): ?>
        <section class="list-create pd-section-top pd-section-bottom">
            <div class="ctnr">
                <div class="row ai-center">
                    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                        <div class="list-create-img">
                            <img src="<?php echo e(asset($create_trip->image_path)); ?>" alt="<?php echo e($create_trip->name); ?>">
                        </div>
                    </div>
                    <div class="clm" style="--w-lg: 6; --w-xs: 12;">
                        <div style="--w-lg: 10; --w-xs: 12;">
                            <h2 class="title-section">
                                <?php echo e($create_trip->name); ?>

                            </h2>
                            <div class="desc">
                                <p><?php echo $create_trip->description; ?></p>
                            </div>
                            <?php $__currentLoopData = $create_trip->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-create-box d-flex ai-center">
                                    <div class="list-create__img">
                                        <img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo e($item->name); ?>">
                                    </div>
                                    <div class="list-create-content flex-1">
                                        <h3><?php echo e($item->name); ?></h3>
                                        <div class="desc">
                                            <p><?php echo e($item->value); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($create_trip->slug); ?>" class="see-more see-more--border d-flex ai-center">
                                Learn more
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($feel_customer)): ?>
        <section class="customer pd-section-top pd-section-bottom">
            <div class="ctnr">
                <h4 class="title-small ta-center"><?php echo e($feel_customer->name); ?></h4>
                <h2 class="title-section ta-center">
                    <?php echo e($feel_customer->value); ?>

                </h2>
                <div class="desc" style="--w-lg: 6; --w-md: 8; --w-xs: 11.5; margin: 0 auto;">
                    <?php echo $feel_customer->description; ?>

                </div>
                <div class="customer-body customer-slide pd-section-content">
                    <?php $__currentLoopData = $feel_customer->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="customer-box ta-center">
                        <div class="customer-img">
                                <img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo $item->name; ?>">
                            </div>
                            <h3><?php echo $item->name; ?></h3>
                            <ul class="star d-flex ai-center js-center">
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                                    </svg>
                                </li>
                            </ul>
                            <div class="desc">
                                <p><?php echo $item->description; ?></p>
                            </div>
                           
                           
                           
                           <a href="<?php echo $item->slug; ?>" class="d-flex js-center ai-center">Read full review
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                           </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($certificate)): ?>
        <section class="partner">
            <div class="ctnr">
                <div class="slide-4">
                    <?php $__currentLoopData = $certificate->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="partner-box">
                            <a href="<?php echo e($item->slug); ?>"><img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo e($item->name); ?>"></a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($hotImage)): ?>
        <section class="picture pd-section-top">
            <div class="ctnr">
                <div class="inta">
                    <a href="<?php echo e($hotImage->slug); ?>" target="_blank" class=" d-flex ai-center">
                        <img src="<?php echo e(asset($hotImage->image_path)); ?>" alt="<?php echo e($hotImage->name); ?>">
                        <?php echo e($hotImage->name); ?>

                    </a>
                </div>
                <div class="row pd-section-content">
                    <?php $__currentLoopData = $hotImage->childs()->where('active', 1)->orderBy('order')->limit(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="clm" style="--w-lg: 4; --w-md: 4; --w-sm: 6; --w-xs: 12;">
                            <div class="picture-box">
                                <a href="<?php echo e($item->slug); ?>" target="_blank" class="hover-effect_1 d-block">
                                    <img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo e($item->name); ?>">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($postHot)): ?>
        <section class="news pd-section-bottom pd-section-top">
            <div class="ctnr">
                <?php if(isset($title_post_hot)): ?>
                    <h4 class="title-small ta-center"><?php echo e($title_post_hot->name); ?></h4>
                    <h2 class="title-section ta-center"><?php echo e($title_post_hot->value); ?></h2>
                <?php endif; ?>
                <div class="row">
                    <?php $__currentLoopData = $postHot; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="clm" style="--w-lg: 4; --w-md: 4; --w-sm: 6; --w-xs: 12; ">
                            <div class="news-box">
                                <a href="<?php echo e($post->slug); ?>" class="d-block hover-effect_1">
                                    <img src="<?php echo e(asset($post->avatar_path)); ?>" alt="<?php echo e($post->name); ?>">
                                </a>
                                <div class="news-category">
                                    <?php echo e($post->category->name); ?>

                                </div>
                                <a href="<?php echo e($post->slug); ?>"><h3><?php echo e($post->name); ?></h3></a>
                                <div class="desc">
                                    <p><?php echo $post->description; ?></p>
                                </div>
                                <a href="<?php echo e($post->slug); ?>" class="d-flex ai-center see-more">
                                    Devami
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(isset($partner)): ?>
        <div class="partner-second">
            <section class="partner ">
                <div class="ctnr">
                    <div class="slide-5">
                        <?php $__currentLoopData = $partner->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="partner-box">
                                <a href="<?php echo e($item->slug); ?>"><img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo e($item->name); ?>"></a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
   $(".customer-slide").slick({
            dots: false,
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            prevArrow: '<button type="button" class="slick-custom-arrow slick-prev prev-product-lq-slick"> <span>Previous</span> <div class="line"></div> </button>',
            nextArrow: '<button type="button" class="slick-custom-arrow slick-next next-product-lq-slick">  <div class="line"></div> <span>Next</span> </button>',
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        autoplaySpeed: 2000,
                    }
                },
                {
                    breakpoint: 786,
                    settings: {
                        slidesToShow: 2,
                        autoplaySpeed: 2000,
                    }
                },
                {
                    breakpoint: 552,
                    settings: {
                        slidesToShow: 1,
                        autoplaySpeed: 2000,
                    }
                }
            ]
        })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\MinhDuc\Desktop\custom_asia\resources\views/frontend/pages/home.blade.php ENDPATH**/ ?>