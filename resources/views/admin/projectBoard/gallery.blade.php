@extends('admin.layouts.project.master')

@section('style')
    <link rel="stylesheet" href="{{ asset('styles/admin/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content pt-4">
    <div class="container-fluid">
       <div class="row">
          <div class="col-12 pb-5">
              <h6 class="name-project">Gozem</h6><span class="page-name">/ Gallerie</span>
              <a href="#" class="add-link"><i class="bi bi-plus-circle-dotted"></i> Ajouter une image</a>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-outline count-card">
              <div class="card-header bg-secondary">
                <h3 class="card-title count-header-title">Gallerie photo du projet : <span class="your-project-name">Gozem</span></h3>
              </div>
              <div class="card-body bg-secondary">
                <div class="row">
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem1.jpg') }}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem1.jpg') }}" class="img-fluid gallery-img" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem2.jpg') }}" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem2.jpg') }}" class="img-fluid gallery-img" alt="black sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem3.jpg') }}" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem3.jpg') }}" class="img-fluid gallery-img" alt="red sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem4.jpg') }}" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem4.jpg') }}" class="img-fluid gallery-img" alt="red sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem5.jpg') }}" data-toggle="lightbox" data-title="sample 5 - black" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem5.jpg') }}" class="img-fluid gallery-img" alt="black sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem6.jpg') }}" data-toggle="lightbox" data-title="sample 6 - white" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem6.jpg') }}" class="img-fluid gallery-img" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem6.jpg') }}" data-toggle="lightbox" data-title="sample 7 - white" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem6.jpg') }}" class="img-fluid gallery-img" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem5.jpg') }}" data-toggle="lightbox" data-title="sample 8 - black" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem5.jpg') }}" class="img-fluid gallery-img" alt="black sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem1.jpg') }}" data-toggle="lightbox" data-title="sample 9 - red" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem1.jpg') }}" class="img-fluid gallery-img" alt="red sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem3.jpg') }}" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem3.jpg') }}" class="img-fluid gallery-img" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem1.jpg') }}" data-toggle="lightbox" data-title="sample 11 - white" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem1.jpg') }}" class="img-fluid gallery-img" alt="white sample"/>
                    </a>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{ asset('assets/images/gozem2.jpg') }}" data-toggle="lightbox" data-title="sample 12 - black" data-gallery="gallery">
                      <img src="{{ asset('assets/images/gozem2.jpg') }}" class="img-fluid gallery-img" alt="black sample"/>
                    </a>
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
  <script src="{{ asset('styles/admin/plugins/ekko-lightbox/ekko-lightbox.js') }}"></script>
  <script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });

      $('.filter-container').filterizr({gutterPixels: 3});
      $('.btn[data-filter]').on('click', function() {
        $('.btn[data-filter]').removeClass('active');
        $(this).addClass('active');
      });
    })
  </script>
@endsection