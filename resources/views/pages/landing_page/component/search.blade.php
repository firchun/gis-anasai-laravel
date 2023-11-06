<div class="container my-3 text-center "
    style="background-image: url('{{ asset('frontend/img/header4.jpg') }}'); background-size: cover;  border-radius:20px; padding-top:50px; padding-bottom:50px;">
    <div class="offset-lg-3 col-lg-9 col-sm-12 subscribe-form">
        <div class="container subscribe-form-content">
            <h4 class="text-left text-white">Anda dapat mencari tempat wisata dan event di sini.</h4>
            <form action="{{ route('search') }}" method="GET">
                <div class="row">
                    <div class="col-lg-9 col-sm-12 form-element">
                        <input placeholder="Cari di sini.." type="search" class="form-control" name="keywords"
                            autocomplete="off" value="{{ old('keywoards', $keywords ?? '') }}">
                    </div>
                    <div class="col-lg-3 col-sm-12 form-element">
                        <button class="btn btn-block btn-primary py-2" type="submit">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
