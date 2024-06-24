<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('storage/logo-t.png') }}">
    <title>Dashboard - Internhub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&display=swap" rel="stylesheet">    <!-- Ajoutez ici d'autres liens vers des fichiers CSS ou des scripts -->
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('script-haut')
    <!-- JS Bootstrap (nécessaire pour les fonctionnalités comme le menu déroulant) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        html, body{
            background-color: #efefef
        }
        body {
            max-width: 65vw;
            margin-right: auto;
            margin-left: auto; 
        }
        #myChart, #myChart2, #myChart3, #myChart4, #myChart5 {
            height: 100% !important;
            width: 100% !important;
        }
    </style>
</head>
<body>

<header class="dash-header">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-dashboard">

            <div class="logo">
                <a class="navbar-brand" href="#"><img src="{{ asset('storage/logo.png') }}" alt="" height="20" width="110"></a>
            </div>

            <div class="dashboard-settings">
                <nav>
                    <ul>
                        <p>Bonjour, {{Auth::user()->prenom}} {{Auth::user()->nom}}</p>
        
                        <a href="" class="me-4 text-reset text-black">
                            <i class="fa fa-cog" aria-hidden="true"></i>   
                        </a>
                        
                    </ul>
                </nav>
            </div>

        </div>   
    </nav>
</header>

<main>
    <div class="sidebar">
        @yield('sidecontent')
    </div>
    <div class="maincontent">
        @yield('content')
    </div>
</main>

<div class="container-perso container">

</div>
@yield('modal-deux')

 


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
