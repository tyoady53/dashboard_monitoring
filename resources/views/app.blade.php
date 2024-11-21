<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/admin/css/style.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/admin/css/custom.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="{{ asset('/admin/js/coreui.bundle.min.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script src="https://unpkg.com/v-switch-case@1.0.2/dist/v-switch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.21/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.tiny.cloud/1/godpyqlqox4xietkxf3bzaxj0ywpi3q6t6va9luuqi854f6k/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- <script src="https://cdn.tiny.cloud/1/u775w5r14ct8g3iva79sj60inrfjtd86bw5e3pxl356r65pi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    {{-- <Link rel="icon" href="/images/logowynhealth.png" type="image/x-icon"> --}}
    <Link rel="icon" href="/images/logo.png" type="image/x-icon">
    {{-- <Link rel="icon" href="/images/Wynacom.png" type="image/x-icon"> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0-dev.3/quill.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/quill-table-ui@1.0.5/dist/umd/index.js" type="text/javascript"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue-selectize@0.0.3/dist/vue-selectize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" />

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    {{-- @inertiaHead --}}

    <!-- Leaflet assets -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet-src.js" integrity="sha512-IkGU/uDhB9u9F8k+2OsA6XXoowIhOuQL1NTgNZHY1nkURnqEGlDZq3GsfmdJdKFe1k1zOc6YU2K7qY+hF9AodA==" crossorigin=""></script>

    <!-- Leaflet.markercluster assets -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css">
    <script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster-src.js"></script>

</head>
<body>
    @inertia
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<style>
.btn-copy {
    color: #fff;
    background-color: #0d6efd;
    border-color: #321fdb;
}

.btn-copy:hover {
    color: #fff;
    background-color: #321fdb;
    border-color: #0d6efd;
}


.page-loader {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    width: 100%;
    z-index: 9999;
}

.page-loader-table {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100px;
    width: 100%;
    z-index: 9999;
}

.page-loader-acordion {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100px;
    width: 100%;
    z-index: 9999;
}

.scroll-lock {
    overflow: hidden;
}

.loading-spinner {
    position: relative;
    width: 120px;
    height: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Outer spinning border */
.spinner-border {
    position: absolute;
    border: 8px solid #f3f3f3; /* Light gray border */
    border-top: 8px solid #3498db; /* Blue top border */
    border-radius: 50%; /* Circular spinner */
    width: 100%; /* Match the container size */
    height: 100%;
    animation: spin 1.2s linear infinite; /* Rotates only the border */
}

/* Inner stationary content */
.spinner-static {
    position: absolute; /* Decouples it from the spinning animation */
    background-image: url('/images/Wynacom.png'); /* Logo path */
    background-size: contain; /* Scales logo appropriately */
    background-position: center;
    background-repeat: no-repeat;
    width: 60%; /* Adjust size relative to the spinner */
    height: 60%;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
</html>
