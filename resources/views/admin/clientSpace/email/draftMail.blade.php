{{-- <div class="row select-all-block">
    <div class="col-12">
        <div class="icheck-danger first-checkbox">
            <input type="checkbox" value="" id="draft-check0" />
            <label for="draft-check0">Tout</label>
        </div>
        <a href="#" id="hide-trash-btn" class="btn btn-danger trash-btn">Supprimer</a>
    </div>
</div> --}}

<div class="table-responsive bg-light mailbox-messages">
    <table class="table table-hover">
        <tbody>
            @foreach ($mails as $mail)
                <tr>
                    {{-- <td>
                        <div class="icheck-danger">
                            <input type="checkbox" value="" id="sent-check{{ $mail->id }}"
                                class="sent-delete-check" />
                            <label for="sent-check{{ $mail->id }}"></label>
                        </div>
                    </td> --}}
                    <td class="mailbox-name">
                        @php
                            $value = $project->user->email;
                            $name = explode('@', $value);
                            $first_name = $name[0];
                        @endphp
                        <span>À :</span> <a href="#">{{ $first_name }}</a>
                    </td>
                    <td class="mailbox-subject">
                        <?php
                        $characters = 30;
                        $titre = $mail->subject;
                        $getTitre = strlen($titre);
                        $charactersLeft = $characters - $getTitre;
                        $description = $mail->message;
                        ?>
                        @if ($getTitre == 30)
                            <a class="mailbox-title"
                                href="{{ route('admin.clientSpace.email.show-draft', [$mail, $project]) }}">
                                <b>{{ $mail->subject }}</b> ...
                            </a>
                        @elseif ($getTitre > 30)
                            <a class="mailbox-title"
                                href="{{ route('admin.clientSpace.email.show-draft', [$mail, $project]) }}">
                                <b>{{ \Illuminate\Support\Str::substr($mail->subject, 0, 30) . '...' }}</b>
                            </a>
                        @elseif($getTitre == 0)
                            <a class="mailbox-title"
                                href="{{ route('admin.clientSpace.email.show-draft', [$mail, $project]) }}">
                                <span>{{ $mail->subtitle }}...</span>
                            </a>
                        @else
                            <a class="mailbox-title"
                                href="{{ route('admin.clientSpace.email.show-draft', [$mail, $project]) }}">
                                <b>{{ $mail->subject }}</b> -
                                {{ \Illuminate\Support\Str::substr($mail->subtitle, 0, $charactersLeft) . '...' }}
                            </a>
                        @endif
                    </td>
                    <td class="mailbox-attachment delete-icons">
                        <a href="{{ route('admin.clientSpace.email.sendToTrash', [$mail, $project]) }}"
                            onclick="return confirm('Êtes-vous certain de vouloir supprimer ce mail ? Cette action est irréversible.');">
                            <i class="fas fa-trash-alt text-dark"></i>
                        </a>
                    </td>
                    <td class="mailbox-date inbox-date">
                        {{ \Carbon\Carbon::parse($mail->dateTime)->isoFormat('HH : mm') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- /.table -->
</div>
<!-- /.card -->
