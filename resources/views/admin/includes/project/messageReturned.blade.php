@if ($errors->any())
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-md-8">
            <ul class="alert alert-danger alert-dismissible list-unstyled" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" aria-label="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </ul>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-md-8">
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="close" aria-label="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('success'))
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-md-8">
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="close" aria-label="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
