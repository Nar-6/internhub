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
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.offres')}}">Offres de stage</a>
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
            @foreach ($tests as $test)
                <a href="{{route('admin.test.show', $test->test_id)}}" style="color: black;">
                    <div class="tests-ligne shadow" >
                        <div class="tests-colonne">{{$test->contenu}}</div>
                        <div class="tests-colonne">{{$test->type}}</div>
                        <div class="tests-colonne">{{$test->departement->nom_departement}}</div>
                        <div class="tests-colonne">{{$test->contenu}}</div>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Creer un test</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('dashboard.questionsShow')}}">
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
                    <input type="text" class="form-control" name="contenu" id="titre" placeholder="Donnez un titre au test" required>
                    @if ($errors->has('contenu'))
                        <span class="text-danger">{{ $errors->first('contenu') }}</span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="nbrQuestion">Questions</label>
                  <input type="number" class="form-control" name="nbrQuestion" id="nbrQuestion" placeholder="Entrez le nombre de question du test" required>
                  @if ($errors->has('nbrQuestion'))
                      <span class="text-danger">{{ $errors->first('nbrQuestion') }}</span>
                  @endif
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="technique" required>
                    <label class="form-check-label" for="inlineRadio1">Technique</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="personnalité" required>
                    <label class="form-check-label" for="inlineRadio2">Personnalite</label>
                </div>
                @if ($errors->has('type'))
                      <span class="text-danger">{{ $errors->first('type') }}</span>
                  @endif
                <small id="emailHelp" class="form-text text-muted">Choisissez le type.</small>
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