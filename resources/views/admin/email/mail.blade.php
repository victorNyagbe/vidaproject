@extends('admin.layouts.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('styles/admin/email/mail.css') }}">
@endsection

@section('content') 
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
       <div class="row">
        <div class="col-12">
            <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-md-3">

                <div class="card">
                  <div class="card-header bg-dark">
                    <h3 class="card-title">Menu</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool text-light" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body bg-secondary p-0">
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item bg-secondary mailbox-item">
                        <a href="#" class="nav-link inbox actived">
                          <i class="fas fa-inbox"></i> Boite de reception
                          <span class="badge bg-primary float-right">12</span>
                        </a>
                      </li>
                      <li class="nav-item bg-secondary mailbox-item">
                        <a href="#" class="nav-link toSend">
                          <i class="fas fa-paper-plane"></i> Nouveau message
                        </a>
                      </li>
                      <li class="nav-item bg-secondary mailbox-item">
                        <a href="#" class="nav-link sent">
                          <i class="far fa-envelope"></i> Messages envoyés
                        </a>
                      </li>
                      <li class="nav-item bg-secondary mailbox-item">
                        <a href="#" class="nav-link draft">
                          <i class="far fa-file-alt"></i> Brouillons
                          <span class="badge bg-warning float-right">5</span>
                        </a>
                      </li>
                      <li class="nav-item bg-secondary mailbox-item">
                        <a href="#" class="nav-link trash">
                          <i class="far fa-trash-alt"></i> Corbeille
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
              
              <div class="col-md-9">
                <div class="card card-dark card-outline">
                    <div class="card-header bg-dark">
                        <h3 class="card-title" id="cardMail"></h3>

                        <div id="search" class="card-tools">
                            <div class="input-group input-group-sm">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Search Mail"
                                />
                                <div class="input-group-append">
                                    <div class="btn btn-success">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body bg-secondary mail-body p-0">
                        <div class="mail-content">
                            
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </section>
          <!-- /.content -->
        </div>
       </div>
    </div>
  </section>
</div>
@endsection

@section('script')

<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })

    // Load by default the inbox view
    $.ajax({
      type : "GET",
      url : "{{ route('admin.email.inboxMail') }}",
      success : function(status){
        $('#cardMail').text('Boîte de reception')
        $('.mail-content').html(status);
        $.activeButtonClicked($('.inbox'));

      }
    });
    
    // inbox view
    $('.inbox').click(function(e){
      e.preventDefault()
      $.ajax({
        type : "GET",
        url : "{{ route('admin.email.inboxMail') }}",
        success : function(status){
          $('#cardMail').text('Boîte de reception')

          $('.mail-content').html(status);

          $.activeButtonClicked($('.inbox'));

          $('#inbox-check0').change(function () {
            $('.inbox-delete-check').prop('checked', $(this).prop('checked'));
            if (!$(this).prop('checked')) {
              $('.trash-btn').css('display', 'none')
            } else {
              $('.trash-btn').css('display', 'block')
            } 
          });

          var checkboxes = document.querySelectorAll('.inbox-delete-check');
          
          if (checkboxes.length > 0) {

            let compteurCheckboxChecked = 0

            checkboxes.forEach((checkbox) => {
              if (checkbox.checked) {
                compteurCheckboxChecked = compteurCheckboxChecked + 1
              }
            })
            
            if (compteurCheckboxChecked > 0) {
              $('.trash-btn').css('display', 'block')
            }

            checkboxes.forEach((checkbox) => {
              checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                  $('.trash-btn').css('display', 'block')
                } else {
                  checkboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                      compteurCheckboxChecked = compteurCheckboxChecked + 1
                    }
                  })

                  if (compteurCheckboxChecked > 0) {
                    $('.trash-btn').css('display', 'block')
                  } else {
                    $('.trash-btn').css('display', 'none')
                  }

                  compteurCheckboxChecked = 0
                }
              })
            })
          }

        }
      });
    });

    $('.toSend').click(function(e){
      e.preventDefault()
      $.ajax({
        type : "GET",
        url : "{{ route('admin.email.newMail') }}",
        success : function(status){
          $('#cardMail').text('Envoyer un message')
          $('.mail-content').html(status);
          $('#search').css('display', 'none');
          $.activeButtonClicked($('.toSend'));
          $('#compose-textarea').summernote()
        }
      });
    });

    $('.sent').click(function(e){
      e.preventDefault()
      $.ajax({
        type : "GET",
        url : "{{ route('admin.email.sentMail') }}",
        success : function(status){
          $('#cardMail').text('Messages envoyé')
          $('.mail-content').html(status);
          $.activeButtonClicked($('.sent'));
        }
      });
    });

    $('.draft').click(function(e){
      e.preventDefault()
      $.ajax({
        type : "GET",
        url : "{{ route('admin.email.draftMail') }}",
        success : function(status){
          $('#cardMail').text('Brouillons')
          $('.mail-content').html(status);
          $.activeButtonClicked($('.draft'));
        }
      });
    });

    $('.trash').click(function(e){
      e.preventDefault()
      $.ajax({
        type : "GET",
        url : "{{ route('admin.email.trashMail') }}",
        success : function(status){
          $('#cardMail').text('Corbeille')
          $('.mail-content').html(status);
          $('#search').css('display', 'none');
          $.activeButtonClicked($('.trash'));
          $('#check0').change(function () {
            $('.delete-check').prop('checked', $(this).prop('checked'));
            if (!$(this).prop('checked')) {
              $('.trash-btn').css('display', 'none')
            } else {
              $('.trash-btn').css('display', 'block')
            } 
          });


          var checkboxes = document.querySelectorAll('.delete-check');
          
          if (checkboxes.length > 0) {

            let compteurCheckboxChecked = 0

            checkboxes.forEach((checkbox) => {
              if (checkbox.checked) {
                compteurCheckboxChecked = compteurCheckboxChecked + 1
              }
            })
            
            if (compteurCheckboxChecked > 0) {
              $('.trash-btn').css('display', 'block')
            }

            checkboxes.forEach((checkbox) => {
              checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                  $('.trash-btn').css('display', 'block')
                } else {
                  checkboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                      compteurCheckboxChecked = compteurCheckboxChecked + 1
                    }
                  })

                  if (compteurCheckboxChecked > 0) {
                    $('.trash-btn').css('display', 'block')
                  } else {
                    $('.trash-btn').css('display', 'none')
                  }

                  compteurCheckboxChecked = 0
                }
              })
            })
          }

        }
      });
    });

    $.activeButtonClicked = function(el){
      if (!el.hasClass('actived')) {
        $('.mailbox-item .nav-link').removeClass('actived')
        el.addClass('actived');
      }
    }

  })

  function checkedAll(el, el2, el3) {
    var checkboxes = document.querySelectorAll('el2');
    el.addEventListener('change', function() {
      
      checkboxes.forEach((checkbox) => {
          .checkboxes.checked == true
          if (el.checked) {
            el3.classList.add("appear")
          }
      })

    }) 
  }
</script>

@endsection
