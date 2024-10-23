@foreach(['info','success','warning','danger'] as $type)
    @if(Session::has($type))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-{{ $type }} alert-dismissible fade show" style="border: none">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa fa-times fa-sm"></i></button>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="fa fa-times"></i></button> --}}
                    <span class="text-xs font-weight-bolder">{!! Session::get($type) !!}</span>
                </div>
            </div>
        </div>
        {{ Session::forget($type) }}
    @endif
@endforeach
