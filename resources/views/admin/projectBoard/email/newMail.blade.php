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

<form action="{{ route('admin.projectBoard.email.create', $project) }}" method="post" enctype="multipart/form-data" id="createForm">
    @csrf
    <div class="form-group">
        <input class="form-control" disabled value="{{ $client->user_mail }}" placeholder="À">
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

    {{-- <input type="hidden" name="filesToBeUploaded[]" value="" id="filesToBeUploaded"> --}}


    <div class="form-group">
        <div class="btn btn-light btn-file">
            <i class="fas fa-paperclip"></i> Joindre
            <input type="file" name="files[]" multiple id="fileSelector">
        </div>
        <button type="button" class="btn btn-light"><i class="fas fa-pencil-alt"></i> Brouillon</button>
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

    const fileInput = document.getElementById('fileSelector');
    const fileListDiv = document.getElementById('fileList');
    const filesToBeUploaded = document.getElementById('filesToBeUploaded');
    let objectURLs = []; // Stocker les URLs des objets créés

    const selectedFiles = [];

    fileInput.addEventListener('change', function(event) {

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

    // function destroyFile(compteur, value) {
    //     let getFilesToBeUplodaed = filesToBeUploaded.getAttribute("value");
    //     // console.log(getFilesToBeUplodaed);
    //     getFilesToBeUplodaed = getFilesToBeUplodaed.split(",")
    //     console.log(getFilesToBeUplodaed);
    //     getFilesToBeUplodaed.splice(compteur, 1)
    //     const getFileNameContainer = document.getElementById(value);
    //     fileListDiv.removeChild(getFileNameContainer)

    //     // console.log(getFileNameContainer);
    //     // console.log(getFilesToBeUplodaed);

    //     const objet = {
    //         nom: "John Doe",
    //         age: 30,
    //         ville: "Dakar"
    //     };

    //     const chaineJSON = JSON.stringify(objet);

    //     console.log(chaineJSON);


    // }

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

        // Envoyer les données au contrôleur
        // fetch('/app/Http/Controllers/Admin/MailController.php', {
        //     method: 'POST',
        //     headers: {

        //     }
        // })
    }



</script>

{{-- <script>
    $(document).ready(function() {
        const fileInput = document.getElementById("fileSelector");
        const fileListDiv = document.getElementById('fileList');

        $('#fileInput').change(function() {
            const fileListDiv = $('#fileList');
            fileListDiv.empty();
            console.log("heloo");
            const files = this.files;
            for (const file of files) {
                const fileName = $('<p>').text(file.name);
                fileListDiv.append(fileName);
            }
        });

    });
</script> --}}

{{-- <script>
    const fileInput = document.getElementById('fileSelector');
    const fileListDiv = document.getElementById('fileList');
    const customFileList = document.getElementById('customFileList');
    let objectURLs = {}; // Stocker les URLs des objets créés avec des ID
    let selectedFiles = [];

    fileInput.addEventListener('change', function(event) {
        fileListDiv.innerHTML = '';
        customFileList.innerHTML = '';

        // Révoquer les anciennes URLs d'objet
        objectURLs.forEach(url => URL.revokeObjectURL(url));
        objectURLs = {};

        const files = event.target.files;
        selectedFiles = Array.from(files);

        for (const file of files) {
            console.log('Nom du fichier:', file.name);
            const objectURL = URL.createObjectURL(file);
            const fileId = 'file_' + Date.now();
            objectURLs[fileId] = objectURL;

            const fileNameContainer = document.createElement('div');
            fileNameContainer.classList.add('file-name-container');
            fileNameContainer.id = fileId;

            const fileName = document.createElement('p');
            fileName.classList.add('file-name');
            fileName.textContent = file.name;

            const fileClose = document.createElement('span');
            fileClose.classList.add('file-close');
            fileClose.textContent = '×';
            fileClose.addEventListener('click', function() {
                const containerId = fileId;
                const objectURL = objectURLs[containerId];
                if (objectURL) {
                    URL.revokeObjectURL(objectURL);
                    delete objectURLs[containerId];
                    destroy(containerId);
                    selectedFiles = selectedFiles.filter(f => f.name !== file.name);
                    listItem.remove(); // Supprimer de la liste personnalisée
                }
            });

            fileNameContainer.appendChild(fileName);
            fileNameContainer.appendChild(fileClose);
            fileListDiv.appendChild(fileNameContainer);

            const listItem = document.createElement('li');
            listItem.textContent = file.name;

            const removeButton = document.createElement('button');
            removeButton.textContent = 'Supprimer';
            removeButton.addEventListener('click', function() {
                selectedFiles = selectedFiles.filter(f => f.name !== file.name);
                listItem.remove();
                // Révoquer l'URL d'objet et supprimer le bloc comme précédemment
            });

            listItem.appendChild(removeButton);
            customFileList.appendChild(listItem);
        }
    });

    // ...
</script> --}}
