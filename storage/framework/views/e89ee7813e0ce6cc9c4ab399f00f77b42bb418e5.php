<footer class="">
    <div class="ctnr">
        <div class="row js-center">
            <div class="clm" style="--w-xs: 12;">
                <?php if(isset($footer['tags'])): ?>
                    <div class="tags p-relative">
                        <ul class="d-flex fw-wrap">
                            <?php $__currentLoopData = $footer['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e($item->slug); ?>"><?php echo e($item->name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <div class="clm" style="--w-lg: 12; --w-xs: 12;">
                <div class="row js-between">
                    <div class="clm" style="--w-lg: 4; --w-xs: 12;">
                        <?php if(isset($footer['address'])): ?>
                            <div class="address-footer">
                                <h3 class="tt-up">
                                    <?php echo $footer['address']['name']; ?>

                                </h3>
                                <p><?php echo $footer['address']['value']; ?></p>
                                <ul>
                                    <?php $__currentLoopData = $footer['address']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a target="_blank" class="d-flex ai-center" href="<?php echo e($item->slug); ?>">
                                                <?php echo $item->value; ?>

                                                <?php echo $item->description; ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="footer-social js-between d-flex ai-center">
                            <?php if(isset($footer['socialNetwork'])): ?>
                                <ul class="d-flex ai-center">
                                    <?php $__currentLoopData = $footer['socialNetwork']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo $item->slug; ?>">
                                                <?php echo $item->value; ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="clm" style="--w-lg: 7; --w-xs: 12;">
                        <?php
                            $listAttr = App\Models\Attribute::where('active', 1)->where('parent_id', 1)->orderBy('order')->get();
                        ?>
                        <?php if(isset($header['categoryProduct'])): ?>
                            <div class="footer-infomation">
                                <ul class="d-flex fw-wrap js-between">
                                    <li class="">
                                        <span class="tt-up ta-center">
                                            Destinations:
                                        </span>
                                        <?php $__currentLoopData = $listAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('listAttribute', ['name' => str_replace(' ', '-', $item->name), 'attribute' => $item->id])); ?>" value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </li>

                                    

                                    <?php if(isset($header['introduce'])): ?>
                                        <li class="">
                                            <span class="tt-up ta-center">
                                                <?php echo e($header['introduce']['name']); ?>:
                                            </span>
                                            <?php $__currentLoopData = $header['introduce']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listAb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($listAb->slug_full); ?>"><?php echo e($listAb->name); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(isset($footer['general'])): ?>
                                        <li class="">
                                            <span class="tt-up ta-center">
                                                <?php echo e($footer['general']['name']); ?>:
                                            </span>
                                            <?php $__currentLoopData = $footer['general']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($item->slug); ?>"><?php echo e($item->name); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </li>
                                    <?php endif; ?>

                                    <?php if(isset($footer['commun'])): ?>
                                        <li class="">
                                            <span class="tt-up ta-center">
                                                <?php echo e($footer['commun']['name']); ?>:
                                            </span>
                                            <?php $__currentLoopData = $footer['commun']->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($item->slug); ?>"><?php echo e($item->name); ?></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if(isset($footer['form'])): ?>
                            <div class="footer-signup">
                                <div class="footer-signup-body">
                                    <h2><?php echo e($footer['form']['name']); ?></h2>
                                    <form class="d-flex fw-wrap" action="<?php echo e(route('contact.storeAjax')); ?>"
                                        data-url="<?php echo e(route('contact.storeAjax')); ?>" data-ajax="submitEmail"
                                        data-target="alert" data-href="#modalAjax" data-content="#content"
                                        data-method="POST" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input class="flex-1" type="text" name="name"
                                            placeholder="Enter your name">
                                        <input class="flex-1" type="text" name="email"
                                            placeholder="email@customasiatravel" style="width: 70%">
                                        <button type="submit">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php if(isset($footer['coppy_right'])): ?>
    <section class="coppyright">
        <div class="ctnr">
            <div class="coppyright-text">
                <?php echo $footer['coppy_right']['description']; ?>

            </div>
        </div>
    </section>
<?php endif; ?>

<script>
    $(document).on('submit', "[data-ajax='submitEmail']", function(event) {
        event.preventDefault();
        let myThis = $(this);
        let formValues = $(this).serialize();
        let dataInput = $(this).data();

        var nameVal = myThis.find('[name="name"]').val().trim();
        var emailVal = myThis.find('[name="email"]').val().trim();
        let isEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

        if (nameVal === '') {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please enter name!',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

        if (emailVal === '') {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please enter email!',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        } else if (!(isEmail.test(emailVal))) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Please enter a valid email!',
                showConfirmButton: false,
                timer: 1500
            });
            return false;
        }

        $.ajax({
            type: dataInput.method,
            url: dataInput.url,
            data: formValues,
            dataType: "json",
            success: function(response) {
                if (response.code == 200) {
                    myThis.find('input:not([type="hidden"]), textarea:not([type="hidden"])').val(
                        '');
                    if (dataInput.content) {
                        $(dataInput.content).html(response.html);

                    }
                    if (dataInput.target) {
                        switch (dataInput.target) {
                            case 'modal':
                                $(dataInput.href).modal();
                                break;
                            case 'alert':
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.html,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            default:
                                break;
                        }
                    }
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: response.html,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            error: function(response) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gửi thông tin thất bại',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        return false;
    });
</script>
<?php /**PATH C:\Users\MinhDuc\Desktop\custom_asia\resources\views/frontend/partials/footer.blade.php ENDPATH**/ ?>