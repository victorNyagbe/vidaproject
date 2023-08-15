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

    </div>
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

    const fileInput = document.getElementById('fileSelector');
    const fileListDiv = document.getElementById('fileList');

    fileInput.addEventListener('change', function(event) {

        fileListDiv.innerHTML = '';

        const files = event.target.files;

        // for (const file of files) {

        //     const fileNameContainer = document.createElement('div');
        //     fileNameContainer.classList.add('file-name-container');

        //     const fileName = document.createElement('p');
        //     fileName.textContent = file.name;

        //     // fileListDiv.appendChild(fileName);

        //     fileNameContainer.appendChild(fileName);
        //     fileListDiv.appendChild(fileNameContainer);
        // }

        for (const file of files) {

            const fileNameContainer = document.createElement('div');
            fileNameContainer.classList.add('file-name-container');

            const fileName = document.createElement('p');
            fileName.classList.add('file-name');
            fileName.textContent = file.name;

            const fileClose = document.createElement('span');
            fileClose.classList.add('file-close');
            fileClose.textContent = '×';
            fileClose.addEventListener('click', function() {
                fileNameContainer.remove();
            });

            fileNameContainer.appendChild(fileName);
            fileNameContainer.appendChild(fileClose);
            fileListDiv.appendChild(fileNameContainer);
        }

    });

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
