@extends('layouts.homeTemplate')

@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area">
    <div class="banner_inner">
        <div class="container">
            <div class="row">
                    <div style="margin: 10% auto 10% auto; text-align: center;" class="banner_content">
                        <h1>----------------------</h1>
                        <h1>Restablecer Contraseña</h1>
                        <h1>----------------------</h1>
                        <br>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label" style="text-align: center;">Correo Electrónico</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            <button style="margin: 0 auto 0 auto;" type="submit" class="btn btn-primary">
                                ------ Enviar ------
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================--> 
@endsection