<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Sécurisé</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .no-select {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            display: flex;
            justify-content: center;
            align-content: center;
        }
        .test-container {
            display: flex;
            justify-content: space-around;
        }
        .test-texte {
            margin-top: auto;
            margin-bottom: auto; 
        }
        #test-container {
            width: 900px;
            margin-right: auto;
            margin-left: auto;
        }
        html, body {
            width: 98% !important;
            height: 95% !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="no-select">
    <div class="container mt-5" style="height: fit-content; margin-top: 100px !important;">
        <div class="row">
            <div class="">
                <div class="test-container">
                    <div class="test-texte">
                        <h2 style="font-size:4em; font-family:'Burma', sans-serif;">{{$test->contenu}}</h2>
                        <p style="width: 600px; font-size:2em;">
                            Au cours du test votre camera sera utilisée pour vous surveiller.
                            Lorsque vous serez prêt, nous vous invitons à appuyer sur le bouton pour commencer.
                        </p>
                        <button id="start-test" class="accroche-btn btn-violet" style="border: 0px;">Passer le test</button>
                    </div>
                    <div>
                        <img class="img-b" src="{{ asset('storage/1.png') }}" alt="">
                    </div>
                </div>
                
                    <div id="test-container" style="display:none;">
                        <h2 id="question" class="mb-4"></h2>
                        <div id="options" class="mb-4"></div>
                        <button id="next-button" type="button" class="btn btn-primary">Suivant</button>
                        <p id="timer" class="font-weight-bold"></p>
                    </div>
                
            </div>
        </div>
    </div>
    <div id="camera-container" style="display:none;">
        <video id="video" width="640" height="480" autoplay></video>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const test = {!! json_encode($test) !!};
        const questions = {!! json_encode($questions) !!};
        const reponses = {!! json_encode($reponses) !!};
        const candidature = {!! json_encode($candidature) !!};
        let stream = null;
        const questionReponse = [];

        let currentQuestionIndex = 0;
        let timeLeft = 45;
        let timerInterval;
        let photoInterval;

        function startTest() {
            document.querySelector('.test-container').style.display = 'none';
            document.getElementById('start-test').style.display = 'none';
            document.getElementById('test-container').style.display = 'block';
            startCamera();
            showQuestion(currentQuestionIndex);
            photoInterval = setInterval(() => {
                takePhoto();
            }, Math.random() * 30000);
        }

        document.getElementById('start-test').addEventListener('click', startTest);
        document.getElementById('next-button').addEventListener('click', nextQuestion);

        function showQuestion(index) {
            if (index >= questions.length) {
                clearInterval(timerInterval);
                clearInterval(photoInterval);
                document.getElementById("test-container").innerHTML = `<h2 style="text-align:center;">Test terminé !</h2>
                                             <a href="{{route('resultat.tech', ['candidature_id' => $candidature->candidature_id, 'test_id' => $test->test_id])}}">
                                                <button  class="accroche-btn btn-violet" style="border: 0px;">Vos resultats</button></a>
                       `;
                document.getElementById('start-test').removeEventListener('click', startTest);
                return;
            }

            const questionElement = document.getElementById("question");
            const optionsElement = document.getElementById("options");
            const timerElement = document.getElementById("timer");

            const currentQuestion = questions[index];
            questionElement.textContent = currentQuestion.enonce;
            optionsElement.innerHTML = "";

            reponses[index].forEach((option, i) => {
                const formGroup = document.createElement("div");
                formGroup.className = "form-group";

                const input = document.createElement("input");
                input.type = "radio";
                input.name = `option`;
                input.value = option.enonce;
                input.id = `option${i}`;

                const label = document.createElement("label");
                label.htmlFor = `option${i}`;
                label.textContent = option.enonce;

                formGroup.appendChild(input);
                formGroup.appendChild(label);
                optionsElement.appendChild(formGroup);
            });

            timeLeft = 45; // Set timeLeft to 45 seconds
            timerElement.textContent = `Temps restant : ${timeLeft}s`;
            clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                timeLeft--;
                timerElement.textContent = `Temps restant : ${timeLeft}s`;
                if (timeLeft <= 0) {
                    nextQuestion();
                }
            }, 1000);
        }

        async function submitAnswer(questionIndex, answer) {
            questionIndex++;
            questionReponse.push({questionIndex,answer});
            if (questionReponse.length == questions.length) {
                stopCamera();
                try {
                    const routeUrl = '{{ route('ans.store') }}';
                    
                    const response = await axios.post(routeUrl, {
                        question_reponse: questionReponse,
                        test: test,
                        candidature: candidature
                    }, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                    console.log(response);
                    } catch (error) {
                    console.error('Error submitting answer:', error);
                }
            }
        }

        function nextQuestion() {
            const selectedOption = document.querySelector('input[name="option"]:checked');
            if (selectedOption) {
                submitAnswer(currentQuestionIndex, selectedOption.value);
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            } else if(timeLeft <= 0) {
                submitAnswer(currentQuestionIndex, null);
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            } else {
                alert("Veuillez sélectionner une option avant de continuer.");
            }
        }

        function startCamera() {
            const video = document.getElementById('video');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then((mediaStream) => {
                    stream = mediaStream;
                    video.srcObject = stream;
                })
                .catch((err) => {
                    console.error('Erreur accès caméra: ', err);
                });
        }

        function stopCamera() {
            if (stream) {
                let tracks = stream.getTracks();
                tracks.forEach(track => track.stop());
                stream = null;
            }
        }

        async function takePhoto() {
            const video = document.getElementById('video');
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png');
            const routeUrl = '{{ route('photo.store') }}';
            console.log('Submitting to URL:', routeUrl); // Vérifiez que l'URL est correcte

            try {
                const response = await axios.post(routeUrl, {
                        image: dataURL,
                        test: test,
                        candidature: candidature
                    }, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    });
                    console.log(response);
            }
            catch (error) {
                    console.error('Error submitting image:', error);
            }
        }

    </script>
</body>
</html>
