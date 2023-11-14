@section('style')
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

<style>
    .textarea-block {
        color : #000000;
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

    .file-name-container {
        display: flex;
        align-items: center;
        margin: 5px;
        padding: 12px;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .file-name {
        margin-right: 10px;
    }

    .file-close {
        cursor: pointer;
    }
</style>

<form action="{{ route('admin.clientSpace.email.create', $project) }}" method="post" enctype="multipart/form-data" id="createForm">
    @csrf
    <div class="form-group">
        <input class="form-control" name="to" disabled value="{{ $project->user->email }}" placeholder="À">
    </div>
    <div class="form-group">
        <input class="form-control" name="subject" id="subject" placeholder="Sujet">
    </div>
    <div class="form-group textarea-block">
        <textarea id="compose-textarea" name="mail_message" class="form-control textarea"></textarea>
    </div>
    <textarea name="descriptionText" id="descriptionText" class="d-none"></textarea>
    <div class="form-group">

            <div id="fileList"></div>

            <ul id="customFileList"></ul>

    </div>
    <input type="hidden" name="filesToBeUploaded[]" value="[]" id="filesToBeUploaded">


    <div class="form-group">
        <div class="btn btn-light btn-file">
            <i class="fas fa-paperclip"></i> Joindre
            <input type="file" name="files[]" multiple id="fileSelector">
        </div>
        <button type="button" id="saveDraft" href="{{-- route('admin.projectBoard.email.createDraftMail') --}}" onclick="saveAsDraft()" class="btn btn-light"><i class="fas fa-pencil-alt"></i> Brouillon</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-envelope"></i> Envoyer</button>
        {{-- <p class="help-block">Max. 32MB</p> --}}
    </div>
</form>

<script>

    function autoActualiserPage(interval) {
        setInterval(function() {
            location.reload();
        }, interval);
    }

    const clientFileInput = document.getElementById('fileSelector');
    const fileListDiv = document.getElementById('fileList');
    const filesToBeUploaded = document.getElementById('filesToBeUploaded');
    let objectURLs = []; // Stocker les URLs des objets créés

    const selectedFiles = [];

    clientFileInput.addEventListener('change', function(event) {

        fileListDiv.innerHTML = '';

        objectURLs.forEach(url => URL.revokeObjectURL(url));
        objectURLs = [];

        const files = event.target.files;

        let compteur = 0;

        for (const file of files) {

            selectedFiles.push(file)

            // console.log('fileSelector');

            // console.log('identifiant:', file.id);

            // console.log('Nom du fichier:', file.name);
            // console.log('Type de fichier:', file.type);
            // console.log('Taille du fichier:', file.size, 'octets');
            // console.log('Date de dernière modification:', file.lastModifiedDate);


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

            // const fileClose = document.createElement('span');
            // fileClose.classList.add('file-close');
            // fileClose.setAttribute("aria-live", fileId)
            // fileClose.textContent = '×';
            // fileClose.addEventListener('click', function() {
                //     const containerId = fileId; // Utiliser l'ID du conteneur
            //     const objectURL = objectURLs[containerId];
            //     if (objectURL) {
                //         URL.revokeObjectURL(objectURL);
            //         delete objectURLs[containerId];
            //         destroy(containerId); // Appeler la fonction destroy
            //     }
            // });

            fileNameContainer.innerHTML = fileClose;

            fileNameContainer.appendChild(fileName);
            // fileNameContainer.appendChild(fileClose);
            fileListDiv.appendChild(fileNameContainer);

            compteur++;

        }

        console.log(selectedFiles);

        const objectExtract = selectedFiles.map(file => file.name);

        // filesToBeUploaded.value = JSON.stringify(selectedFiles);

        filesToBeUploaded.value = JSON.stringify(objectExtract);

        // autoActualiserPage(5000);


        // console.log(filesToBeUploaded);

        console.log(filesToBeUploaded.value);

    });

    console.log(selectedFiles);

    function destroyFile(compteur, fileId) {

        // Obtenez la liste des fichiers sélectionnés sous forme de tableau
        let getFilesToBeUploaded = JSON.parse(filesToBeUploaded.value);
        console.log(getFilesToBeUploaded);
        // Supprimez le fichier du tableau
        getFilesToBeUploaded.splice(compteur, 1);

        // Révoquez l'URL d'objet du fichier
        URL.revokeObjectURL(objectURLs[fileId]);

        // Supprimez l'élément du DOM
        const getFileNameContainer = document.getElementById(fileId);
        fileListDiv.removeChild(getFileNameContainer);

        // Mettez à jour la valeur de l'input caché "filesToBeUploaded"
        filesToBeUploaded.value = JSON.stringify(getFilesToBeUploaded);

        // autoActualiserPage(1000);

        console.log(filesToBeUploaded.value);

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

        fetch('{{ route("admin.projectBoard.email.createDraftMail", $project) }}', {
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
