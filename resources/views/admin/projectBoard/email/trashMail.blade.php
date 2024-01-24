{{-- <div class="row select-all-block">
    <div class="col-12">
        <div class="icheck-danger first-checkbox">
            <input
                type="checkbox"
                value=""
                id="check0"
            />
            <label for="check0">Tout</label>
        </div>
        <a href="#" id="hide-trash-btn" class="btn btn-danger trash-btn">Supprimer</a>
        <a href="#" id="hide-restore-btn" class="btn btn-primary trash-btn trash-restore-btn">Restaurer</a>
    </div>
</div> --}}
<div class="table-responsive bg-light mailbox-messages">
    <table class="table table-hover">
        <tbody>
            @foreach ($mails as $mail)
                <tr>
                    {{-- <td>
                        <div class="icheck-danger">
                            <input
                                type="checkbox"
                                value=""
                                id="sent-check{{ $mail->id }}"
                                class="sent-delete-check"
                            />
                            <label for="sent-check{{ $mail->id }}"></label>
                        </div>
                    </td> --}}
                    <td class="mailbox-name">
                        @php
                            $value = App\Models\ProjectUser::where('id', $mail->receiver_id)->value('user_mail');
                            $name = explode('@', $value);
                            $first_name = $name[0];

                            $value2 = App\Models\User::where('id', $mail->sender_id)->value('email');
                            $name2 = explode('@', $value2);
                            $first_name2 = $name2[0];
                        @endphp
                        @if ($first_name)
                            <span>À :</span> <span class="text-primary">{{ $first_name }}</span>
                        @elseif ($first_name2)
                            <span class="text-primary">{{ $first_name2 }}</span>
                        @endif
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
                                href="{{ route('admin.projectBoard.email.show', [$mail, $project]) }}">
                                <b>{{ $mail->subject }}</b> ...
                            </a>
                        @elseif ($getTitre > 30)
                            <a class="mailbox-title"
                                href="{{ route('admin.projectBoard.email.show', [$mail, $project]) }}">
                                <b>{{ \Illuminate\Support\Str::substr($mail->subject, 0, 30) . '...' }}</b>
                            </a>
                        @elseif($getTitre == 0)
                            <a class="mailbox-title"
                                href="{{ route('admin.projectBoard.email.show', [$mail, $project]) }}">
                                <span>{{ $mail->subtitle }}...</span>
                            </a>
                        @else
                            <a class="mailbox-title"
                                href="{{ route('admin.projectBoard.email.show', [$mail, $project]) }}">
                                <b>{{ $mail->subject }}</b> -
                                {{ \Illuminate\Support\Str::substr($mail->subtitle, 0, $charactersLeft) . '...' }}
                            </a>
                        @endif
                    </td>
                    <td class="mailbox-attachment delete-icons">
                        <a href="{{ route('admin.projectBoard.email.destroy', [$mail, $project]) }}"
                            onclick="return confirm('Êtes-vous certain(e) de vouloir supprimer ce mail ? Cette action est définitive et toutes les données associées seront perdues.');">
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
