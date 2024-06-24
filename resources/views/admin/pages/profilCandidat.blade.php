@extends('admin/base')

@section('sidecontent')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link nav-link-perso" aria-current="page" href="{{ route('dashboard.index')}}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.candidatures')}}">Candidatures</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Candidats</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Tests</a>
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
        <a class="nav-link nav-link-perso" href="#">Tests</a>
    </li>
</ul>
@endsection
@section('content')
<div class="profil-candidat-dash">

    <div class="container container-perso-t">
        <div class="profil">
            <div class="profil-photo-nom">
                <div class="profil-photo ">
                    @if ( $candidat->photo != NULL)
                        <img class="shadow" src="{{ asset($candidat->photo) }}" alt="">
                    @else
                        <img class="shadow" src="{{ asset('storage/3.png') }}" alt="" >
                    @endif
                </div>
                <div class="profil-nom">
                    <div class="accroche-titre">
                        <h2>{{ $candidat->user->prenom }}</h2>
                        <h1>{{ $candidat->user->nom }}</h1>
                        <p>{{ $candidat->user->email }}</p>
                        <div class="document">
                            <div class="cv">
                                <h6>Curriculum Vitae</h6>
                                @if ($candidat->cv)
                                    <a href="{{$candidat->cv}}" download="{{$candidat->user->prenom}}_{{$candidat->user->prenom}}_CV.pdf">Télécharger le CV</a>
                                @else
                                    <p>Pas de CV.</p>   
                                @endif
                            </div>
                            <div class="lettre">
                                <h6>Lettre de Motivation</h6>
                                @if ($candidat->cv)
                                    <a href="{{$candidat->lettre_de_motivation}}" download="{{$candidat->user->prenom}}_{{$candidat->user->prenom}}_Lettre_de_Motivation.pdf">Télécharger la Lettre de Motivation</a>
                                @else
                                    <p>Pas de lettre.</p>   
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="candidature-select">
            <div class="offre">
                <h3>{{$candidature->offreDeStage->titre}}</h3>
                <p>{{$candidature->offreDeStage->description}}</p>
                <h4>{{$candidature->offreDeStage->departement->nom_departement}}</h4>
                <h5>Valable jusqu'au {{$candidature->offreDeStage->date_fin}}</h5>
            </div>
        </div>

        @if ($candidature->statut == "soumis" || $candidature->statut == "en attente")
            <div class="choix-decision">
                <a href="{{route('dashboard.choix', ['candidature_id' => $candidature->candidature_id, 'choix' => 0])}}">
                    <div class="btn-rejete accroche-btn btn-violet-reverse">Rejeter</div>
                </a>
                <a href="{{route('dashboard.choix', ['candidature_id' => $candidature->candidature_id, 'choix' => 1])}}">
                    <div class="btn-accepte accroche-btn btn-violet">Accepter</div>
                </a>
            </div>
        @endif

        @if ($candidature->statut == "accepté" )'
            
            @if (isset($tester->note))
                <div class="afficher-resultat">
                    <h2>Note</h2>
                    {{-- @dd($tester) --}}
                    <h3>{{ $tester->note }}</h3>
                </div>
                <div class="organiser-entretien" type="button" data-toggle="modal" data-target="#exampleModalCenterEntretien">
                    <div class="accroche-btn btn-violet">Organiser entretiens</div>
                </div>
            @endif
        @endif
       

        <div class="candidatures">
            <div class="accroche-titre">
                <h2 style="text-align: center;">Ses candidatures</h2>
            </div>
            @if ($candidat->candidatures->isNotEmpty())
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
                            @foreach ($candidat->candidatures as $candidature)
                                <tr style="padding: 20px;">
                                    <td style="padding-right: 20px;">{{ $candidature->date_soumission }}</td>
                                    <td style="padding-right: 20px;">{{ $candidature->statut }}</td>
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
</div>

@endsection

@section('modal-deux')
    <!-- Modal -->
 <div class="modal fade" id="exampleModalCenterEntretien" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Organiser un entretien</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('entretien')}}" method="POST">
                @csrf
            
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                    @if ($errors->has('date'))
                        <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                </div>
            
                <div class="form-group">
                    <label for="heure">Heure</label>
                    <input type="time" class="form-control" name="heure" id="heure" required>
                    @if ($errors->has('heure'))
                        <span class="text-danger">{{ $errors->first('heure') }}</span>
                    @endif
                </div>
            
                <input type="hidden" name="statut" value="prévu">
            
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="en ligne" required>
                    <label class="form-check-label" for="inlineRadio1">En ligne</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="en présentiel" required>
                    <label class="form-check-label" for="inlineRadio2">En présentiel</label>
                </div>
                @if ($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <small id="typeHelp" class="form-text text-muted">Choisissez le type d'entretien.</small>
                
                <input type="hidden" name="candidature_id" value={{$candidature->candidature_id}}>
            
                <div class="form-group">
                    <label for="employe_id">Employé</label>
                    @php
                        use App\Models\Employe;
                        $employes = Employe::all();
                    @endphp
                    <select class="custom-select custom-select-sm" name="employe_id" id="employe_id" required>
                        <option selected>Choisissez un employé</option>
                        @foreach ($employes as $employe)
                            <option value={{$employe->employe_id}}>{{$employe->prenom}} {{$employe->nom}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('employe_id'))
                        <span class="text-danger">{{ $errors->first('employe_id') }}</span>
                    @endif
                </div>
            
                <button type="submit" class="accroche-btn btn-violet" style="border: 0px !important;">Submit</button>
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