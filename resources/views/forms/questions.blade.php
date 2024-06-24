<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('storage/1.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Interhub - Trellix</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
         @media (width >= 628px ) {
            .login-card {
                position: relative;
                z-index: 3;
                width: 100%;
                margin: 0 20px ;
                padding: 70px 30px 44px;
                border-radius: 20px;
                background: rgb(24 21 36 / 66%);
                backdrop-filter: blur(10px);
                text-align: center;
                right: auto !important;
                left: auto !important;
                max-width: 900px !important;
            }   
            .login-login {
               margin-bottom: 70px;
            }   
        }
    </style>
    <script>
        function generateInputs(index) {
            const nbrReponse = document.getElementById(`nbrReponse${index}`).value;
            const loginDivBlock = document.getElementById(`login-div-block${index}`);

            // Clear previous inputs
            loginDivBlock.innerHTML = '';

            for (let i = 1; i <= nbrReponse; i++) {
                const inputTrueResponse = document.createElement('input');
                const inputText = document.createElement('input');

                if ( i == 1 ) {
                    inputTrueResponse.type = 'text';
                    inputTrueResponse.name = `reponse${index}_${i}`;
                    inputTrueResponse.id = `reponse${index}_${i}`;
                    inputTrueResponse.placeholder = 'Entrez la bonne reponse ici';
                    inputTrueResponse.required = true;
                    loginDivBlock.appendChild(inputTrueResponse);
                } else {
                    inputText.type = 'text';
                    inputText.name = `reponse${index}_${i}`;
                    inputText.id = `reponse${index}_${i}`;
                    inputText.placeholder = `Entrez l'enoncé de l'option ${i}`;
                    inputText.required = true;
                    loginDivBlock.appendChild(inputText);
                }

            }
        }
    </script>
</head>
<body class="formulaire" style="background: url({{ asset('storage/bg2.svg') }}) fixed;  background-size: cover;background-repeat: no-repeat; background-position: center;">
    <div class="login-card">
        <h3>TESTS</h3>
        <form action="{{ route('tests.store')}}" method="POST" class="login-form">
            @csrf
            
            @for ($i = 1; $i <= $nbrQuestion; $i++)
                <div class="login-content">
                    <input type="number" name="nbrReponse{{$i}}" id="nbrReponse{{$i}}" placeholder="Nombre d'option de reponse" required oninput="generateInputs({{$i}})">
                    <input type="text" name="enonce{{$i}}" id="enonce{{$i}}" placeholder="Entrez l'enoncé de la question" required>
                    <div class="login-div-block" id="login-div-block{{$i}}">
                        <!-- Les champs de réponse seront générés ici -->
                    </div>
                </div>
            @endfor
            <input type="hidden" name="departement" value={{$departement}}>
            <input type="hidden" name="nbrQuestion" value={{$nbrQuestion}}>
            <input type="hidden" name="type" value={{$type}}>
            <input type="hidden" name="contenu" value={{$contenu}}>
            <br>
            <button type="submit">Log in</button>
        </form>
    
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif
    
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>

