<?php

namespace App\Http\Controllers;

use App\Mail\NotificationMail;
use App\Models\Candidat;
use App\Models\Candidature;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\Entretien;
use App\Models\OffreDeStage;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\Test;
use App\Models\Tester;
use App\Models\User;
use App\Notifications\CandidatureAccepted;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index() {
         // Récupérer toutes les candidatures
        $currentYear = Carbon::now()->year;
        $candidatures = Candidature::whereYear('date_soumission', $currentYear)->get();
        $candidats = Candidat::all();
        $tests = Test::all();
        $offres = OffreDeStage::all();
        $employes = Employe::all();


         // Créer un tableau pour stocker les données mensuelles
         $monthlyCandidatures = [];
 
         // Initialiser le tableau avec les mois de l'année
         for ($month = 1; $month <= 12; $month++) {
             $monthlyCandidatures[$month] = 0;
         }
 
         // Parcourir chaque candidature et incrémenter le compteur du mois correspondant
         foreach ($candidatures as $candidature) {
             $month = Carbon::parse($candidature->date_soumission)->month;
             $monthlyCandidatures[$month]++;
         }
 
         // Préparer les données pour le graphique
         $data = [
             'labels' => [
                 'January', 'February', 'March', 'April', 'May', 'June', 
                 'July', 'August', 'September', 'October', 'November', 'December'
             ],
             'datasets' => [
                 [
                     
                     'backgroundColor' => 'purple',
                     'borderColor' => 'rgba(75, 192, 192, 1)',
                     'data' => array_values($monthlyCandidatures),
                 ],
             ],
         ];
 
         return view('admin.dashboard', compact('data','monthlyCandidatures','candidatures', 'candidats', 'tests', 'offres', 'employes'));
    }

    public function candidatures() 
    {
        $candidatures = Candidature::all();
        $candidats = Candidat::all();
        $offres = OffreDeStage::all();
        $users = User::all();
        return view('admin.pages.candidatures', compact('candidatures', 'candidats', 'offres', 'users'));
    }

    public function entretiens() 
    {
        $entretiens = Entretien::all();
        $candidatures = Candidature::all();
        $candidats = Candidat::all();
        $offres = OffreDeStage::all();
        $users = User::all();
        return view('admin.pages.entretiens', compact('entretiens', 'candidatures', 'candidats', 'offres', 'users'));
    }
    public function profilCandidat(int $candidat_id, int $candidature_id) 
    {
        $candidat = Candidat::find($candidat_id);
        $candidature = Candidature::find($candidature_id);
        
        if ($candidature->statut == "soumis") {
            $candidature->statut = "en attente";
            $candidature->update();
        }
        $tester = Tester::where('candidature_id','=', $candidature_id)->first();
        return view('admin.pages.profilCandidat', compact('candidat', 'candidature', 'tester'));
    }

    public function choix(int $candidature_id, bool $choix)
    {
        $candidature = Candidature::find($candidature_id);
    
        if ($choix) {
            $candidature->statut = "accepté";
            $candidature->update();
    
            $offreDeStage = $candidature->offreDeStage;
            if ($offreDeStage) {
                $test = Test::where('departement_id', $offreDeStage->departement_id)->first();
                if ($test) {
                    $tester = new Tester();
                    $tester->test_id = $test->test_id; // ou $test->test_id selon votre colonne primaire
                    $tester->candidature_id = $candidature->candidature_id; // ou $candidature->candidature_id selon votre colonne primaire                    
                    $tester->save();
    
                    // Envoyer la notification par email
                    Mail::to($candidature->candidat->user->email)->send(new NotificationMail());
                }
            }
        } else {
            $candidature->statut = "rejeté";
            $candidature->update();
        }
    
        return redirect()->back();
    }

    public function tests() 
    {
        $tests = Test::all();
        return view('admin.pages.tests', compact('tests'));
    }

    public function questionsShow(Request $request) {
        $validatedData = $request->validate([
            'type' => 'required|string|in:personnalité,technique',
            'departement' => 'required|integer',
            'nbrQuestion' => 'required|integer',
            'contenu' => 'required|string|max:255',
        ]);

        $type = $validatedData['type'];
        $departement = $validatedData['departement'];
        $nbrQuestion = $validatedData['nbrQuestion'];
        $contenu = $validatedData['contenu'];

        return view('forms.questions', compact('type','departement','nbrQuestion','contenu'));
    }

    public function testsStore(Request $request) {
        $validatedData = $request->validate([
            'type' => 'required|string|in:personnalité,technique',
            'departement' => 'required|integer',
            'nbrQuestion' => 'required|integer',
            'contenu' => 'required|string|max:255',
        ]);

        $type = $validatedData['type'];
        $departement = $validatedData['departement'];
        $nbrQuestion = $validatedData['nbrQuestion'];
        $contenu = $validatedData['contenu'];

        $test = new Test();
        $test->type = $type;
        $test->departement_id = $departement;
        $test->contenu = $contenu;
        $test->save();

        for ($i = 1; $i <= $nbrQuestion; $i++) {
            $question = new Question();
            $question->num_question = $i;
            $question->enonce = $request->get('enonce'. $i);
            $question->test_id = $test->test_id;
            $question->points = $request->get('points'. $i, 100/$nbrQuestion);

            for ($j=1; $j <= $request->get('nbrReponse'.$i) ; $j++) { 
                $reponse = new Reponse();
                $reponse->num_reponse = $j;
                $reponse->enonce = $request->get('reponse'. $i.'_'.$j);
                $reponse->num_question = $question->num_question;
                $reponse->test_id = $test->test_id;

                if ( $j == 1 ){
                    $question->bonne_reponse_id = $reponse->num_reponse;
                }
                $reponse->save();
            }
            $question->save();
        }

        return redirect()->route('dashboard.tests');
    }

    public function testShow(int $test_id) {
        $test = Test::find( $test_id );
        $questions = Question::where('test_id', $test_id)->get();
        $reponses = [];
        foreach ($questions as $question) {
            $reponses[] = Reponse::where('test_id', $test_id)->where('num_question', $question->num_question)->get();
        }
        return view('admin.pages.test', compact('test','questions','reponses'));
    }

    public function offres() {
        $offres = OffreDeStage::all()->reverse();
        return view('admin.pages.offres', compact('offres'));
    }

    public function offreShow(int $offre_id) {
        $offre =OffreDeStage::find( $offre_id );
        return view('admin.pages.offre', compact('offre'));
    }

    public function offresStore(Request $request) {
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'departement' => 'required|integer',
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        $offre = new OffreDeStage();
        $offre->titre = $validatedData['titre'];
        $offre->departement_id = $validatedData['departement'];
        $offre->date_fin = $validatedData['date'];
        $offre->description = $validatedData['description'];
        $offre->date_publication = Carbon::today();
        $offre->save();

        return redirect()->route('dashboard.offres');
    }
}
