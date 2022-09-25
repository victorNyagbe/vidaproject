@extends('admin.layouts.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/message/chat.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
       <div class="row">
        <div class="col-12">
            <div class="accordion" id="accordionOne">
                <div class="card bg-gradient-secondary">
                    <div class="card-header" id="headingOne">
                        <div class="card-title image">
                            <a href="#">
                                <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="img-circle img-profil-circle elevation-2" alt="User Image">
                            </a>
                        </div>
                        <div class="card-tools mt-2">
                            <a href="#" class="btn btn-tool">
                                <i class="bi bi-chat-left-text-fill"></i>
                            </a>
                            <i class="fas fa-plus signe" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"></i>
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionOne">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card bg-gradient-light">
                                        <div class="card-header">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="card-body bg-list-collab">
                                            <div class="list-collab">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user7-128x128.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Christelle</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user1-128x128.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Gomez</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                            <span class="badge badge-success right">1</span>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user8-128x128.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Vic</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                            <span class="badge badge-success right">1</span>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user3-128x128.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Isabelle</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                            <span class="badge badge-success right">2</span>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Chris</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Chris</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Chris</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="image">
                                                            <a href="#">
                                                                <img src=" {{ asset('styles/admin/dist/img/user2-160x160.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="list-user-name">Chris</div>
                                                        <div class="list-user-message">j'ai débuté avec le... 
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card bg-gradient-light">
                                        <div class="card-header" id="headingOne">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="card-title image">
                                                                <a href="#">
                                                                    <img src=" {{ asset('styles/admin/dist/img/user7-128x128.jpg') }} " class="img-circle img-profil-circle2 elevation-2" alt="User Image">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <div class="chat-user-name">Christelle</div>
                                                            <div class="online-status">En ligne</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="card-tools card-tools-position mt-2">
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="bi bi-chat-left-text-fill"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-tool">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body chat-bg">
                                        <!-- chat box -->
                                            <div class="chatBox">
                                                <div class="message my_message">
                                                    <p>HI<br><span>12:05</span></p>
                                                </div>
                                                <div class="message collab_message">
                                                    <p>Hello<br><span>12:05</span></p>
                                                </div>
                                                <div class="message my_message">
                                                    <p>HI<br><span>12:05</span></p>
                                                </div>
                                                <div class="message collab_message">
                                                    <p>Hello I'm going in the store<br><span>12:05</span></p>
                                                </div>
                                                <div class="message my_message">
                                                    <p>HI<br><span>12:05</span></p>
                                                </div>
                                                <div class="message collab_message">
                                                    <p>Hello<br><span>12:05</span></p>
                                                </div>
                                                <div class="message my_message">
                                                    <p>HI<br><span>12:05</span></p>
                                                </div>
                                                <div class="message collab_message">
                                                    <p>Hello<br><span>12:05</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- chat input -->
                                        <div class="chatbox_input">
                                            <i class="fas fa-smile"></i>
                                            <i class="fas fa-paperclip"></i>
                                            <input type="text" placeholder="Taper un message">
                                            <i class="fas fa-microphone"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>
    </div>
  </section>
</div>
@endsection

@section('script')

@endsection
