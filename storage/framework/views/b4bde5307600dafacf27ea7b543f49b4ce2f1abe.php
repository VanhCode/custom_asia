<?php $__env->startSection('title', $seo['title'] ?? ''); ?>
<?php $__env->startSection('keywords', $seo['keywords'] ?? ''); ?>
<?php $__env->startSection('description', $seo['description'] ?? ''); ?>
<?php $__env->startSection('abstract', $seo['abstract'] ?? ''); ?>
<?php $__env->startSection('image', $seo['image'] ?? ''); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/categories.css')); ?>">
    <style>
        .products-card {
            margin-bottom: 20px;
        }

        .pd-section-top {
            padding-top: 50px;
        }

        .pd-section-bottom {
            padding-bottom: 50px;
        }

        .tour-search .desc p {
            padding-bottom: 0px;
        }

        @media (max-width: 586px) {
            .pd-section-bottom {
                padding-bottom: 30px;
            }

            .pd-section-top {
                padding-top: 30px;
            }
        }
    </style>
    <style>
        .price-progress,
        .length-progress {
            background: linear-gradient(to right, #1f2d5a 0%, #1f2d5a 0%, #e4e4e4 0%, #e4e4e4 100%);
            /* Màu ban đầu khi chưa kéo */
            height: 3px;
            width: 100%;
            outline: none;
            transition: background 450ms ease-in;
            -webkit-appearance: none;
        }
    </style>

    <style>
        .products-card-content h3 {
            font-size: 20px;
        }

        .products-card-content .desc p {
            font-size: 15px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    

    <section class="tour-search pd-section-bottom pd-section-top">
        <div class="ctnr">
            

            <div class="row js-between pd-section-content">
                <div class="clm" style="--w-lg: 12;">
                    <div class="btn-filter">
                        Tour Search
                    </div>
                </div>
                <div class="clm" style="--w-xl: 2.5;  --w-xs: 12;">
                    <div class="filter">
                        <div class="close-filter">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                            </svg>
                        </div>

                        <?php
                            $ourTour = App\Models\CategoryProduct::find(411);
                            $travelStyle = App\Models\CategoryProduct::find(446);
                        ?>
                        <?php if(isset($ourTour)): ?>
                            <div class="filter-box">
                                <h3 class="filter-title js-between d-flex ai-center">
                                    <?php echo e($ourTour->name); ?>:
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                    </svg>
                                </h3>
                                <?php if($ourTour->childs()->where('active', 1)->count() > 0): ?>
                                    <ul>
                                        <?php $__currentLoopData = $ourTour->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $catePro = new App\Models\CategoryProduct();
                                                $idCate = $catePro->getALlCategoryChildrenAndSelf($cate->id);
                                                $idPrd = App\Models\ProductCate::whereIn('category_id', $idCate)
                                                    ->pluck('product_id')
                                                    ->toArray();
                                                $countPr = App\Models\Product::whereIn('id', $idPrd)
                                                    ->where('active', 1)
                                                    ->count();
                                            ?>
                                            <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                <label data-filter="1" for="filter-1" class="ponovo">
                                                    <input type="checkbox" class="filter-checkbox cate-check"
                                                        value="<?php echo e($cate->id); ?>" data-operator="OR" name="category[]">
                                                    <i class="fa"></i>
                                                    <?php echo e($cate->name); ?>

                                                </label>
                                                <span>(<?php echo e($countPr); ?>)</span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="filter-box">
                            <h3 class="filter-title js-between d-flex ai-center">
                                Regions:
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                </svg>
                            </h3>
                            <?php if(isset($listAttr)): ?>
                                <ul>
                                    <?php $__currentLoopData = $listAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $countAttrId = App\Models\ProductAttribute::where('attribute_id', $item->id)->pluck('product_id')->toArray();
                                            $coutAttr = App\Models\Product::whereIn('id', $countAttrId)->where('active', 1)->count();
                                        ?>
                                        <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                            <label data-filter="1" for="filter-1" class="ponovo">
                                                <input type="checkbox" class="filter-checkbox attr-check"
                                                    value="<?php echo e($item->id); ?>" <?php if(request()->attribute==$item->id ): ?> checked <?php endif; ?> data-operator="OR" name="attributes[]">
                                                <i class="fa"></i>
                                                <?php echo e($item->name); ?>

                                            </label>
                                            <span>(<?php echo e($coutAttr); ?>)</span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="filter-box progress-box">
                            <h3 class="filter-title js-between d-flex ai-center">Max price:</h3>
                            <ul class="d-flex js-right">
                                <li>$ <span id="priceValue">0</span></li>
                            </ul>
                            <input type="range" value="0" min="0" max="<?php echo e($maxPrice); ?>" step="10"
                                class="progress price-progress" id="priceRange">
                        </div>
                        <div class="filter-box progress-box">
                            <h3 class="filter-title js-between d-flex ai-center">Length:</h3>
                            <ul class="d-flex js-between">
                                <li>min.</li>
                                <li><span id="lengthValue">1</span> days</li>
                                <li>15 days</li>
                            </ul>
                            <input type="range" value="1" min="1" max="15" step="1"
                                class="progress length-progress" id="lengthRange">
                        </div>

                        <?php if(isset($travelStyle)): ?>
                            <div class="filter-box">
                                <h3 class="filter-title js-between d-flex ai-center">
                                    <?php echo e($travelStyle->name); ?>:
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                                    </svg>
                                </h3>
                                <?php if($travelStyle->childs()->where('active', 1)->count() > 0): ?>
                                    <ul>
                                        <?php $__currentLoopData = $travelStyle->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $catePro = new App\Models\CategoryProduct();
                                                $idCate = $catePro->getALlCategoryChildrenAndSelf($cate->id);
                                                $idPrd = App\Models\ProductCate::whereIn('category_id', $idCate)
                                                    ->pluck('product_id')
                                                    ->toArray();
                                                $countPr = App\Models\Product::whereIn('id', $idPrd)
                                                    ->where('active', 1)
                                                    ->count();
                                            ?>
                                            <li class="filter-item filter-item--check-box d-flex ai-center js-between">
                                                <label data-filter="1" for="filter-1" class="ponovo">
                                                    <input type="checkbox" class="filter-checkbox cate-check"
                                                        value="<?php echo e($cate->id); ?>" data-operator="OR" name="category[]">
                                                    <i class="fa"></i>
                                                    <?php echo e($cate->name); ?>

                                                </label>
                                                <span>(<?php echo e($countPr); ?>)</span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="clm" style="--w-xl: 9.5; --w-xs: 12;">
                    <div class="row" id="filterResults">
                        <?php if(isset($data) && count($data) > 0): ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="clm" style="--w-lg: 4; --w-sm: 6; --w-xs: 12;">
                                    <div class="products-card">
                                        <a href="<?php echo e($item->slug_full); ?>" class="products-card__img d-block">
                                            <img class="d-block" src="<?php echo e(asset($item->avatar_path)); ?>"
                                                alt="<?php echo e($item->name); ?>">
                                        </a>
                                        <div class="products-card-content">
                                            <a href="<?php echo e($item->slug_full); ?>">
                                                <h3><?php echo e($item->name); ?></h3>
                                            </a>
                                            <ul class="d-flex">
                                                <li><?php echo e($item->masp); ?></li>
                                                <li><?php echo e($item->content2); ?></li>
                                                <li class="d-flex ai-center">
                                                    <?php echo e($item->number); ?> days
                                                </li>
                                                <li class="d-flex ai-center trip-map" data-id="<?php echo e($item->id); ?>">
                                                    Trip map
                                                </li>
                                            </ul>
                                            <div class="desc">
                                                <p><?php echo $item->description; ?></p>
                                            </div>
                                            <div class="d-flex ai-end js-between products-card-bottom">
                                                <a href="<?php echo e($item->slug_full); ?>" class="see-more">
                                                    Details
                                                </a>
                                                <div class="price">
                                                    <div class="price-top">
                                                        Price from: <span>$<?php echo e(number_format($item->price)); ?></span>
                                                    </div>
                                                    <div class="price-bottom">
                                                        Per person (Group of 2)
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        <?php else: ?>
                            <span class="Not-result">No matching results found</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script>
        function loadDataAjax(filterData, page = 1) {
            var allAttribute = [];
            $('.attr-check:checked').each(function() {
                if ($(this).val() !== undefined && $(this).val() !== '') {
                    allAttribute.push($(this).val());
                }
            })

            var allCategory = [];
            $('.cate-check:checked').each(function() {
                if ($(this).val() !== undefined && $(this).val() !== '') {
                    allCategory.push($(this).val());
                }
            })

            var price = $('#priceRange').val();
            var length = $('#lengthRange').val();

            $.ajax({
                type: 'POST',
                url: "/filter-products",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    price: price != 0 ? price : null,
                    length: length != 1 ? length : null,
                    category_id: allCategory,
                    attributes: allAttribute,
                    page: page
                },
                success: function(data) {
                    $('#filterResults').html(data.html);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $(document).ready(function() {
            // Khi thay đổi danh mục
            $('input[name="category[]"]').change(function() {
                loadDataAjax();
            });

            // Khi thay đổi thuộc tính
            $('input[name="attributes[]"]').change(function() {
                loadDataAjax();
            });

            // Khi thay đổi giá
            $('#priceRange').on('input', function() {
                var priceValue = $(this).val();
                $('#priceValue').text(priceValue);
                updateSliderBackground($(this), priceValue);
                loadDataAjax();
            });

            // Khi thay đổi thời gian
            $('#lengthRange').on('input', function() {
                var lengthValue = $(this).val();
                $('#lengthValue').text(lengthValue);
                updateSliderBackground($(this), lengthValue);
                loadDataAjax();
            });

            // Hàm cập nhật màu sắc của thanh trượt
            function updateSliderBackground($element, value) {
                var maxValue = $element.attr('max');
                var percentage = (value / maxValue) * 100;
                $element.css('background',
                    `linear-gradient(to right, #1f2d5a 0%, #1f2d5a ${percentage}%, #e4e4e4 ${percentage}%, #e4e4e4 100%)`
                );
            }
        });
    </script>


    
    


    
    

    <script>
        document.querySelector('.btn-filter').addEventListener('click', function() {
            document.querySelector('.filter').classList.add('active');
        });

        document.querySelector('.close-filter').addEventListener('click', function() {
            document.querySelector('.filter').classList.remove('active');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\demo22\resources\views/frontend/pages/product-by-category1.blade.php ENDPATH**/ ?>