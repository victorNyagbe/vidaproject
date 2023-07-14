<div class="row select-all-block">
    <div class="col-12">
        <div class="icheck-danger first-checkbox">
            <input
                type="checkbox"
                value=""
                id="sent-check0"
            />
            <label for="sent-check0">Tout</label>
        </div>
        <a href="#" id="hide-trash-btn" class="btn btn-danger trash-btn">Supprimer</a>
    </div>
</div>

<div class="table-responsive bg-light mailbox-messages">
    <table class="table table-hover">
        <tbody>
            @foreach ($mails as $mail)
                <tr>
                    <td>
                        <div class="icheck-danger">
                            <input
                                type="checkbox"
                                value=""
                                id="sent-check{{ $mail->id }}"
                                class="sent-delete-check"
                            />
                            <label for="sent-check{{ $mail->id }}"></label>
                        </div>
                    </td>
                    <td class="mailbox-name">
                        @php
                            $value = App\Models\ProjectUser::where('id', $mail->receiver_id)->value('user_mail');
                            $name = explode('@',$value);
                            $first_name = $name[0];
                        @endphp
                        <span>À :</span> <a href="#">{{ $first_name }}</a>
                    </td>
                    <td class="mailbox-subject">
                        {{-- <b>{{ $mail->subject }}</b> - Trying to find a ... --}}
                        {{-- $textToBeReturned --}}
                    </td>
                    <td class="mailbox-attachment delete-icons">
                        <a href="#">
                            <i class="fas fa-trash-alt text-dark"></i>
                        </a>
                    </td>
                    <td class="mailbox-date inbox-date">{{ \Carbon\Carbon::parse($mail->dateTime)->format('h:i:s A') }}</td>
                </tr>
            @endforeach
            {{-- <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check2"
                            class="sent-delete-check"
                        />
                        <label for="sent-check2"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">06 : 00</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check3"
                            class="sent-delete-check"
                        />
                        <label for="sent-check3"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">05 : 00</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check4"
                            class="sent-delete-check"
                        />
                        <label for="sent-check4"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">04 : 00</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check5"
                            class="sent-delete-check"
                        />
                        <label for="sent-check5"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">01 : 00</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check6"
                            class="sent-delete-check"
                        />
                        <label for="sent-check6"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">20 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check7"
                            class="sent-delete-check"
                        />
                        <label for="sent-check7"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">19 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check8"
                            class="sent-delete-check"
                        />
                        <label for="sent-check8"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">18 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="sent-check9"

                        class="sent-delete-check"                            />
                        <label for="sent-check9"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">11 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="0"
                            class="sent-delete-check"
                        />
                        <label for="0"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">10 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="1"
                            class="sent-delete-check"
                        />
                        <label for="1"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">8 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="2"
                            class="sent-delete-check"
                        />
                        <label for="2"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">8 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="3"
                            class="sent-delete-check"
                        />
                        <label for="3"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">7 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="4"
                            class="sent-delete-check"
                        />
                        <label for="4"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">5 sept</td>
            </tr>
            <tr>
                <td>
                    <div class="icheck-danger">
                        <input
                            type="checkbox"
                            value=""
                            id="5"
                            class="sent-delete-check"
                        />
                        <label for="5"></label>
                    </div>
                </td>
                <td class="mailbox-name">
                    <a href="read-mail.html">Alexander Pierce</a>
                </td>
                <td class="mailbox-subject">
                    <b>AdminLTE 3.0 Issue</b> - Trying to find a ...
                </td>
                <td class="mailbox-attachment delete-icons">
                    <a href="#">
                        <i class="fas fa-trash-alt text-dark"></i>
                    </a>
                </td>
                <td class="mailbox-date inbox-date">1 sept</td>
            </tr> --}}
        </tbody>
    </table>
    <!-- /.table -->
</div>
<!-- /.card -->
