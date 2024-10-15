<html>

<head>
    <script type="text/javascript" id="mobile-simulator">
        window.hasMobileFirstExtension = true;
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang 404</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="vi">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="abstract" content="">
    <meta name="ROBOTS" content="Metaflow">
    <meta name="ROBOTS" content="index, follow, all">
    <meta name="AUTHOR" content="Bivaco">
    <meta name="revisit-after" content="1 days">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .box_404 {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo_bfc {
            width: auto;
            text-align: center;
            margin-bottom: 20px;
        }

        .logo_bfc img {
            width: auto;
            max-width: 100%;
            height: 94px;
        }

        .img_404 {
            width: auto;
            text-align: center;
        }

        .img_404 img {
            width: auto;
            max-width: 500px;
        }

        .bug_404 {
            text-align: center;
            width: auto;
            color: #2e3285;
            font-size: 30px;
        }

        .menu_line {
            width: auto;
            display: flex;
            align-items: center;
            margin-top: 28px;
        }

        .menu_line a {
            display: inline-block;
            padding: 0 15px;
            color: #2e3285;
            text-decoration: none;
            text-align: center;
            width: auto;
            font-size: 30px;
        }

        .menu_line a:hover {
            text-decoration: underline;
        }

        @media (max-width: 550px) {
            .img_404 img {
                width: auto;
                max-width: 74%;
            }

            .bug_404 {
                font-size: 28px;
            }

            .menu_line a {
                padding: 0 10px;
                font-size: 24px;
            }

            .logo_bfc img {
                height: 60px;
            }
        }
    </style>
    <style>
        .--savior-overlay-transform-reset {
            transform: none !important;
        }

        .--savior-overlay-z-index-top {
            z-index: 2147483643 !important;
        }

        .--savior-overlay-position-relative {
            position: relative;
        }

        .--savior-overlay-position-static {
            position: static !important;
        }

        .--savior-overlay-overflow-hidden {
            overflow: hidden !important;
        }

        .--savior-overlay-overflow-x-visible {
            overflow-x: visible !important;
        }

        .--savior-overlay-overflow-y-visible {
            overflow-y: visible !important;
        }

        .--savior-overlay-z-index-reset {
            z-index: auto !important;
        }

        .--savior-overlay-display-none {
            display: none !important;
        }

        .--savior-overlay-clearfix {
            clear: both;
        }

        .--savior-overlay-reset-filter {
            filter: none !important;
            backdrop-filter: none !important;
        }

        .--savior-tooltip-host {
            z-index: 9999;
            position: absolute;
            top: 0;
        }

        /*Override css styles for Twitch.tv*/
        main.--savior-overlay-z-index-reset {
            z-index: auto !important;
        }

        .modal__backdrop.--savior-overlay-z-index-reset {
            position: static !important;
        }

        main.--savior-overlay-z-index-top {
            z-index: auto !important;
        }

        main.--savior-overlay-z-index-top .channel-root__player-container+div,
        main.--savior-overlay-z-index-top .video-player-hosting-ui__container+div {
            opacity: 0.1;
        }

        /*Dirty hack for facebook big video page e.g: https://www.facebook.com/abc/videos/...*/
        .--savior-backdrop {
            position: fixed !important;
            z-index: 2147483642 !important;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw !important;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .--savior-overlay-twitter-video-player {
            position: fixed;
            width: 80%;
            height: 80%;
            top: 10%;
            left: 10%;
        }

        .--savior-overlay-z-index-reset [class*="DivSideNavContainer"],
        .--savior-overlay-z-index-reset [class*="DivHeaderContainer"],
        .--savior-overlay-z-index-reset [class*="DivBottomContainer"],
        .--savior-overlay-z-index-reset [class*="DivCategoryListWrapper"],
        .--savior-overlay-z-index-reset [data-testid="sidebarColumn"],
        .--savior-overlay-z-index-reset header[role="banner"],
        .--savior-overlay-z-index-reset [data-testid="cellInnerDiv"]:not(.--savior-overlay-z-index-reset),
        .--savior-overlay-z-index-reset [aria-label="Home timeline"]>div:first-child,
        .--savior-overlay-z-index-reset [aria-label="Home timeline"]>div:nth-child(3) {
            z-index: -1 !important;
        }

        .--savior-overlay-z-index-reset [data-testid="cellInnerDiv"] .--savior-backdrop+div {
            z-index: 2147483643 !important;
        }

        .--savior-overlay-z-index-reset [data-testid="primaryColumn"]>[aria-label="Home timeline"] {
            z-index: 0 !important;
        }

        .--savior-overlay-z-index-reset#mtLayer,
        .--savior-overlay-z-index-reset.media-layer {
            z-index: 3000 !important;
        }

        .--savior-overlay-position-relative [class*="SecBar_secBar_"],
        .--savior-overlay-position-relative .woo-box-flex [class*="Frame_top_"] {
            z-index: 0 !important;
        }

        .--savior-overlay-position-relative .vue-recycle-scroller__item-view:not(.--savior-overlay-z-index-reset),
        .--savior-overlay-position-relative .woo-panel-main[class*="BackTop_main_"],
        .--savior-overlay-position-relative [class*="Main_side_"] {
            z-index: -1 !important;
        }

        /* Fix conflict css with zingmp3 */
        .zm-video-modal.--savior-overlay-z-index-reset {
            position: absolute;
        }

        /* Dirty hack for xvideos99 */
        #page #main.--savior-overlay-z-index-reset {
            z-index: auto !important;
        }

        /* Overlay for ok.ru */
        #vp_w.--savior-overlay-z-index-reset.media-layer.media-layer__video {
            overflow-y: hidden;
            z-index: 2147483643 !important;
        }

        /* Fix missing controller for tv.naver.com */
        .--savior-overlay-z-index-top.rmc_controller,
        .--savior-overlay-z-index-top.rmc_setting_intro,
        .--savior-overlay-z-index-top.rmc_highlight,
        .--savior-overlay-z-index-top.rmc_control_settings {
            z-index: 2147483644 !important;
        }

        /* Dirty hack for douyi.com */
        .swiper-wrapper.--savior-overlay-z-index-reset .swiper-slide:not(.swiper-slide-active),
        .swiper-wrapper.--savior-overlay-transform-reset .swiper-slide:not(.swiper-slide-active) {
            display: none;
        }

        .videoWrap+div>div {
            pointer-events: unset;
        }

        /* Dirty hack for fpt.ai */
        .mfp-wrap.--savior-overlay-z-index-top {
            position: relative;
        }

        .mfp-wrap.--savior-overlay-z-index-top .mfp-close {
            display: none;
        }

        .mfp-wrap.--savior-overlay-z-index-top .mfp-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        section.--savior-overlay-z-index-reset>main[role="main"].--savior-overlay-z-index-reset+nav {
            z-index: -1 !important;
        }

        section.--savior-overlay-z-index-reset>main[role="main"].--savior-overlay-z-index-reset section.--savior-overlay-z-index-reset div.--savior-overlay-z-index-reset~div {
            position: relative;
        }

        div[class^="tiktok"].--savior-overlay-z-index-reset {
            z-index: 2147483644 !important;
        }

        .--savior-lightoff-fix section:not(:has([class*="--savior-overlay-"])),
        .--savior-lightoff-fix section.section_video~section {
            z-index: -1;
            position: relative;
        }

        .--savior-lightoff-fix header,
        .--savior-lightoff-fix footer,
        .--savior-lightoff-fix .top-header,
        .--savior-lightoff-fix .swiper-container,
        .--savior-lightoff-fix #to_top,
        .--savior-lightoff-fix #button-adblock {
            z-index: -1 !important;
        }

        @-moz-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @-o-keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>


<body>
    <div class="box_404">
        <div class="img_404">
            <img src="{{ asset('frontend/images/img_404.png') }}" alt="404">
        </div>
        <div class="bug_404">
            Page not found!
        </div>
        <div class="menu_line">
            <a href="{{ makeLink('home') }}">Quay lại Trang Chủ</a>
        </div>
    </div>
    {{-- <script>
        if (window.location.href.indexOf('/public') !== -1) {
            // Chuyển hướng sang URL mới
            window.location.replace('https://demo18.largevendor.com/404.html');
        }
    </script> --}}

</body>
<div style="position: absolute; top: 0px; z-index: 2147483647; display: block !important;"></div>

</html>
