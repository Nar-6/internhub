@extends('base')

@section('title')
Trellix - InternHub
@endsection

@section('content')

<div class="container container-perso-t">

    <div class="offres-entete">
        <div class="offres-trellix">
            <img src="{{ asset('storage/logo.png')}}" alt="">
        </div>
        <div class="offres-photo">
            <img src="{{ asset('storage/2.png')}}" alt="">
        </div>
        <div class="offres-internship">
            <div class="accroche-titre">
                <h1>INTERNHUB</h1>
            </div>
        </div>
    </div>

    <div class="offres">
        <div class="offres-gauche">
            @foreach ($offers as $offer)
                @if ($offer->offre_de_stage_id%2 == 0)
                    <div class="offre">
                        <h3>{{$offer->titre}}</h3>
                        <p>{{$offer->description}}</p>
                        <h4>{{$offer->departement->nom_departement}}</h4>
                        <h5>Valable jusqu'au {{$offer->date_fin}}</h5>
                        <form action="{{ route('candidature.create')}}" method="post">
                            @csrf
                            <input type="hidden" name="offre_id" value={{$offer->offre_de_stage_id}}>
                            <button class="accroche-btn">Apply</button>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="offres-droit">
            @foreach ($offers as $offer)
                @if ($offer->offre_de_stage_id%2 != 0)
                    <div class="offre">
                        <h3>{{$offer->titre}}</h3>
                        <p>{{$offer->description}}</p>
                        <h4>{{$offer->departement->nom_departement}}</h4>
                        <h5>Valable jusqu'au {{$offer->date_fin}}</h5>
                        <form action="{{ route('candidature.create')}}" method="post">
                            @csrf
                            <input type="hidden" name="offre_id" value={{$offer->offre_de_stage_id}}>
                            <button class="accroche-btn">Apply</button>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection


