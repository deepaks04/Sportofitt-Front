<!doctype html>
<html ng-app="sportofittApp">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- build:css(.) front/styles/vendor.css -->
    <!-- bower:css -->
    <!-- endbower -->
    <!-- endbuild -->
    <!-- build:css(.tmp) front/styles/main.css -->
      <!-- Font Awesome -->
      <link rel="front/stylesheet" href="front/assets/bootstrap/css/bootstrap.css" type="text/css">
      <!--<link rel="front/stylesheet" href="front/assets/css/bootstrap-select.min.css" type="text/css">-->



      <link rel="front/stylesheet"
            href="bower_components/font-awesome/css/font-awesome.min.css">

      <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='front/stylesheet' type='text/css'>
      <!-- Themify Icons -->
      <link rel="front/stylesheet"
            href="bower_components/themify-icons/themify-icons.css">
      <!-- Loading Bar -->
      <link rel="front/stylesheet"
            href="bower_components/angular-loading-bar/build/loading-bar.min.css">
      <!-- Animate Css -->
      <link rel="front/stylesheet"
            href="bower_components/animate.css/animate.min.css">

      <link rel="front/stylesheet"
            href="bower_components/angular-toastr/dist/angular-toastr.css">
<link rel="front/stylesheet" href="bower_components/v-accordion/dist/v-accordion.min.css">
      <!--<link rel="front/stylesheet" href="bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" type="text/css"/>-->
<link rel="front/stylesheet" href="front/assets/css/jquery.mCustomScrollbar.css">
      <link rel="front/stylesheet" href="front/assets/css/jquery.nouislider.min.css" type="text/css">

      <link rel="front/stylesheet" href="bower_components/slick-carousel/slick/slick.css">
      <link rel="front/stylesheet" href="bower_components/slick-carousel/slick/slick-theme.css">
      <link rel="front/stylesheet" href="bower_components/sweetalert/lib/sweet-alert.css">
      <link rel="front/stylesheet" href="front/styles/dropzone.css">

      <link rel="front/stylesheet" href="front/styles/checkout.css">
      <link rel="front/stylesheet" href="front/styles/style.css">
      <style>
          .slick-prev:before, .slick-next:before{
              color: #474747;
              zoom:1.5;
          }
          .slick-prev{
              left: -50px;
          }
          .slick-right{
              right: -50px;
          }
          #sidebar{
              background-color: inherit;
          }
          #sidebar:before{
              border: none;
          }
          #page-footer .inner{
              padding-top: 0px!important;
          }
          #page-footer .footer-bottom{
              margin-top: 0px!important;
          }
          input[type="text"]{
              border: 1px solid #EAEAEA;
          }
      </style>
    <!-- endbuild -->
  </head>
  <body onunload="" class=" page-homepage  navigation-off-canvas" id="page-top">
    <!--[if lte IE 8]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Outer Wrapper-->
    <div id="outer-wrapper">
        <!-- Inner Wrapper -->
        <ui-view  id="inner-wrapper">
          </ui-view >
    </div>
    <!-- build:js(.) front/scripts/vendor.js -->
    <!-- bower:js -->
    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Fastclick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>

    <script src="bower_components/lodash/lodash.min.js"></script>
    <!-- Angular -->
    <script src="bower_components/angular/angular.min.js"></script>

    <script src="bower_components/angular-cookies/angular-cookies.min.js"></script>
    <script src="bower_components/satellizer/satellizer.min.js"></script>
    <script src="bower_components/angular-animate/angular-animate.min.js"></script>
    <script src="bower_components/angular-touch/angular-touch.min.js"></script>

    <!-- UI Bootstrap -->
    <script
            src="bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script> <script src="bower_components/v-accordion/dist/v-accordion.min.js"></script>
    <script type="text/javascript" src="front/assets/js/bootstrap-select.min.js"></script>
    <script src="bower_components/angular-sanitize/angular-sanitize.min.js"></script>
    <script
            src="bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <!-- Angular storage -->
    <script src="bower_components/ngstorage/ngStorage.min.js"></script>
    <script src="bower_components/angular-local-storage/dist/angular-local-storage.min.js"></script>
    <!-- Angular Translate -->
    <script
            src="bower_components/angular-translate/angular-translate.min.js"></script>
    <script
            src="bower_components/angular-translate-loader-url/angular-translate-loader-url.min.js"></script>
    <script
            src="bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js"></script>
    <script
            src="bower_components/angular-translate-storage-local/angular-translate-storage-local.min.js"></script>
    <script
            src="bower_components/angular-translate-storage-cookie/angular-translate-storage-cookie.min.js"></script>
    <!-- oclazyload -->
    <script src="bower_components/oclazyload/dist/ocLazyLoad.min.js"></script>
    <!-- breadcrumb -->
    <script
            src="bower_components/angular-breadcrumb/dist/angular-breadcrumb.min.js"></script>
    <!-- UI Bootstrap -->
    <script
            src="bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
    <!-- Loading Bar -->
    <script
            src="bower_components/angular-loading-bar/build/loading-bar.min.js"></script>
    <!-- Angular Scroll -->
    <script src="bower_components/angular-scroll/angular-scroll.min.js"></script>
    <script src="bower_components/angular-toastr/dist/angular-toastr.tpls.min.js"></script>

    <script src="bower_components/slick-carousel/slick/slick.js"></script>
    <script src="bower_components/angular-slick/dist/slick.js"></script>
    <script src='bower_components/ngMask/dist/ngMask.min.js'></script>
    <script src='bower_components/sweetalert/lib/sweet-alert.min.js'></script>
    <script src='bower_components/angular-sweetalert-promised/SweetAlert.min.js'></script>

    <!-- endbower -->
    <!-- endbuild -->

        <!-- build:js({.tmp,app}) front/scripts/front/scripts.js -->

    <script type="text/javascript" src="front/assets/js/dropzone.min.js"></script>


    <script src="bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!--<script src="bower_components/ng-scrollbars/dist/scrollbars.min.js"></script>-->

    <script src="front/scripts/app.js"></script>
        <script src="front/scripts/controllers/main.js"></script>

    <script src="front/scripts/controllers/auth.js"></script>

    <script src="front/scripts/controllers/register.js"></script>
    <script src="front/scripts/controllers/profile.js"></script>

    <script src="front/scripts/services/auth.js"></script>
    <script src="front/scripts/app.config.js"></script>

    <script src="front/scripts/routes/config.routes.js"></script>
        <script src="front/scripts/directives/dropzone.js"></script>
        <script src="front/scripts/services/user.js"></script>
        <script src="front/scripts/services/searchservice.js"></script>
        <script src="front/scripts/controllers/confirmation.js"></script>
    <script src='https://maps.googleapis.com/maps/api/js'></script>

    <script type="text/javascript" src="front/assets/js/infobox.js"></script>
    <script type="text/javascript" src="front/assets/js/richmarker-compiled.js"></script>

    <script type="text/javascript" src="front/assets/js/markerclusterer.js"></script>

        <script src="front/scripts/controllers/map.js"></script>
        <script src="front/scripts/controllers/vendorinfo.js"></script>
        <script src="front/scripts/services/bookingservice.js"></script>
        <script src="front/scripts/controllers/orderconfirmation.js"></script>
        <script src="front/scripts/controllers/facilityview.js"></script>

    <script src="front/scripts/controllers/userbookings.js"></script>
        <!-- endbuild -->
    <!-- Google Apis -->

  </body>
</html>
