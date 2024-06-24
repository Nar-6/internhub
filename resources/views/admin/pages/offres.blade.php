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
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.tests')}}">Tests</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Stages</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso dash-active" aria-current="page" href="{{ route('dashboard.offres')}}">Offres de stage</a>
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
    <div class="dash-tests">
        <div class="tests-boutons">
            <div class="ajouter" type="button" data-toggle="modal" data-target="#exampleModalCenter" >
                <i class="fa fa-plus fa-2" aria-hidden="true"></i>
            </div>
        </div>
        
        <div class="tests-listes">
            @foreach ($offres as $offre)
                <a href="{{route('admin.offre.show', $offre->offre_de_stage_id)}}" style="color: black;">
                    <div class="tests-ligne offres-ligne shadow" >
                        <div class="tests-colonne offres-colonne">{{$offre->titre}}</div>
                        {{-- <div class="tests-colonne">{{$offre->description}}</div> --}}
                        <div class="tests-colonne offres-colonne">Fin : {{$offre->date_fin}}</div>
                        <div class="tests-colonne offres-colonne">{{$offre->departement->nom_departement}}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

  
 
@endsection



@section('modal-deux')
    
 <!-- Modal -->
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une offre</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('offres.store')}}">
                @csrf
                <div class="form-group">
                  <label for="departement">Departement</label>
                  @php
                      use App\Models\Departement;
                      $departements = Departement::all();
                  @endphp
                  <select class="custom-select custom-select-sm" name="departement" id="departement" required>
                    <option selected>Choisissez un departement</option>
                    @foreach ($departements as $departement)
                        <option value={{$departement->departement_id}}>{{$departement->nom_departement}}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('departement'))
                      <span class="text-danger">{{ $errors->first('departement') }}</span>
                  @endif
                </div>
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" name="titre" id="titre" placeholder="Donnez un titre" required>
                    @if ($errors->has('titre'))
                        <span class="text-danger">{{ $errors->first('titre') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" placeholder="Donnez une description" required></textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>                
                <div class="form-group">
                    <label for="date">Date de fin de l'offre</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                    @if ($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                </div>
                <br>
                <button type="submit" class="accroche-btn btn-violet " style="border: 0px !important;">Submit</button>
            </form>
        </div>
        {{-- <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
          +

          <button type="button" class="btn btn-primary">Commencer</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection