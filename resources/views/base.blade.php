<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('storage/logo-t.png') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&display=swap" rel="stylesheet">    <!-- Ajoutez ici d'autres liens vers des fichiers CSS ou des scripts -->
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- JS Bootstrap (nécessaire pour les fonctionnalités comme le menu déroulant) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container container-perso">
            <!-- Marque et bouton d'activation pour les appareils mobiles -->
            <a class="navbar-brand" href="#"><img src="{{ asset('storage/logo.png') }}" alt="" height="20" width="110"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Liens de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home')}}">Home</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile')}}">My profile</a>
                    </li>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signin')}}">Sign in/Sign up</a>
                    </li>
                    @endguest
                    @if (false)
                      <li class="nav-item">
                          <a class="nav-link" href="#">Sign out</a>
                      </li>
                    @endif
                    <li class="nav-item btn-violet">
                        <a class="nav-link nav-link-violet" href="{{ route('offers')}}">Internship offers</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<div class="container-perso container">

</div>
<!-- Footer -->
<footer class="text-center text-lg-start text-muted" style="max-width: 75%; margin: auto; border-top: 0.5px #e0e0e0 solid; margin-top:50px;">
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <img src="{{ asset('storage/logo.png') }}" alt="" height="20" width="110" >
            </h6>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Compagny
            </h6>
            <p>
              <a href="#!" class="text-reset">About us</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Solutions</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Careers</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Contact us</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              For students
            </h6>
            <p>
              <a href="#!" class="text-reset">Discovery Externship</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Graduate Internship</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Remote Craftsmanship</a>
            </p>
          </div>
          <!-- Grid column -->

           <!-- Grid column -->
           <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Blog
            </h6>
            <p>
              <a href="#!" class="text-reset">Events</a>
            </p>
            <p>
              <a href="#!" class="text-reset">News</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>


                <a href="" class="me-4 text-reset text-black" style="display: flex; align-items:center;">
                    <i class="fab fa-twitter"></i>   Twitter
                </a>

                <a href="" class="me-4 text-reset text-black" style="display: flex; align-items:center;">
                    <i class="fab fa-instagram"></i>   Instagram
                </a>
                <a href="" class="me-4 text-reset text-black" style="display: flex; align-items:center;">
                    <i class="fab fa-linkedin"></i>   Linkedin
                </a>



          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

  </footer>
  <!-- Footer -->

<!-- Ajoutez ici d'autres scripts JavaScript -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
