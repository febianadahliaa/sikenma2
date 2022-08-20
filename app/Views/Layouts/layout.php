<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= $title; ?></title>
    <meta content="Category: Mitra Management Apps" name="description" />
    <meta content="Febiana D. Anjani" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" type="image/icon" href="assets/images/kenma.svg">

    <link rel="stylesheet" href="/assets/plugins/fontawesome/css/fontawesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="/assets/plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- Custom Plugin -->
    <?= $this->renderSection('pluginCss'); ?>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page start -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <?= $this->include('partials/sidebar') ?>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- Right content start -->
        <div class="content-page">
            <!-- Content start -->
            <div class="content">

                <!-- ========== Top Bar Start ========== -->
                <div class="topbar">
                    <?= $this->include('partials/topbar'); ?>
                </div>
                <!-- ========== Top Bar End ========== -->

                <!-- Page content wrapper start -->
                <div class="page-content-wrapper ">
                    <div class="container-fluid">
                        <?= $this->renderSection('content'); ?>
                    </div>
                </div> <!-- Page content wrapper end -->

            </div> <!-- Content end -->

            <footer class="footer">
                <p class="copyright"><?= date('Y'); ?> &copy; <a href="https://wakatobikab.bps.go.id">BPS Kabupaten Wakatobi</a>
            </footer>

        </div> <!-- Right content end -->
    </div> <!-- Begin page end -->


    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>

    <?= $this->renderSection('pluginJs'); ?>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

    <?= $this->renderSection('appJs'); ?>

</body>

</html>