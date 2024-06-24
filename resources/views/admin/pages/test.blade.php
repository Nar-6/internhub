@extends('admin/base')

@section('script-haut')

@endsection

@section('sidecontent')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.index') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.candidatures') }}">Candidatures</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Candidats</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso dash-active" aria-current="page" href="{{ route('dashboard.tests')}}">Tests</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Stages</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Offres de stage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Employes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Entretiens</a>
    </li>
</ul>
@endsection

@section('content')

    <div class="epreuve">
        <h2>{{$test->contenu}}</h2>
        @for ($i = 0; $i < count($questions); $i++)
        <div class="question">
            <h3>Q{{$i+1}}: {{$questions[$i]->enonce}}</h3>
            @for ($j = 0; $j < count($reponses[$i]); $j++)
            <div class="reponse">
                <h6>R{{$j+1}}: {{$reponses[$i][$j]->enonce}}</h6>
            </div>
            @endfor
            
        </div>
        @endfor
        
    </div>
 
@endsection
