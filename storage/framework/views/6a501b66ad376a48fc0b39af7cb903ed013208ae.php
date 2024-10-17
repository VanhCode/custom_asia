<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $__env->yieldContent('title'); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('font/fontawesome-5.13.1/css/all.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('lib/adminlte/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('lib/sweetalert2/css/sweetalert2.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('lib/select2/css/select2.min.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('admin_asset/css/stylesheet.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/lib/jquery-ui/jquery-ui.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/lib/leaflet/leaflet.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('lib/toastr/toastr.min.css')); ?>">
    <style>
        a.cke_dialog_tab:nth-child(2),
        a.cke_dialog_tab:nth-child(3) {
            display: none !important;
        }
    </style>
    <style>
        .delete-avatar {
            cursor: pointer;
        }

        .preview-avatar {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            background-color: #0000000f;
            border-radius: 5px;
            overflow: hidden;
            width: fit-content;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #000 !important;
        }

        .select2-container .select2-selection--single {
            height: auto;
        }

        .tinymce_editor_init {
            height: 300px !important;
        }

        .load-multiple-img2>img {
            width: 32%;
            border: 1px solid #eee;
            padding: 5px;
        }
    </style>
    <style>
        .col-image {
            position: relative;
        }

        .col-image input {
            position: absolute;
            width: 35px;
        }

        .image-list-small {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0 auto;
            text-align: center;
            max-width: 640px;
            padding: 0;
        }

        .image-list-small li {
            display: inline-block;
            width: 181px;
            margin: 0 12px 30px;
        }


        /* Photo */

        .image-list-small li>a {
            display: block;
            text-decoration: none;
            background-size: cover;
            background-repeat: no-repeat;
            height: 137px;
            margin: 0;
            padding: 0;
            border: 4px solid #ffffff;
            outline: 1px solid #d0d0d0;
            box-shadow: 0 2px 1px #DDD;
        }

        .image-list-small .details {
            margin-top: 13px;
        }


        /* Title */

        .image-list-small .details h3 {
            display: block;
            font-size: 12px;
            margin: 0 0 3px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .image-list-small .details h3 a {
            color: #303030;
            text-decoration: none;
        }

        .image-list-small .details .image-author {
            display: block;
            color: #717171;
            font-size: 11px;
            font-weight: normal;
            margin: 0;
        }

        /* map */
        #map {
            height: 500px;
            width: 100%;
        }

        .list-destination {
            margin-bottom: 0px;
        }

        .list-destination li {
            padding: 8px 10px;
            border-bottom: 1px solid #e8e8e8;
            cursor: pointer;
        }

        .list-destination li:last-child {
            border-bottom: unset
        }

        .list-destination li span {
            font-size: 14px;
            color: #000000A6
        }

        .list-destination li img {
            height: 21px;
            width: 21px;
        }

        .br-3 {
            border-radius: 3px
        }

        .ml-8 {
            margin-left: 8px
        }

        .mr-8 {
            margin-right: 8px
        }

        .trash-destination {
            display: none;
        }

        .list-destination li:hover .trash-destination {
            display: block;
            cursor: pointer;
            z-index: 100;
        }

        .move-destination {
            cursor: move
        }

        .info-location {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 24px;
        }

        .option-location:hover {
            background-color: #f0fcff;
            border: rgb(179, 214, 233);
            color: #000
        }


        .form-input-search {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            box-shadow: none;
            transition: all .3s cubic-bezier(.645, .045, .355, 1), height 0s;
        }

        .icon-input-search {
            position: absolute;
            top: 50%;
            left: 2%;
            z-index: 2;
            display: flex;
            align-items: center;
            color: rgba(0, 0, 0, .65);
            line-height: 0;
            transform: translateY(-50%);
        }

        #search {
            padding-left: 34px
        }

        .ui-widget-content.ui-autocomplete {
            max-height: 400px;
            overflow-x: auto;
        }

        .form-group__img {
            position: relative;
            margin-top: 15px;
        }

        .form-group__delete {
            position: absolute;
            right: 1px;
            top: 1px;
            height: 35px;
            width: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ce2033;
            border: 3px solid white;
        }

        .form-group__delete svg {
            height: 15px;
            fill: white;
        }

        .form-group .row .form-group__img {
            padding: 2px;
            border: 1px solid #d2d2d2;
        }

        .form-group .row .form-group__delete {
            height: 30px;
            width: 30px;
            border: 2px solid white;
        }


        .w-100 {
            width: 100%;
        }

        .d-flex {
            display: flex;
        }

        .flex-1 {
            flex: 1
        }

        .btn {
            height: 30px;
            border-radius: 4px;
            color: white;
            margin-bottom: 10px;
        }

        .btn-build {
            background-color: #2da446;
        }

        .btn-save {
            background-color: #0e808b;
        }

        .btn-back {
            background-color: #1d9ebb;
        }

        .btn-zezo {
            background-color: #a4a4a4;
        }

        .all-image img {
            width: 100%;
            object-fit: contain;
            height: 130px;
        }
    </style>
    <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php echo $__env->make('admin.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('lib/jquery/jquery-3.2.1.min.js')); ?> "></script>
    <script type="text/javascript" src="<?php echo e(asset('lib/bootstrap-4.5.3-dist/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/adminlte/js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/sweetalert2/js/sweetalert2.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/select2/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/lib/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_asset/ajax/deleteAdminAjax.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_asset/js/function.js')); ?>"></script>
    <script src="<?php echo e(asset('admin_asset/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('/lib/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('/lib/leaflet/leaflet.js')); ?>"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('lib/toastr/toastr.min.js')); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lfm = function(id, type, options) {
                let button = document.getElementById(id);

                button.addEventListener('click', function() {
                    var route_prefix = (options && options.prefix) ? options.prefix :
                        '/laravel-filemanager';
                    var target_input = document.getElementById(button.getAttribute('data-input'));
                    var target_preview = document.getElementById(button.getAttribute('data-preview'));

                    let fileManagerWindow = window.open(
                        route_prefix + '?type=' + type || 'file',
                        'FileManager',
                        'width=900,height=600'
                    );

                    window.SetUrl = function(items) {
                        var file_path = items.map(function(item) {
                            return item.url;
                        }).join(',');

                        // set the value of the desired input to image url
                        target_input.value = file_path;
                        target_input.dispatchEvent(new Event('change'));
                        fileManagerWindow.close()

                        // clear previous preview
                        target_preview.innerHTML = '';

                        // set or change the preview image src
                        items.forEach(function(item) {
                            let img = document.createElement('img');
                            img.setAttribute('style', 'height: 5rem');
                            img.setAttribute('src', item.thumb_url);
                            target_preview.appendChild(img);
                        });

                        // trigger change event
                        target_preview.dispatchEvent(new Event('change'));
                        // Đóng cửa sổ file manager sau khi chọn file
                    };

                });
            };

            const inputsFileChange = document.querySelectorAll('.input-file-change')

            inputsFileChange.forEach(element => {
                element.onchange = function(e) {
                    const randomId = Math.random().toString(36).slice(2, 7);
                    const wrapPreviewAvatar = document.querySelector(`.${this.id}-preview`);
                    wrapPreviewAvatar.innerHTML = `<div class="form-group__img preview-avatar" data-name="avatar_path">
                                                        <img src="${e.target.value}">
                                                        <div class="form-group__delete delete-avatar" id="btn-remove-${randomId}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome    - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path>
                                                            </svg>
                                                        </div>
                                                    </div>`;
                    const btnRemove = document.querySelector(`#btn-remove-${randomId}`);
                    btnRemove.addEventListener('click', () => {

                        document.getElementById(`${this.id}`).value = '';
                        wrapPreviewAvatar.innerHTML = `<img class="img-load border p-1 w-100"
                        src = "/admin_asset/images/upload-image.png"
                        style = "height: 200px;object-fit:cover; max-width: 260px;"/>`;
                    });
                }
            })

            const btnsRemove = document.querySelectorAll(`.delete-avatar`);
            btnsRemove.forEach(element => {
                element.onclick = function() {

                    document.getElementById(`${element.id}`).value = '';
                    element.parentElement.innerHTML = `<img class="img-load border p-1 w-100"
                        src = "/admin_asset/images/upload-image.png"
                        style = "height: 200px;object-fit:cover; max-width: 260px;"/>`;
                }
            })

            const btnsFileManager = document.querySelectorAll('.btn-file-manager');


            btnsFileManager.forEach(element => {
                var route_prefix = "/filemanager";

                lfm(`${element.id}`, 'Images', {
                    prefix: route_prefix
                });
            });

            let btnsFileMutipleManager = document.querySelector('.input-file-mutiple-change');
            const gallaryMutiplePreview = document.querySelector('.gallary-mutiple-preview');

            var route_prefix = "/filemanager";
            lfm(`gallary_id`, 'Images', {
                prefix: route_prefix
            });
            let oldGalleryArr = [];
            if (btnsFileMutipleManager) {
                oldGalleryArr = btnsFileMutipleManager.value.split(',')
            }
            btnsFileMutipleManager.onchange = function(e) {
                let listImage = [...e.target.value.split(','), ...oldGalleryArr];
                listImage = [...new Set(listImage.filter(item => item).map(item => item.substring(item.indexOf(
                    "/storage"))))]
                let html = '';
                listImage.forEach(element => {
                    const randomId = Math.random().toString(36).slice(2, 7);
                    html += ` <div class="col-6 form-group__img preview-avatar" data-name="avatar_path">
                                                            <img src="${element}">
                                                            <div class="form-group__delete delete-avatar-galary" id="btn-remove-${randomId}" data-link="${element}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome    - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                    <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path>
                                                                </svg>
                                                            </div>
                                                        </div>`;
                })
                gallaryMutiplePreview.innerHTML = html
                btnsFileMutipleManager.value = listImage.join(',')
                const btnsRemove = document.querySelectorAll(`.delete-avatar-galary`);
                btnsRemove.forEach(item => {
                    item.addEventListener('click', function() {
                        btnsFileMutipleManager = document.querySelector(
                            '.input-file-mutiple-change');
                        listImage = btnsFileMutipleManager.value.split(',')
                        const listImg = listImage.filter(link => link !== this
                            .dataset.link).join(',')
                        btnsFileMutipleManager.value = listImg
                        this.parentElement.remove()
                    });
                })


            }
            const btnsRemove1 = document.querySelectorAll(`.delete-avatar-galary`);

            if (btnsRemove1) {

                btnsRemove1.forEach(item => {

                    item.addEventListener('click', function() {

                        const listImage = btnsFileMutipleManager.value.split(',')

                        const listImg = listImage.filter(link => link !== this
                            .dataset.link).join(',')
                        btnsFileMutipleManager.value = listImg
                        this.parentElement.remove()
                    });
                })
            }
        })
    </script>
    <script type="module">
        <?php if(session('alert')): ?>
            toastr.success('<?php echo e(session('alert')); ?>', {
                timeOut: 5000
            })
        <?php elseif(session('error')): ?>
            toastr.error('<?php echo e(session('error')); ?>', {
                timeOut: 5000
            })
        <?php endif; ?>
    </script>
    <script>
        var myEnvValue = "<?php echo e(env('APP_URL')); ?>";
    </script>
    <?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\demo22\resources\views/admin/layouts/main.blade.php ENDPATH**/ ?>