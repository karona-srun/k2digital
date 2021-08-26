<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'K2 Digital') }}</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta name="description"
        content="Connect With Your Friends Online. Join the K2 Digital Community Free! Plan Events. Find Friends. Follow Interesting Topics. Play Games With Friends. Chat Online. Connect With Old Friends. Stay In Touch With Family. Share Your Memories.">
    <meta name="author" content="Karona Srun">
    <meta name="generator" content="Hugo 0.84.0">
    <link rel="shortcut icon"
        href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5"
        type="image/x-icon">
    <link rel="apple-touch-icon"
        href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5"
        sizes="180x180">
    <link rel="icon"
        href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5"
        sizes="32x32" type="image/png">
    <link rel="icon"
        href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5"
        sizes="16x16" type="image/png">
    <link rel="mask-icon"
        href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5"
        color="#7952b3">
    <link rel="icon"
        href="https://scontent.fpnh2-2.fna.fbcdn.net/v/t1.6435-9/114757570_1195350050800627_7655988418641948680_n.png?_nc_cat=109&ccb=1-3&_nc_sid=09cbfe&_nc_eui2=AeGFntXCFlGyKdfX22IjvDR3GQN8H6-gijUZA3wfr6CKNWm8tC1gxYIOFubhbBs2n06tUyur7b3zqkM-DPQt725v&_nc_ohc=e6BI2K6YEI0AX_cc8aM&_nc_ht=scontent.fpnh2-2.fna&oh=d3607aed3d007a0f6f2ecad68a656f64&oe=612BBFA5">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.collapse').on('hidden.bs.collapse', function() {
                // read the data-default value
                var defaultDiv = $($(this).data("parent")).data("default");
                // show the default panel
                $('.collapse').eq(defaultDiv - 1).collapse('show');
            })
        });
    </script>
</body>

</html>
