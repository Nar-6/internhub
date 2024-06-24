@extends('admin/base')

@section('script-haut')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const candidatures = @json($candidatures);
        const candidats = @json($candidats);
        const offres = @json($offres);
        const users = @json($users);

        const soumis = [];
        const rejete = [];
        const enattente = [];
        const accepte = [];

        candidatures.forEach(element => {
            let candidature = {
                candidature_id: element.candidature_id,
                candidat_id: element.candidat_id,
                date: element.date_soumission,
                candidat: '', // Initialiser la valeur du candidat
                offre: '', // Initialiser la valeur de l'offre
                ecole: '', // Initialiser la valeur de l'école
            };

            const candidat = candidats.find(c => c.candidat_id === element.candidat_id);
            if (candidat) {
                const user = users.find(u => u.user_id === candidat.user_id);
                if (user) {
                    candidature.candidat = `${user.nom} ${user.prenom}`;
                    candidature.ecole = candidat.ecole;
                }
            }

            const offre = offres.find(o => o.offre_de_stage_id === element.offre_de_stage_id);
            if (offre) {
                candidature.offre = offre.titre;
            }

            switch (element.statut) {
                case 'soumis':
                    soumis.push(candidature);
                    break;
                case 'rejeté':
                    rejete.push(candidature);
                    break;
                case 'en attente':
                    enattente.push(candidature);
                    break;
                case 'accepté':
                    accepte.push(candidature);
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
                        <td>${element.ecole}</td>
                    </tr>`;
                tbody.innerHTML += row;
            });
        }

        // Initial display
        afficherCandidatures(enattente);

        // Add event listeners to navigation items
        document.querySelectorAll('.dash-candidatures-entete nav ul li').forEach((navItem, index) => {
            navItem.addEventListener('click', () => {
                document.querySelectorAll('.dash-candidatures-entete nav ul li').forEach(li => li.classList.remove('active'));
                navItem.classList.add('active');

                switch (index) {
                    case 0:
                        afficherCandidatures(soumis);
                        break;
                    case 1:
                        afficherCandidatures(enattente);
                        break;
                    case 2:
                        afficherCandidatures(rejete);
                        break;
                    case 3:
                        afficherCandidatures(accepte);
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
        <a class="nav-link nav-link-perso dash-active" aria-current="page" href="{{ route('dashboard.candidatures') }}">Candidatures</a>
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
        <a class="nav-link nav-link-perso" href="#">Entretiens</a>
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
                <li>Soumises</li>
                <li class="active">En attente</li>
                <li>Rejetées</li>
                <li>Acceptées</li>
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
