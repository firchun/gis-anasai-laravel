<div class="row justify-content-center ">
    <div class="col-lg-8 mt-3">
        <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="search" class="form-control" placeholder="Search....." aria-label="Nama File"
                    aria-describedby="button-addon2" name="keywords"
                    value="{{ old('keywords', Request::get('keywords')) }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                </div>
            </div>
        </form>
        <div class="my-3">
            <div class="text-center">
                <div class="text-center">

                    @if (old('keywords', Request::get('keywords')) !== null ||
                            (old('keywords', Request::get('keywords')) == '' && $data != null))
                        <h3 class="text-muted">
                            Search results : <em>{{ old('keywords', Request::get('keywords')) }}</em>
                        </h3>

                        <small class="text-muted">
                            <strong>{{ $result }}</strong> Results
                        </small>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
