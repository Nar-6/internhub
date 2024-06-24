@extends('admin/base')
@section('sidecontent')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link nav-link-perso dash-active" aria-current="page" href="{{ route('dashboard.index')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.candidatures')}}">Candidatures</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Candidats</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.tests')}}">Tests</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Stages</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.offres')}}">Offres de stage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Employes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.entretiens')}}">Entretiens</a>
    </li>
</ul>
@endsection
@section('content')
    <div class="home-dashboard">
        <div class="cards">
            <div class="gauche">
                <a href="{{ route('dashboard.candidatures')}}">
                    <div class="home-dashboard-card shadow">
                        <div class="texte">
                            <h2>Candidatures</h2>
                            <div class="nombre">
                                {{count($candidatures)}}
                            </div>
                            <div class="autres">
                                @php
                                    use Carbon\Carbon;

                                    // Définir la locale en français
                                    Carbon::setLocale('fr');
                                    // Trouver la valeur maximale
                                    $meilleurMois = max($monthlyCandidatures);

                                    // Trouver le mois correspondant à cette valeur
                                    $meilleurMoisNom = array_search($meilleurMois, $monthlyCandidatures);
                                    $meilleurMoisNom = Carbon::create()->month($meilleurMoisNom)->format('F');
                                @endphp
                                More applications in {{$meilleurMoisNom}}
                            </div>
                        </div>
                        
                        <div class="graph">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </a>
                
                <a href="#">
                    <div class="home-dashboard-card shadow">
                        <div class="texte">
                            <h2>Candidats</h2>
                            <div class="nombre">
                               {{count($candidats)}}
                            </div>
                        </div>
                        
                        <div class="graph">
                            <canvas id="myChart2" style="height: 100% !important; width: 100% !important;"></canvas>
                        </div>
                    </div>
                </a>

                 <a href="#">
                    <div class="home-dashboard-card shadow">
                        <div class="texte">
                            <h2>Tests</h2>
                            <div class="nombre">
                                {{count($tests)}}
                            </div>
                        </div>
                        
                        <div class="graph">
                            <canvas id="myChart3" style="height: 100% !important; width: 100% !important;"></canvas>
                        </div>
                    </div>
                </a>
            </div>
            <div class="droit">
                <a href="#">
                    <div class="home-dashboard-card shadow">
                        <div class="texte">
                            <h2>Employes</h2>
                            <div class="nombre">
                                {{count($employes)}}
                            </div>
                        </div>
                        
                        <div class="graph">
                            <canvas id="myChart4" style="height: 100% !important; width: 100% !important;"></canvas>
                        </div>
                    </div>
                </a>

                 <a href="#">
                    <div class="home-dashboard-card shadow">
                        <div class="texte">
                            <h2>Offres de stage</h2>
                            <div class="nombre">
                                {{count($offres)}}
                            </div>
                        </div>
                        
                        <div class="graph">
                            <canvas id="myChart5" style="height: 100% !important; width: 100% !important;"></canvas>
                        </div>
                    </div>
                </a>

                 <a href="#">
                    <div class="home-dashboard-card shadow">
                        <div class="texte">
                            <h2>Candidats</h2>
                            <div class="nombre">
                                42
                            </div>
                        </div>
                        
                        <div class="graph">

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar', // Type de graphique, peut être 'line', 'bar', 'pie', etc.
                data: {!! json_encode($data) !!}, // Les données du graphique
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('myChart2').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line', // Type de graphique, peut être 'line', 'bar', 'pie', etc.
                data: {!! json_encode($data) !!}, // Les données du graphique
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myChart5').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line', // Type de graphique, peut être 'line', 'bar', 'pie', etc.
            data: {!! json_encode($data) !!}, // Les données du graphique
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myChart3').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'pie', // Type de graphique, peut être 'line', 'bar', 'pie', etc.
            data: {!! json_encode($data) !!}, // Les données du graphique
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('myChart4').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar', // Type de graphique, peut être 'line', 'bar', 'pie', etc.
            data: {!! json_encode($data) !!}, // Les données du graphique
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>

@endsection