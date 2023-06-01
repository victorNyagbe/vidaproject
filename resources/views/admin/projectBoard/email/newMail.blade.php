<style>
    .textarea-block {
        color : #000000;
    }
</style>

<form action="{{ route('admin.projectBoard.email.create', $project) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input class="form-control" disabled value="{{ $client->user_mail }}" placeholder="À">
    </div>
    <div class="form-group">
        <input class="form-control" name="subject" id="subject" placeholder="Sujet">
    </div>
    <div class="form-group textarea-block">
        <textarea id="compose-textarea" name="mail_message" class="form-control textarea" plac>
            <p>
                Saisir votre texte
            </p>
            <div class="justify-content-end d-flex">
                <p class="d-block pr-4" >{{ session()->get('fullname') }}</p>
            </div>
        </textarea>
    </div>
    <div class="form-group">
        <div class="btn btn-light btn-file">
            <i class="fas fa-paperclip"></i> Joindre
            <input type="file" name="file">
        </div>
        <button type="button" class="btn btn-light"><i class="fas fa-pencil-alt"></i> Brouillon</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-envelope"></i> Envoyer</button>
        <p class="help-block">Max. 32MB</p>
    </div>
</form>
