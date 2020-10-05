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
                        <form method="POST" action="{{ route('password.update') }}">
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

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-12 control-label" style="text-align: center;">Contraseña</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                                    <label for="password-confirm" class="col-md-12 control-label" style="text-align: center;">Confirmar Contraseña</label>
                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password-confirmation" value="{{ old('password') }}" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password-confirm') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            <br>
                            <button style="margin: 0 auto 0 auto;" type="submit" class="btn btn-primary">
                                ------ Resetear Contraseña ------
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