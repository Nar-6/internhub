@extends('base')

@section('title')
My profile - InternHub
@endsection

@section('content')
@if (Auth::user()->role == "candidat")

<div class="container container-perso-t">
    <div class="profil">
        <div class="profil-photo-nom">
            <div class="profil-photo ">
                @if ( Auth::user()->candidat->photo != NULL)
                    <img class="shadow" src="{{ asset(Auth::user()->candidat->photo) }}" alt="">
                @else
                    <img class="shadow" src="{{ asset('storage/3.png') }}" alt="" >
                @endif
            </div>
            <div class="profil-nom">
                <div class="accroche-titre">
                    <h2>{{ Auth::user()->prenom }}</h2>
                    <h1>{{ Auth::user()->nom }}</h1>
                    <p>{{ Auth::user()->email }}</p>
                    <form action="{{ route('candidat.logout')}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="accroche-btn btn-violet-reverse">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="candidatures">
        <div class="accroche-titre">
            <h2 style="text-align: center;">Vos candidatures</h2>
        </div>
        @if (Auth::user()->candidat->candidatures->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr style="padding: 20px;">
                            <th style="padding-right: 20px; ">Date de soumission</th>
                            <th style="padding-right: 20px;">Statut</th>
                            <th>Offre de stage</th>
                            <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->candidat->candidatures as $candidature)
                            <tr style="padding: 20px;">
                                <td style="padding-right: 20px;">{{ $candidature->date_soumission }}</td>
                                <td style="padding-right: 20px;">
                                    @if ($candidature->statut=="accepté")
                                    
                                    <a href="{{route('candidat.passer.test',
                                     ['candidature_id' => $candidature->candidature_id,
                                      'test_id' => $candidature->offreDeStage->departement->tests->first()->test_id])}}">
                                      <div class="accroche-btn btn-violet">Passer le test</div>
                                    </a>
                                    @else
                                    {{ $candidature->statut }}
                                    @endif
                                </td>
                                <td>{{ $candidature->offreDeStage->titre}}</td>
                                <!-- Ajoutez d'autres cellules si nécessaire -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Vous n'avez encore aucune candidature.</p>
        @endif
    </div>
    
   
</div>
@else

<div class="container container-perso-t">
    <div class="profil">
        <div class="profil-photo-nom">
            <div class="profil-photo ">
                @if ( Auth::user()->administrateur->employe->photo != NULL)
                    <img class="shadow" src="{{ asset(Auth::user()->administrateur->employe->photo) }}" alt="">
                @else
                    <img class="shadow" src="{{ asset('storage/3.png') }}" alt="" >
                @endif
            </div>
            <div class="profil-nom">
                <div class="accroche-titre">
                    <h2>{{ Auth::user()->prenom }}</h2>
                    <h1>{{ Auth::user()->nom }}</h1>
                    <p>{{ Auth::user()->email }}</p>
                    <form action="{{ route('candidat.logout')}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="accroche-btn btn-violet-reverse">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="candidatures">
        <div class="accroche-titre">
            <h3 style="text-align: center;">Vous etes un admin.</h3>
        </div>
    </div>
    
   
</div>
@endif

@endsection


