@extends('admin/base')

@section('script-haut')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const candidatures = @json($candidatures);
        const entretiens = @json($entretiens);
        const candidats = @json($candidats);
        const offres = @json($offres);
        const users = @json($users);

        const prevu = [];
        const termine = [];
        const annule = [];

        entretiens.forEach(element => {
            let entretien = {
                entretien_id: element.entretien_id,
                candidature_id: element.candidature_id,
                date: element.date,
                candidat: '', // Initialiser la valeur du candidat
                offre: '', // Initialiser la valeur de l'offre
            };

            const candidature = candidatures.find(c => c.candidature_id === element.candidature_id);
            if (candidature) {
                const candidat = candidats.find(u => u.candidat_id === candidature.candidat_id);
                if (candidat) {
                    const user = users.find(l => l.user_id === candidat.user_id);
                    if (user) {
                        entretien.candidat = `${user.nom} ${user.prenom}`;
                    }
                }
                const offre = offres.find(o => o.offre_de_stage_id === candidature.offre_de_stage_id);
                if (offre) {
                    entretien.offre = offre.titre;
                }
            }

            

            switch (element.statut) {
                case 'prévu':
                    prevu.push(entretien);
                    break;
                case 'terminé':
                    termine.push(entretien);
                    break;
                case 'annulé':
                    annule.push(entretien);
                    break;
               
            }
        });

        function afficherCandidatures(statuts) {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = ''; // Vide le tableau
            statuts.forEach(element => {
                const row = `
                    <tr onclick="window.location.href='{{ route('dashboard.profilCandidat', ['candidat_id' => '__ID__', 'candidature_id' => '__IDC__']) }}'.replace('__ID__', ${element.candidat_id}).replace('__IDC__', ${element.candidature_id})">
                        <td>${element.date}</td>
                        <td>${element.candidat}</td>
                        <td>${element.offre}</td>
                        <td>test</td>
                    </tr>`;
                tbody.innerHTML += row;
            });
        }

        // Initial display
        afficherCandidatures(prevu);

        // Add event listeners to navigation items
        document.querySelectorAll('.dash-candidatures-entete nav ul li').forEach((navItem, index) => {
            navItem.addEventListener('click', () => {
                document.querySelectorAll('.dash-candidatures-entete nav ul li').forEach(li => li.classList.remove('active'));
                navItem.classList.add('active');

                switch (index) {
                    case 0:
                        afficherCandidatures(prevu);
                        break;
                    case 1:
                        afficherCandidatures(termine);
                        break;
                    case 2:
                        afficherCandidatures(annule);
                        break;
                }
            });
        });
    });
</script>
@endsection

@section('sidecontent')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.index') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso " href="{{ route('dashboard.candidatures') }}">Candidatures</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Candidats</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.tests') }}">Tests</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Stages</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="{{ route('dashboard.offres') }}">Offres de stage</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso" href="#">Employes</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-perso dash-active" aria-current="page"  href="{{ route('dashboard.entretiens') }}">Entretiens</a>
    </li>
</ul>
@endsection

@section('content')
<style>
    th, td {
        text-align: center;
    }
</style>
<div class="dash-candidatures shadow">
    <div class="dash-candidatures-entete">
        <nav>
            <ul>
                <li class="active">Prevu</li>
                <li >Termine</li>
                <li>Annule</li>
            </ul>
        </nav>
    </div>
    <div class="dash-candidatures-table">
        <div class="table-responsive">
            <table class="table-hover table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Candidat</th>
                        <th scope="col">Offre</th>
                        <th scope="col">Ecole</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Le contenu sera inséré par JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
