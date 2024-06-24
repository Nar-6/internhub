<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jitsi Meet Integration</title>
    <style>
      body{
        margin: 0;
        background-color: black;
      }
        #meet {
            width: 100%;
            height: 99vh;
            border: 0;
        }
    </style>
</head>
<body>
    <div id="meet"></div>
    <script src="https://meet.jit.si/external_api.js"></script>
    <script>
        // Fonction pour générer un nom de salle unique
        function generateRoomName() {
            return 'room-' + Math.random().toString(36).substr(2, 9);
        }

        // Générer un nom de salle unique
        const roomName = generateRoomName();
        const domain = 'meet.jit.si';

        // Options de configuration
        const options = {
            roomName: roomName, // Utiliser le nom de salle unique
            width: '100%',
            height: '100%',
            parentNode: document.querySelector('#meet'),
            interfaceConfigOverwrite: {
                // Désactiver certaines options de l'interface
                filmStripOnly: false,
                SHOW_JITSI_WATERMARK: false,
                SHOW_BRAND_WATERMARK: false,
                TOOLBAR_BUTTONS: [
                    'microphone', 'camera', 'desktop', 'fullscreen',
                    'fodeviceselection', 'hangup', 'chat', 'recording',
                    'livestreaming', 'etherpad', 'sharedvideo', 'settings',
                    'raisehand', 'videoquality', 'filmstrip', 'invite', 'feedback',
                    'stats', 'shortcuts', 'tileview', 'download', 'help', 'mute-everyone',
                    'e2ee'
                ]
            },
            configOverwrite: {
                // Configurer les options de réunion
                disableSimulcast: false,
                enableRecording: true,
                enableWelcomePage: false,
                defaultLanguage: 'fr'
            }
        };

        // Initialisation de l'API Jitsi Meet
        const api = new JitsiMeetExternalAPI(domain, options);

        // Gestion des événements
        api.addEventListener('participantJoined', (event) => {
            console.log(`Participant joined: ${event.id}`);
        });

        api.addEventListener('participantLeft', (event) => {
            console.log(`Participant left: ${event.id}`);
        });

        api.addEventListener('videoConferenceJoined', (event) => {
            console.log(`Joined conference: ${event.roomName}`);
        });

        api.addEventListener('videoConferenceLeft', (event) => {
            console.log('Left the conference');
        });

        // Afficher le lien unique pour la réunion
        const meetingLink = `https://${domain}/${roomName}`;
        console.log(`Lien unique pour la réunion : ${meetingLink}`);
        //document.body.insertAdjacentHTML('beforeend', `<p>Lien pour rejoindre la réunion : <a href="${meetingLink}" target="_blank">${meetingLink}</a></p>`);
    </script>
</body>
</html>
