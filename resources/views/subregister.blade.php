@extends('layouts.homeTemplate')

@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area">
    <div class="banner_inner">
        <div class="container">
            <div class="row">
                    <div style="margin: 10% auto 10% auto; text-align: center;" class="banner_content">
                        <h1>---------------------------</h1>
                        <h1>Registro de Usuario</h1>
                        <h1>---------------------------</h1>
                        <p style="color: red; font-weight: bold;">Los campos con (*) son requeridos.</p>
                        <p style="color: black; font-weight: bold;">Una vez registrado puede descargar nuestra aplicación móvil para empezar a usar el sistema. Totalmente Gratis!</p>
                        <form method="POST" action="{{ route('subregister') }}">
                            @csrf
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                    <label for="nombre" class="col-md-12 control-label" style="text-align: center;">Nombre *</label>

                                    <div class="col-md-12">
                                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                        @if ($errors->has('nombre'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('nombre') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                    <label for="apellido" class="col-md-12 control-label" style="text-align: center;">Apellido *</label>

                                    <div class="col-md-12">
                                        <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required>

                                        @if ($errors->has('apellido'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('apellido') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                                    <label for="cedula" class="col-md-12 control-label" style="text-align: center;">Cédula *</label>

                                    <div class="col-md-12">
                                        <input id="cedula" type="number" class="form-control" name="cedula" value="{{ old('cedula') }}" required>

                                        @if ($errors->has('cedula'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('cedula') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-12 control-label" style="text-align: center;">Correo *</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                    <label for="telefono" class="col-md-12 control-label" style="text-align: center;">Teléfono</label>

                                    <div class="col-md-12">
                                        <input id="telefono" type="number" class="form-control" name="telefono" value="{{ old('telefono') }}">

                                        @if ($errors->has('telefono'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <label for="direccion" class="col-md-12 control-label" style="text-align: center;">Dirección</label>

                                    <div class="col-md-12">
                                        <textarea id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" rows="4" cols="50"></textarea>
                                    </div>
                                    @if ($errors->has('direccion'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                <br>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-12 control-label" style="text-align: center;">Contraseña *</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <button style="margin: 0 auto 0 auto;" type="submit" class="btn btn-primary">
                                    ------ Registrarse ------
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