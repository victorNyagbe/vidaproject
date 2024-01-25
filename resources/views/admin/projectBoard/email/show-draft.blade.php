@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/.css') }}">
    <style>
        /* Ajoutez vos styles personnalisés si nécessaire */
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .deplacer: {
            height: 20vh;
        }

        /* Style des images */
        img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            margin: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        /* Style des liens pour télécharger des documents, vidéos et audio */
        .file-link {
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin: 10px;
        }

        .file-link:hover {
            text-decoration: none;
            color: #222;
        }

        /* Style des vidéos et audio */
        video,
        audio {
            max-width: 100%;
            border: 1px solid #ccc;
            margin: 10px;
        }

        .textarea-block {
            color: #000000;
        }

        #fileList {
            display: flex;
            flex-wrap: wrap;
            color: #000000;
        }

        #fileList p {
            margin: 0 auto;
            padding-right: 1rem;
        }

        /* Styles pour le conteneur de chaque fichier */
        .file-name-container {
            display: flex;
            align-items: center;
            padding: 8px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        /* Styles pour le nom du fichier */
        .file-name {
            flex-grow: 1;
            /* Le nom du fichier prend l'espace disponible */
            margin-right: 8px;
            /* Marge à droite pour l'espace du bouton "x" */
            word-break: break-word;
            /* Permet de casser le texte long si nécessaire */
        }

        /* Styles pour le bouton "x" de suppression */
        .file-close {
            cursor: pointer;
            font-weight: bold;
            color: red;
            margin-right: 8px;
            */
            /* Marge à gauche pour séparer du nom du fichier */
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content pt-4">
            <div class="container-fluid">
                @include('admin.includes.messageReturned')
                <div class="row">
                    <div class="col-12 pb-5">
                        <a href="{{ route('admin.projectBoard.email.mail', $project) }}" class="btn btn-success btn-Clicked">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <section class="content pb-3">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- Afficher des détails comme destinataire, date et heure au besoin -->
                                    </div>
                                    <div class="card-body">
                                        <form
                                            action="{{ route('admin.projectBoard.email.updateDraft', ['project' => $project, 'mail' => $mail]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <input class="form-control" name="to" disabled
                                                    value="{{ $client->user_mail }}" placeholder="À">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" name="subject" id="subject"
                                                    placeholder="Sujet" value="{{ $mail->subject }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="mail_message">Message</label>
                                                {{-- <textarea name="mail_message" id="mail_message" class="form-control" value="{{ $mail->message }}" rows="5">{!! html_entity_decode($mail->message) !!}</textarea> --}}
                                                <textarea name="mail_message" id="mail_message" class="form-control" value="{{ $mail->message }}" rows="5">{!! html_entity_decode($mail->message) !!}</textarea>
                                            </div>

                                            <!-- Afficher les pièces jointes existantes avec possibilité de suppression -->
                                            @foreach ($files as $file)
                                                <div class="row">
                                                    <div class="col-3">
                                                        @if ($file->type_file === 'image')
                                                            <a href="{{ asset('storage/app/public/' . $file->file) }}"
                                                                download="{{ $file->file }}">
                                                                <img src="{{ asset('storage/app/public/' . $file->file) }}"
                                                                    alt="{{ $file->file }}">
                                                            </a>
                                                        @elseif ($file->type_file === 'document')
                                                            <a href="{{ asset('storage/app/public/' . $file->file) }}"
                                                                class="file-link"
                                                                download="{{ $file->file }}">{{ \Illuminate\Support\Str::substr($file->file, 14, 60) }}</a>
                                                        @elseif ($file->type_file === 'video')
                                                            <video controls>
                                                                <source
                                                                    src="{{ asset('storage/app/public/' . $file->file) }}"
                                                                    type="video/mp4">
                                                                Votre navigateur ne supporte pas la lecture vidéo.
                                                            </video>
                                                            <a href="{{ asset('storage/app/public/' . $file->file) }}"
                                                                download="{{ $file->file }}">Télécharger la vidéo</a>
                                                        @elseif ($file->type_file === 'audio')
                                                            <audio controls>
                                                                <source
                                                                    src="{{ asset('storage/app/public/' . $file->file) }}"
                                                                    type="audio/mpeg">
                                                                Votre navigateur ne supporte pas la lecture audio.
                                                            </audio>
                                                            <a href="{{ asset('storage/app/public/' . $file->file) }}"
                                                                download="{{ $file->file }}">Télécharger l'audio</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- Champ pour ajouter de nouvelles pièces jointes -->
                                            <div class="form-group">
                                                <label for="new_files">Choisir de nouvelles pièces jointes</label>
                                                <input type="file" name="files[]" multiple id="fileSelector">
                                            </div>

                                            <div class="form-group">

                                                <div id="fileList"></div>

                                                <ul id="customFileList"></ul>

                                            </div>
                                            <input type="hidden" name="filesToBeUploaded[]" value="[]"
                                                id="filesToBeUploaded">

                                            <div class="form-group">
                                                <button type="submit" name="action" value="toSaveDraftUpdate"
                                                    class="btn btn-primary">Enregistrer les modifications</button>
                                                <button type="submit" name="action" value="toSend"
                                                    class="btn btn-success"><i class="fas fa-envelope"></i> Envoyer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#mail_message').summernote({
                lang: 'fr-FR',
                minHeight: 150,
                tabsize: 2,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']]
                ]
            });
        });

        const newFileInput = document.getElementById('fileSelector');
        const newFileListDiv = document.getElementById('fileList');
        const newFilesToBeUploaded = document.getElementById('filesToBeUploaded');
        let objectURLs = []; // Stocker les URLs des objets créés

        const selectedFiles = [];

        newFileInput.addEventListener('change', function(event) {

            newFileListDiv.innerHTML = '';

            objectURLs.forEach(url => URL.revokeObjectURL(url));
            objectURLs = [];

            const files = event.target.files;

            let compteur = 0;

            for (const file of files) {

                selectedFiles.push(file)

                const objectURL = URL.createObjectURL(file);
                const fileId = 'file_' + Date.now(); // Créer un ID unique
                objectURLs[fileId] = objectURL;

                const fileNameContainer = document.createElement('div');
                fileNameContainer.classList.add('file-name-container');
                fileNameContainer.id = fileId;

                const fileName = document.createElement('p');
                fileName.classList.add('file-name');
                fileName.textContent = file.name;

                const fileClose = `
                    <span class="file-close" aria-label="${compteur}" aria-live="${fileId}" onclick="destroyFile(this.ariaLabel, this.ariaLive)">x</span>
                `

                fileNameContainer.innerHTML = fileClose;

                fileNameContainer.appendChild(fileName);

                newFileListDiv.appendChild(fileNameContainer);

                compteur++;

            }

            const objectExtract = selectedFiles.map(file => file.name);

            newFilesToBeUploaded.value = JSON.stringify(objectExtract);

        });

        function destroyFile(compteur, fileId) {

            // Obtenez la liste des fichiers sélectionnés sous forme de tableau
            let getnewFilesToBeUploaded = JSON.parse(newFilesToBeUploaded.value);
            console.log(getnewFilesToBeUploaded);
            // Supprimez le fichier du tableau
            getnewFilesToBeUploaded.splice(compteur, 1);

            // Révoquez l'URL d'objet du fichier
            URL.revokeObjectURL(objectURLs[fileId]);

            // Supprimez l'élément du DOM
            const getFileNameContainer = document.getElementById(fileId);
            newFileListDiv.removeChild(getFileNameContainer);

            // Mettez à jour la valeur de l'input caché "filesToBeUploaded"
            newFilesToBeUploaded.value = JSON.stringify(getnewFilesToBeUploaded);

        }

        // Fonction pour sauvegarder les données du formulaire en tant que brouillon
        function saveAsDraft() {

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Capturer les valeurs des champs de formulaire
            const to = document.querySelector('input[name="to"]').value;
            const subject = document.querySelector('input[name="subject"]').value;
            const message = document.querySelector('textarea[name="mail_message"]').value;

            // Créer un objet pour stocker les données du brouillon
            const draftData = {
                to: to,
                subject: subject,
                message: message
                // Ajoutez d'autres champs si nécessaire
            };

            console.log(draftData);

            // Stocker les données du brouillon localement, par exemple dans le stockage local
            localStorage.setItem('draftEmail', JSON.stringify(draftData));

            // Vous pouvez également afficher un message ou effectuer d'autres actions ici
            alert('Brouillon sauvegardé avec succès !');

            fetch('{{ route('admin.projectBoard.email.createDraftMail', $project) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken // Assurez-vous d'ajouter le jeton CSRF
                    },
                    body: JSON.stringify(draftData)
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    console.error('Erreur lors de l\'enregistrement du brouillon :', error);
                });
        }
    </script>
@endsection
