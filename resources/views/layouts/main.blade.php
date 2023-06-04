<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Siakad MAN 1 Kota Malang</title>
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-5.1.3/css/bootstrap.css') }}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- Boxicons CSS-->
    <link rel="stylesheet" href="{{ asset('assets/modules/boxicons/css/boxicons.min.css') }}" />
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
    @yield('content')
    @include('sweetalert::alert')
    <!-- bootstrap js -->
    <script src="/assets/modules/jquery/jquery.min.js"></script>
    <script src="/assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/modules/popper/popper.min.js"></script>

    <!-- Template JS File -->
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
</body>

</html>
