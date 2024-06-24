<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Candidat;
use App\Models\Candidature;
use App\Models\Employe;
use App\Models\Entretien;
use App\Models\Photo;
use App\Models\Reponse;
use App\Models\Test;
use App\Models\Question;
use App\Models\Tester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class CandidatController extends Controller
{
     // Afficher la liste des Candidats
     public function index()
     {
         $Candidats = Candidat::all();
         return response()->json($Candidats);
     }

     // Afficher le formulaire de création d'un nouvel Candidat
     public function create()
     {
         // Ce sera utilisé pour les vues, mais pour l'API, ce n'est pas nécessaire.
     }

     // Stocker un nouvel Candidat
     public function store(Request $request)
     {
        $validatedData = $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'sexe' => 'required|string|max:1',
            'age' => 'required|integer|min:1',
            'ecole' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Crée un nouvel utilisateur
        $user = new User;
        $user->nom = $validatedData['surname'];
        $user->prenom = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = "candidat";
        $user->password = bcrypt($validatedData['password']);
        $user->save();

        // cree un candidat
        $candidat = new Candidat;
        $candidat->sexe = $validatedData['sexe'];
        $candidat->age = $validatedData['age'];
        $candidat->ecole = $validatedData['ecole'];
        $candidat->user_id = $user->user_id;
        $candidat->save();

        Auth::login($user, true);

        // Redirige l'utilisateur ou affiche un message de succès
        return redirect('/')->with('success', 'Inscription réussie!');
     }

     // Afficher un Candidat spécifique
     public function show($id)
     {
         $Candidat = Candidat::find($id);
         if (!$Candidat) {
             return response()->json(['message' => 'Candidat non trouvé'], 404);
         }
         return response()->json($Candidat);
     }

     // Afficher le formulaire d'édition d'un Candidat
     public function edit($id)
     {
         // Ce sera utilisé pour les vues, mais pour l'API, ce n'est pas nécessaire.
     }

     // Mettre à jour un Candidat existant
     public function update(Request $request, $id)
     {
         $Candidat = Candidat::find($id);
         if (!$Candidat) {
             return response()->json(['message' => 'Candidat non trouvé'], 404);
         }
         $Candidat->update($request->all());
         return response()->json($Candidat);
     }

     // Supprimer un Candidat
     public function destroy($id)
     {
         $Candidat = Candidat::find($id);
         if (!$Candidat) {
             return response()->json(['message' => 'Candidat non trouvé'], 404);
         }
         $Candidat->delete();
         return response()->json(['message' => 'Candidat supprimé avec succès']);
     }

     public function showLoginForm()
    {
        return view('forms/signup');
    }

    // Traite la soumission du formulaire de connexion
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, true)) {
            // Authentifie l'utilisateur et crée un cookie de session persistant
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas.',
        ]);
    }

    // Déconnecte l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function passerTest(int $candidature_id, int $test_id){
        $candidature = Candidature::find($candidature_id);
        $test = Test::find($test_id);
        $questions = Question::where('test_id', $test_id)->get();
        $reponses = [];
        foreach ($questions as $question) {
            $reponses[] = Reponse::where('test_id', $test_id)->where('num_question', $question->num_question)->get();
        }
        return view('passerTest', compact('candidature','test','questions','reponses'));
    }

    public function photoStore(Request $request)
    {
        try {
            $test = $request->get('test');
            $candidature = $request->get('candidature');
            $data = $request->get('image');

            $data = str_replace('data:image/png;base64,', '', $data);
            $data = str_replace(' ', '+', $data);

            // Décoder les données de l'image
            $imageData = base64_decode($data);

            // Définir le chemin de stockage de l'image
            $fileName = time() . '.png';
            $filePath = public_path('photos/' . $fileName);

            // Vérifier si le répertoire "photos" existe, sinon le créer
            if (!File::exists(public_path('photos'))) {
                File::makeDirectory(public_path('photos'), 0755, true);
            }

            $photo = new Photo();
            $photo->test_id = $test['test_id'];
            $photo->candidature_id = $candidature['candidature_id'];
            $photo->lien = $fileName;
            $photo->save();
            // Enregistrer l'image sur le serveur
            file_put_contents($filePath, $imageData);
            return response()->json(['success' => true, 'message' => 'Photo submitted successfully', 'data23'=> $filePath]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the data', 'error' => $e->getMessage()]);
        }

    }

    public function ansStore(Request $request) {
        $questionReponse = $request->get('question_reponse');
        $test = $request->get('test');
        $candidature = $request->get('candidature');
        $questions = Question::where('test_id', $test['test_id'])->get();
        $note = 0;

        for ($i=0; $i < count($questionReponse); $i++) {
            $bonneReponse = Reponse::where('num_reponse', ++$questions[$i]->bonne_reponse_id)->where('test_id', $test['test_id'])->where('num_question', $questions[$i]->num_question)->first();
            $reponse = $questionReponse[$i];
            if ($reponse['answer'] == $bonneReponse->enonce) {
               $note += $questions[$i]->points;
            }
        }

        $tester = Tester::firstOrNew(['test_id' => $test['test_id'], 'candidature_id' => $candidature['candidature_id']]);
        $tester->note = $note;
        if ($note <= 25) {
            $tester->decision = "Mediocre";
        } else if ($note <= 50) {
            $tester->decision = "Insuffisant";
        } else if ($note <= 75) {
            $tester->decision = "Bien";
        } else {
            $tester->decision = "Tres bien";
        }

        try {
            $tester->save();
            return response()->json(['success' => true, 'message' => 'Answer submitted successfully', 'test'=> $note, 'test4'=> $candidature['candidature_id']]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the data', 'error' => $e->getMessage()]);
        }

    }

    public function resultatTech(int $candidature_id, int $test_id) {
        $tester = Tester::where('test_id',$test_id)->where('candidature_id', $candidature_id)->first();

        return view('resultat',compact('tester'));
    }

    public function entretien(Request $request) {
        $heure = $request->get('heure');
        $date = $request->get('date');
        $statut = $request->get('statut');
        $type = $request->get('type');
        $candidature_id = $request->get('candidature_id');
        $employe_id = $request->get('employe_id');
        $candidature = Candidature::find($candidature_id);

        $entretien = new Entretien();
        $entretien->heure = $heure;
        $entretien->date = $date;
        $entretien->statut = $statut;
        $entretien->type = $type;
        $entretien->employe_id = $employe_id;
        $entretien->candidature_id = $candidature_id;

        if ($type == 'en présentiel'){
            $entretien->lien = null;
        } else {
            $entretien->lien = env('APP_URL') . '/entretien/' . $candidature_id;
        }
        // Envoyer la notification par email
        Mail::to($candidature->candidat->user->email)->send(new NotificationMail());

        $entretien->save();
        return redirect()->route('dashboard.entretiens');;
    }

    public function entretienVideo($id){
        return view('entretien',compact('id'));
    }

    public function editEntretien (Entretien $entretien){
        $candidature=Candidature::all();
        $employe=Employe::all();
        return view('',compact('entretien','candidature','employe'));
    }

    public function updateEntretien (Request $request,Entretien $entretien){

        $entretien->update(($request->validated()));
        return redirect()->route('')->with('status', 'Modifiée avec succès !');
    }

    public function destroyEntretien (Entretien $entretien){
        $entretien->delete();
        return redirect()->route('')->with('status', 'Supprimée avec succès !');
    }
}


