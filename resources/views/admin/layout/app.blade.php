<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link rel="stylesheet" href="../assets/css/core/libs.min.css">
    <link rel="stylesheet" href="../assets/vendor/aos/dist/aos.css">
    <link rel="stylesheet" href="../assets/css/hope-ui.min.css?v=5.0.0">
    <link rel="stylesheet" href="../assets/css/custom.min.css?v=5.0.0">
    <link rel="stylesheet" href="../assets/css/customizer.min.css?v=5.0.0">
    <link rel="stylesheet" href="../assets/css/rtl.min.css?v=5.0.0">
    <title>Document</title>
</head>
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body">
        </div>
    </div>
    @include('admin.layout.sidebar')
    <div class="main-content">
        @include('admin.layout.navbar')
        @yield('content')
    </div>
    <script src="../assets/js/core/libs.min.js"></script>

    <!-- External Library Bundle Script -->
    <script src="../assets/js/core/external.min.js"></script>

    <!-- Widgetchart Script -->
    <script src="../assets/js/charts/widgetcharts.js"></script>

    <!-- mapchart Script -->
    <script src="../assets/js/charts/vectore-chart.js"></script>
    <script src="../assets/js/charts/dashboard.js"></script>

    <!-- fslightbox Script -->
    <script src="../assets/js/plugins/fslightbox.js"></script>

    <!-- Settings Script -->
    <script src="../assets/js/plugins/setting.js"></script>

    <!-- Slider-tab Script -->
    <script src="../assets/js/plugins/slider-tabs.js"></script>

    <!-- Form Wizard Script -->
    <script src="../assets/js/plugins/form-wizard.js"></script>

    <!-- AOS Animation Plugin-->
    <script src="../assets/vendor/aos/dist/aos.js"></script>

    <!-- App Script -->
    <script src="../assets/js/hope-ui.js" defer></script>
</div>

</html>
