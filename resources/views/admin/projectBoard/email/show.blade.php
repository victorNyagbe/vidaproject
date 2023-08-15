@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/.css') }}">
    <style>
        /* #droppable: {height: 10vh;}
        #droppable:hover { height: 20vh; } */
        .deplacer: { height: 20vh; }
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
                                <p>Envoyé à <span class="text-info">{{ $client->user_mail }}</span></p>
                                <?php \Carbon\Carbon::setLocale('fr_FR'); ?>
                                <p>{{ \Carbon\Carbon::parse($mail->dateTime)->isoFormat('D MMMM YYYY') }}</p>
                            </div>
                            <div class="card-body">
                                <h5>{{ $mail->subject }}</h5>
                                <p class="text-justify">{!! $mail->message !!}</p>
                                {{-- @if($mail->file != null)
                                    <img src="" alt="">
                                @endif --}}
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
