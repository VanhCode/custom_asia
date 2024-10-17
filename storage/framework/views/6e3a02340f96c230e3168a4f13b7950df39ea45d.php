<?php $__env->startSection('title', $seo['title'] ?? ''); ?>
<?php $__env->startSection('keywords', $seo['keywords'] ?? ''); ?>
<?php $__env->startSection('description', $seo['description'] ?? ''); ?>
<?php $__env->startSection('abstract', $seo['abstract'] ?? ''); ?>
<?php $__env->startSection('image', $seo['image'] ?? ''); ?>
<?php $__env->startSection('canonical'); ?>
    <link rel="canonical" href="<?php echo e($data->slug_full); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/prd-detail.css')); ?>">
    <style>
        /* Container chính chứa ảnh */
		.tour-detail-content_box img{
			width: 100%;
		  	border-radius: 10px;
		}
        .image-container {
            width: 300px;
            height: 300px;
            cursor: pointer;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            transition: transform 0.4s ease-in-out;
            /* Phóng to nhẹ khi hover với thời gian dài hơn */
        }

        /* Hiệu ứng nhỏ khi hover */
        .image-container:hover img {
            transform: scale(1.08);
            /* Phóng to nhẹ khi hover */
        }

        /* Lớp overlay cho toàn màn hình */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            /* Màu nền mờ */
            display: none;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.6s ease;
            /* Hiệu ứng fade-in và fade-out mượt hơn */
            z-index: 1000;
        }

        /* Ảnh phóng to trong lớp overlay */
        .overlay img {
            max-width: 85%;
            max-height: 85%;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.9);
            /* Hiệu ứng bóng rõ hơn */
            transform: scale(0.7);
            /* Bắt đầu từ kích thước nhỏ hơn */
            opacity: 0;
            /* Ẩn ảnh lúc ban đầu để hiệu ứng fade-in hoạt động */
            transition: transform 0.6s ease, opacity 0.6s ease;
            /* Hiệu ứng zoom-in và fade-in mượt */
        }

        /* Hiệu ứng fade-in và zoom-in cho overlay */
        .overlay.active {
            display: flex;
            opacity: 1;
        }

        .overlay.active img {
            transform: scale(1);
            position: relative;
            z-index: 1;
            /* Phóng to đầy đủ khi mở overlay */
        }

        /* Hiệu ứng fade-in cho ảnh khi load xong */
        .overlay img.loaded {
            opacity: 1;
            /* Ảnh hiện ra khi load xong */
        }
    </style>
    <style>
        .faqs-container--sc.active .faqs-icon svg {
            -webkit-transition: -webkit-transform 0.3s ease 0.2s;
            transition: transform 0.3s ease 0.2s;
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        #pdf_popup-map h2 {
            font-size: 19px;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        #pdf_popup-map .faqs-container {
            height: 38px;
            padding-left: 24px;
        }

        #pdf_popup-map .tour-detail-content_box.faqs--js {
            margin-bottom: 0px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #cacaca;
        }

        #pdf_popup-map .faqs-title {
            font-size: 14px;
            font-weight: 600;
        }

        #pdf_popup-map #map2 {
            height: 500px;
            width: 100%;
        }

        .scout-component__modal {
            z-index: 999;
        }

        #pdf_popup-map .faqs-circle {
            height: 24px;
            width: 24px;
        }

        #pdf_popup-map .faqs-container:not(:last-child)::before {
            position: absolute;
            content: "";
            left: -3px;
            width: 1px;
            height: 100%;
            background-color: #d3d2da;
            top: 20px;
        }

        .faqs-container--sc.active .faqs-content .desc {
            display: block;
        }

        @media (max-width: 992px) {
            #pdf_popup-map #map2 {
                height: 250px;
                margin-bottom: 20px;
                width: 100%;
            }

            .scout-component__modal-top {
                position: relative;
                padding: 15px;
            }
        }
    </style>

    <style>
        .faqs-top .faqs-icon.active svg {
            -webkit-transition: -webkit-transform 0.3s ease 0.2s;
            transition: transform 0.3s ease 0.2s;
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        .faqs-top .faqs-icon.active svg {
            -webkit-transition: -webkit-transform 0.3s ease 0.2s;
            transition: transform 0.3s ease 0.2s;
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg);
        }

        .map-btn {
            box-shadow: 0 1px 2px rgba(3, 54, 63, .4), 0 -1px 2px rgba(3, 54, 63, .04);
            border-radius: 25px;
            background-color: #fff;
            width: fit-content;
            padding: 8px 20px;
            color: #d57c48;
            font-size: 16px;
            top: 15px;
            right: 20px;
            z-index: 997;
            cursor: pointer;
        }

        .map-btn svg {
            fill: #d57c48;
            height: 18px;
            margin-right: 10px;
        }

        .brochure-modal__input-container--1 {
            margin-bottom: 15px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($data->images()->count() > 0): ?>
        <div class="tour-detail-slide ">
            <div class="slide-3">
                <?php $__currentLoopData = $data->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tour-detail-slide-box clm">
                        <a href="<?php echo e(asset($item->image_path)); ?>" data-fancybox="img">
                            <img src="<?php echo e(asset($item->image_path)); ?>" alt="<?php echo e($data->name); ?>">
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="tour-detail-top">
        <div class="ctnr">
            <h1 class="tour-detail-title"><?php echo e($data->name); ?></h1>
            <ul class="d-flex ai-center">
                <?php if($data->masp): ?>
                    <li>
                        Code: <?php echo e($data->masp); ?>

                    </li>
                <?php endif; ?>
                <?php if($data->content2): ?>
                    <li>
                        <?php echo e($data->content2); ?>

                    </li>
                <?php endif; ?>
                <?php if($data->number): ?>
                    <li>
                        Duration: <?php echo e($data->number); ?> days
                    </li>
                <?php endif; ?>
                <?php if($data->price): ?>
                    <li>
                        Pricing: $<?php echo e(number_format($data->price)); ?>

                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="tour-detail-body pd-section-bottom">
        <div class="ctnr">
            <div class="row">
                <div class="clm" style="--w-lg: 8; --w-xs:12;">
                    <div class="tour-detail-content">
                        <div class="tour-detail-content_box">
                            <div class="desc">
                                <p><?php echo $data->description; ?></p>
                            </div>
                        </div>

                        


                        







                        <?php if($data->file): ?>
                            <div class="tour-detail-content_box">
                                <h2 class="tour-detail-content_title">Trip Map</h2>
                                <div class="p-relative">
                                    <img src="<?php echo e(asset($data->file)); ?>" alt="">
                                    
                                    <div class="map-btn p-absolute right-0 d-flex ai-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M565.6 36.2C572.1 40.7 576 48.1 576 56l0 336c0 10-6.2 18.9-15.5 22.4l-168 64c-5.2 2-10.9 2.1-16.1 .3L192.5 417.5l-160 61c-7.4 2.8-15.7 1.8-22.2-2.7S0 463.9 0 456L0 120c0-10 6.1-18.9 15.5-22.4l168-64c5.2-2 10.9-2.1 16.1-.3L383.5 94.5l160-61c7.4-2.8 15.7-1.8 22.2 2.7zM48 136.5l0 284.6 120-45.7 0-284.6L48 136.5zM360 422.7l0-285.4-144-48 0 285.4 144 48zm48-1.5l120-45.7 0-284.6L408 136.5l0 284.6z" />
                                        </svg>
                                        View Destination
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Danh sách hành trình -->
                        <?php if($data->tabs()->count() > 0): ?>
                            <div class="tour-detail-content_box faqs--js">
                                <div class="d-flex ai-center js-between">
                                    <h2 class="tour-detail-content_title">Itinerary</h2>
                                    <div class="btn-expand">
                                        <span class="expand">Expand All</span>
                                        <span class="close">Close All</span>
                                    </div>
                                </div>
                                <div class="faqs">
                                    <?php $__currentLoopData = $data->tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="faqs-container p-relative <?php if($key == 0): ?> active <?php endif; ?>">
                                            <div class="faqs-circle p-absolute left-0 top-0">
                                                <div class="faqs-circle-item active"></div>
                                            </div>
                                            <div class="faqs-top d-flex js-between">
                                                <a class="faqs-title" tabindex="0">
                                                    <span style="color:#d57c48"><?php echo e($item->name); ?></span>
                                                    <?php echo e($item->description); ?>

                                                </a>
                                                <span class="faqs-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                        <!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="faqs-content">
                                                <div class="desc">
                                                    <p><?php echo $item->content; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>


                        <?php if(isset($downloadPDF)): ?>
                            <div class="tour-detail-content_box tour-detail-download d-flex ai-center">
                                <div class="flex-1">
                                    <h2 class="tour-detail-content_title"><?php echo e($downloadPDF->name); ?></h2>
                                    <span><?php echo e($downloadPDF->value); ?></span>
                                </div>
                                <a href="<?php echo e($downloadPDF->slug); ?>" target="_blank" class="toggle-link">
                                    <img src="<?php echo e(asset($downloadPDF->image_path)); ?>" alt="<?php echo e($downloadPDF->name); ?>">
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($question)): ?>
                            <div class="tour-detail-content_box faqs--js">
                                <h2 class="tour-detail-content_title"><?php echo e($question->name); ?></h2>
                                <div class="faqs faqs--sc">
                                    <?php $__currentLoopData = $question->childs()->where('active', 1)->orderBy('order')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="faqs-container faqs-container--sc p-relative <?php if($key == 0): ?> active <?php endif; ?>">
                                            <div class="faqs-top d-flex js-between">
                                                <a class="faqs-title" tabindex="0">
                                                    <?php echo e($item->order); ?>. <?php echo e($item->name); ?>

                                                </a>
                                                <span class="faqs-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                        <!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div class="faqs-content "
                                                <?php if($key == 0): ?> style="display: block;" <?php endif; ?>>
                                                <div class="desc"><?php echo $item->description; ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="clm" style="--w-lg: 4; --w-xs:12;">
                    <div class="form-book">
                        <form action="<?php echo e(route('contact.planTrip')); ?>" id="contactTour" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-book-top">
                                <div class="price d-flex ai-center js-between">
                                    <div class="price-right">
                                        <span class="tt-up d-block">Price</span>
                                        From
                                    </div>
                                    <div class="price-left">
                                        $<?php echo e(number_format($data->price)); ?>

                                    </div>
                                </div>
                                <h2 class="tt-up">Request a quote for this trip</h2>
                                <span>Free service! No credit cared requested at this stage</span>
                            </div>
                            <div class="form-book-body">
                                <div class="row">
                                    <div class="clm" style="--w-lg: 2.5;">
                                        <select name="title">
                                            <option value="">Title</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Ms.">Ms.</option>
                                        </select>
                                    </div>
                                    <div class="clm" style="--w-lg: 3.5;">
                                        <input type="text" placeholder="First Name" name="first_name">
                                    </div>
                                    <div class="clm" style="--w-lg: 6;">
                                        <input type="text" placeholder="Last Name" name="last_name">
                                    </div>
                                    <div class="clm" style="--w-lg: 6;">
                                        <input type="text" name="email" placeholder="Best email">
                                    </div>
                                    <div class="clm" style="--w-lg: 6;">
                                        <input type="text" name="phone" placeholder="Phone number">
                                    </div>
                                    <div class="clm" style="--w-lg: 6;">
                                        
                                        <select name="address_detail">
                                            <option value="">Country</option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Ivory Coast">Ivory Coast</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia">Micronesia</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City">Vatican City</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>

                                    </div>
                                    <div class="clm" style="--w-lg: 6;">
                                        <input type="number" name="adult" placeholder="Adult">
                                    </div>
                                    <input type="hidden" name="price" value="<?php echo e($data->price); ?>">
                                    <input type="hidden" name="name" value="<?php echo e($data->name); ?>">
                                    <div class="clm" style="--w-lg: 6;">
                                        <select name="budget_person">
                                            <option value="">Budget/person</option>
                                            <option value="$500 - $2000"> $500 - $2000 </option>
                                            <option value="$2000 - $4000"> $2000 - $4000 </option>
                                            <option value="$4000 - $6000"> $4000 - $6000 </option>
                                            <option value="$6000 - $8000"> $6000 - $8000 </option>
                                            <option value="$8000 - $10000"> $8000 - $10000 </option>
                                        </select>
                                    </div>
                                    <div class="clm" style="--w-lg: 6;">
                                        <input type="date" name="date" placeholder="When are you traveling?">
                                    </div>
                                    <div class="clm" style="--w-lg: 12;">
                                        <textarea name="specific_requests" cols="30" rows="4" placeholder="Additional info & Inquirements"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-book-bottom">
                                <h2>Pricing Notes</h2>
                                <span>Free service! No credit cared requested at this stage</span>
                                <input type="hidden" name="plantrip" id="plantrip">
                                <button class="tt-up" type="submit">Book now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($dataRelate) && count($dataRelate) > 0): ?>
        <section class="products pd-section-top pd-section-bottom">
            <div class="ctnr">
                <h4 class="title-small ta-center">
                    Related tours
                </h4>
                <h2 class="title-section ta-center">
                    You may also like
                </h2>
                <div class="slide-3-1 pd-section-content">
                    <?php $__currentLoopData = $dataRelate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="clm">
                            <div class="products-card">
                                <a href="<?php echo e($product->slug); ?>" class="products-card__img">
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
                                        <p><?php echo $product->description; ?></p>
                                    </div>
                                    <div class="d-flex ai-end js-between products-card-bottom">
                                        <a href="<?php echo e($product->slug); ?>" class="see-more">
                                            Details
                                        </a>
                                        <div class="price">
                                            <div class="price-top">
                                                Price from: <span>$<?php echo e(number_format($product->price)); ?></span>
                                                / person
                                            </div>
                                            <div class="price-bottom">
                                                (Group of 2)
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

    <div id="pdf_popup" class="scout-component__modal js-brochure-modal__overlay--form">
        <div class="js-scout-component__modal-dialog scout-component__modal-dialog">
            <div class="scout-component__modal-top">
                <div class="scout-component__modal-navigation">
                    <div class=" scout-component__modal-navigation-back hid"></div>
                    <button class="mfp-close scout-component__modal-navigation-close js-brochure-modal__form-close">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>
                <h3 class="scout-component__modal-heading"> <?php echo e($titleForm->name ?? 'Download Brochure'); ?>

                </h3>
            </div>
            <div class="scout-component__modal-content">
                <div class="brochure-modal__wrap">
                    <form action="<?php echo e(route('contact.storeAjax')); ?>" data-url="<?php echo e(route('contact.storeAjax')); ?>"
                        data-ajax="submitForm2" data-target="alert" data-href="#modalAjax" data-content="#content"
                        data-method="POST" method="POST">
                        <input type="hidden" name="title" value="<?php echo e($titleForm->name ?? 'Download Brochure'); ?>">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="tour_name" value="<?php echo e($data->name); ?>">

                        <p class="brochure-modal__text"> <?php echo $titleForm->value ?? 'Send all details for the'; ?> ‘
                            <span class="js-tour-name"><?php echo e($data->name); ?></span>’
                            <?php echo $titleForm->description ?? ''; ?>

                        </p>
                        <div
                            class="brochure-modal__input-container brochure-modal__input-container--1 brochure-modal__input-container--no-checkbox">
                            <div class="brochure-modal__input-box-wrapper">
                                <div class="scout-element__input-wrapper">
                                    <div class="scout-element__input js-ao-serp-brochure-map__bottom-content-form-input ao-serp-brochure-map__bottom-content-form-input"
                                        data-cy="common-download-brochure--email">
                                        <label for="" class="scout-element__input-label"
                                            data-cy="common-download-brochure--email-label">Your Name</label>
                                        <input id="" class="scout-element__input-field" placeholder="Your Name"
                                            name="name" type="name" value=""
                                            data-cy="common-download-brochure--email-input">
                                    </div>
                                    <p class="js-scout-element__error scout-element__input--error hid"
                                        data-cy="common-download-brochure--email-input-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="brochure-modal__input-container brochure-modal__input-container--no-checkbox">
                            <div class="brochure-modal__input-box-wrapper">
                                <div class="scout-element__input-wrapper">
                                    <div class="scout-element__input js-ao-serp-brochure-map__bottom-content-form-input ao-serp-brochure-map__bottom-content-form-input"
                                        data-cy="common-download-brochure--email">
                                        <label for="" class="scout-element__input-label"
                                            data-cy="common-download-brochure--email-label">Email Address</label>
                                        <input id="" class="scout-element__input-field"
                                            placeholder="johnnyflight@email.com" name="email" type="email"
                                            value="" data-cy="common-download-brochure--email-input">
                                    </div>
                                    <p class="js-scout-element__error scout-element__input--error hid"
                                        data-cy="common-download-brochure--email-input-error"></p>
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="aa-btn aa-btn--primary aa-btn--lg js-brochure-modal__input-button brochure-modal__input-button"
                            data-cy="common-download-brochure--submit">Download Brochure</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="pdf_popup-map" class="scout-component__modal js-brochure-modal__overlay--form">
        <div class="js-scout-component__modal-dialog scout-component__modal-dialog">
            <div class="scout-component__modal-top">
                <div class="scout-component__modal-navigation">
                    <div class=" scout-component__modal-navigation-back hid"></div>
                    <button
                        class="mfp-close scout-component__modal-navigation-close js-brochure-modal__form-close map-btn-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                        </svg>
                    </button>
                </div>
                
                <?php if($data->file2): ?>
                    <div class="tour-detail-content_box">
                        <div class="">
                            <img src="<?php echo e(asset($data->file2)); ?>" alt="">
                            
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        var myEnvValue = "<?php echo e(env('APP_URL')); ?>";
    </script>
    <script src="<?php echo e(asset('/frontend/js/map.js')); ?>"></script>

    <script>
        $(document).on('submit', "[data-ajax='submitForm2']", function(event) {
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

    <script>
        $(document).ready(function() {
            $('#contactTour').on('submit', function(e) {
                e.preventDefault();
                let isValid = true;
                var formArr = [];

                // Validate form fields
                if ($('select[name="title"]').val() === "") {
                    formArr.push('Please select a title.');
                    isValid = false;
                }
                if ($('input[name="first_name"]').val() === "") {
                    formArr.push('Please enter your first name.');
                    isValid = false;
                }
                if ($('input[name="last_name"]').val() === "") {
                    formArr.push('Please enter your last name.');
                    isValid = false;
                }
                if ($('input[name="email"]').val() === "") {
                    formArr.push('Please enter your email.');
                    isValid = false;
                }
                if ($('input[name="phone"]').val() === "") {
                    formArr.push('Please enter your phone number.');
                    isValid = false;
                }
                if ($('select[name="address_detail"]').val() === "") {
                    formArr.push('Please select your country.');
                    isValid = false;
                }
                if ($('input[name="adult"]').val() === "") {
                    formArr.push('Please specify the number of adults.');
                    isValid = false;
                }
                if ($('select[name="budget_person"]').val() === "") {
                    formArr.push('Please select a budget/person.');
                    isValid = false;
                }
                if ($('input[name="date"]').val() === "") {
                    formArr.push('Please specify your travel date.');
                    isValid = false;
                }

                // If form validation fails, show error messages
                if (!isValid) {
                    for (const element of formArr) {
                        alert(element);
                        break;
                    }
                    return;
                } else {
                    // Create variables for data
                    let title = $('select[name="title"] option:selected').text();
                    let firstName = $('input[name="first_name"]').val();
                    let lastName = $('input[name="last_name"]').val();
                    let email = $('input[name="email"]').val();
                    let phone = $('input[name="phone"]').val();
                    let country = $('select[name="address_detail"] option:selected').text();
                    let adult = $('input[name="adult"]').val();
                    let budget = $('select[name="budget_person"] option:selected').text();
                    let travelDate = $('input[name="date"]').val();
                    let specificRequests = $('textarea[name="specific_requests"]').val();

                    // Create content for hidden input 'plantrip'
                    let plantrip = `
                        Title: ${title}<br />
                        First Name: ${firstName}<br />
                        Last Name: ${lastName}<br />
                        Email: ${email}<br />
                        Phone: ${phone}<br />
                        Country: ${country}<br />
                        Number of Adults: ${adult}<br />
                        Budget/Person: ${budget}<br />
                        Travel Date: ${travelDate}<br />
                        Specific Requests: ${specificRequests}<br />
                    `;

                    $('#plantrip').val(plantrip); // Assign the value to hidden input field 'plantrip'

                    this.submit(); // Submit the form
                }
            });
        });
    </script>

    <script>
        $('.slide-3-1').slick({
            dots: false,
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome                - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
            nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome                - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>',
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,

                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 550,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        $('.slide-3').slick({
            dots: false,
            arrows: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            prevArrow: '<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome                - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></button>',
            nextArrow: '<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome                - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></button>',
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,

                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 550,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    </script>
    <script>
        document.querySelector(".toggle-link").addEventListener("click", function(event) {
            event.preventDefault();
            var modal = document.querySelector(".scout-component__modal");
            if (modal.style.display === "block") {
                modal.style.display = "none";
            } else {
                modal.style.display = "block";
            }
        });
        document.querySelector(".scout-component__modal-navigation-close").addEventListener("click", function() {
            var modal = document.querySelector(".scout-component__modal");
            modal.style.display = "none";
        });
    </script>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faqs-container');

            faqItems.forEach(faqItem => {
                faqItem.querySelector('.faqs-top').addEventListener('click', () => {
                    // Deactivate all other faqItems
                    faqItems.forEach(item => {
                        if (item !== faqItem) {
                            item.classList.remove('active');
                            item.querySelector('.faqs-top').classList.remove('active');
                            item.querySelector('.faqs-content .desc').style.display =
                                'none';
                        }
                    });

                    // Toggle active class on the clicked faqItem and faqs-top
                    faqItem.classList.toggle('active');
                    faqItem.querySelector('.faqs-top').classList.toggle('active');

                    // Toggle the display of the answer for the clicked faqItem
                    const answer = faqItem.querySelector('.faqs-content .desc');
                    answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Toggle expand/collapse all FAQ items and add/remove active class to/from btn-expand
            const btnExpand = document.querySelector('.btn-expand');
            if (btnExpand) {
                btnExpand.addEventListener('click', () => {
                    const allExpanded = Array.from(faqItems).every(faqItem => {
                        return faqItem.querySelector('.faqs-content .desc').style.display ===
                            'block';
                    });

                    faqItems.forEach(faqItem => {
                        const answer = faqItem.querySelector('.faqs-content .desc');
                        if (allExpanded) {
                            answer.style.display = 'none';
                            faqItem.classList.remove('active');
                            faqItem.querySelector('.faqs-top').classList.remove('active');
                        } else {
                            answer.style.display = 'block';
                            faqItem.classList.add('active');
                            faqItem.querySelector('.faqs-top').classList.add('active');
                        }
                    });

                    if (allExpanded) {
                        btnExpand.classList.remove('active');
                    } else {
                        btnExpand.classList.add('active');
                    }
                });
            }
        });
    </script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the expand and close buttons
            const expandButton = document.querySelector('.btn-expand .expand');
            const closeButton = document.querySelector('.btn-expand .close');
            const btnExpandContainer = document.querySelector('.btn-expand');

            // Select all faq containers
            const faqContainers = document.querySelectorAll('.faqs-container');

            // Activate the first FAQ item by default
            if (faqContainers.length > 0) {
                const firstContainer = faqContainers[0];
                firstContainer.classList.add('active');
                firstContainer.querySelector('.faqs-circle-item').classList.add('active');
                firstContainer.querySelector('.faqs-icon').classList.add('active');
                firstContainer.querySelector('.faqs-content .desc').style.display = 'block';

            }

            // Expand all FAQs
            expandButton.addEventListener('click', function() {
                btnExpandContainer.classList.add('active');
                expandButton.classList.add('active');
                closeButton.classList.remove('active');
                faqContainers.forEach(container => {
                    container.classList.add('active');
                    container.querySelector('.faqs-circle-item').classList.add('active');
                    container.querySelector('.faqs-icon').classList.add('active');
                    container.querySelector('.faqs-content .desc').style.display = 'block';
                });
            });

            // Close all FAQs
            closeButton.addEventListener('click', function() {
                btnExpandContainer.classList.remove('active');
                expandButton.classList.remove('active');
                closeButton.classList.add('active');
                faqContainers.forEach(container => {
                    container.classList.remove('active');
                    container.querySelector('.faqs-circle-item').classList.remove('active');
                    container.querySelector('.faqs-icon').classList.remove('active');
                    container.querySelector('.faqs-content .desc').style.display = 'none';
                });
            });

            // Toggle FAQ item
            faqContainers.forEach(container => {
                container.addEventListener('click', function() {
                    const isActive = container.classList.contains('active');
                    if (isActive) {
                        container.classList.remove('active');
                        container.querySelector('.faqs-circle-item').classList.remove('active');
                        container.querySelector('.faqs-icon').classList.remove('active');
                        container.querySelector('.faqs-content .desc').style.display = 'none';
                    } else {
                        container.classList.add('active');
                        container.querySelector('.faqs-circle-item').classList.add('active');
                        container.querySelector('.faqs-icon').classList.add('active');
                        container.querySelector('.faqs-content .desc').style.display = 'block';
                    }
                });
            });
        });
    </script>

    <script>
        // const image = document.getElementById('image');
        // const overlay = document.getElementById('overlay');
        // const zoomedImage = document.getElementById('zoomedImage');

        // // Mở lớp overlay và phóng to ảnh
        // image.addEventListener('click', function() {
        //     overlay.classList.add('active'); // Hiển thị overlay với hiệu ứng
        //     overlay.style.display = 'flex'; // Hiển thị flex để hiển thị ảnh

        //     // Đặt ảnh mới vào overlay và bắt đầu load ảnh
        //     zoomedImage.src = zoomedImage.src;

        //     // Khi ảnh được load hoàn tất
        //     zoomedImage.onload = function() {
        //         zoomedImage.classList.add('loaded'); // Thêm class để áp dụng hiệu ứng fade-in
        //     };
        // });

        // // Đóng overlay khi click vào lớp overlay
        // overlay.addEventListener('click', function() {
        //     overlay.classList.remove('active'); // Bắt đầu hiệu ứng thu nhỏ
        //     zoomedImage.classList.remove('loaded'); // Gỡ class loaded để reset hiệu ứng
        //     setTimeout(() => {
        //         overlay.style.display = 'none'; // Ẩn overlay sau khi hiệu ứng hoàn tất
        //     }, 600); // Đợi 600ms cho hiệu ứng fade-out hoàn thành
        // });

        document.addEventListener('DOMContentLoaded', function(event) {

            $('.map-btn').on("click", function(event) {
                event.preventDefault();
                $("#pdf_popup-map").show();
            });
            $('.mfp-close').on("click", function(event) {
                event.preventDefault();
                $("#pdf_popup-map").hide();
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\demo22\resources\views/frontend/pages/product-detail.blade.php ENDPATH**/ ?>