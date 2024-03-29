@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/.css') }}">
    <style>
        /* #droppable: {height: 10vh;}
        #droppable:hover { height: 20vh; } */
        .deplacer: { height: 20vh; }
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
        video, audio {
            max-width: 100%;
            border: 1px solid #ccc;
            margin: 10px;
        }
  </style>
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
        @include('admin.includes.messageReturned')
        <div class="row">
            <div class="col-12 pb-5">
                <a href="{{ route('admin.projectBoard.email.mail', $project) }}" class="btn btn-success btn-Clicked"><i class="bi bi-arrow-left"></i> Retour</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <section class="content pb-3">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                @if ($mail->receiver_id == session()->get('id'))
                                    <p>À <span class="text-info">moi</span></p>
                                @else
                                    <p>Envoyé à <span class="text-info">{{ $client->user_mail }}</span></p>
                                @endif

                                <?php \Carbon\Carbon::setLocale('fr_FR'); ?>
                                <p>{{ \Carbon\Carbon::parse($mail->dateTime)->isoFormat('D MMMM YYYY') }}</p>
                            </div>
                            <div class="card-body">
                                <h5>{{ $mail->subject }}</h5>
                                <p class="text-justify">{!! $mail->message !!}</p>

                                @foreach ($files as $file)

                                    <div class="row">

                                        @if ($file->type_file === 'image')

                                            {{-- <img src="{{ asset('storage/app/public/' . $file->file) }}" alt="{{ $file->file }} width=2"> --}}

                                            <div class="col-3">

                                                <a href="{{ asset('storage/app/public/' . $file->file) }}" download="{{ $file->file }}">
                                                    <img src="{{ asset('storage/app/public/' . $file->file) }}" alt="{{ $file->file }}">

                                                </a>

                                            </div>

                                        @elseif ($file->type_file === 'document')

                                            <div class="col-3">

                                                <a href="{{ asset('storage/app/public/' . $file->file) }}" class="file-link" download="{{ $file->file }}">{{ \Illuminate\Support\Str::substr($file->file, 14, 60) }}</a>

                                            </div>

                                        @elseif ($file->type_file === 'video')

                                        <div class="col-3">

                                                <video controls>
                                                    <source src="{{ asset('storage/app/public/' . $file->file) }}" type="video/mp4">
                                                    Votre navigateur ne supporte pas la lecture vidéo.
                                                </video>

                                                <a href="{{ asset('storage/app/public/' . $file->file) }}" download="{{ $file->file }}">Télécharger la vidéo</a>

                                        </div>

                                        @elseif ($file->type_file === 'audio')

                                            <div class="col-3">

                                                <audio controls>
                                                    <source src="{{ asset('storage/app/public/' . $file->file) }}" type="audio/mpeg">
                                                    Votre navigateur ne supporte pas la lecture audio.
                                                </audio>

                                                <a href="{{ asset('storage/app/public/' . $file->file) }}" download="{{ $file->file }}">Télécharger l'audio</a>

                                            </div>

                                        @endif

                                    </div>

                                @endforeach
                                <p class="d-flex justify-content-end">{{ \Carbon\Carbon::parse($mail->dateTime)->isoFormat('HH:mm:ss') }}</p>
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
        $(function () {
            $.activeButtonClicked = function(el){
                if (!el.hasClass('actived')) {
                    $('.mailbox-item .nav-link').removeClass('actived')
                    el.addClass('actived');
                }
            }
        })
    </script>
@endsection
