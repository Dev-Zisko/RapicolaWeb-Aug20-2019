@extends('layouts.dashboardTemplate')

@section('content')
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper" style="background-color: #B2E1FF; padding-top: 3%;">
                <div class="row">
                    <form class="contact-form" method="POST" enctype="multipart/form-data" style="margin: 0 auto; text-align: center; width: 600px;">
                        @csrf
                        <h2 style="color: black; font-weight: bold;">Editar Sucursal</h2>
                        <label style="margin-top: 5px;" for="nombre" class="col-md-12 control-label">Nombre de la Sucursal</label>
                        <input style="text-align: center;" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" type="text" name="nombre" value="{{ $subsidiary->nombre }}" required>
                        @if ($errors->has('nombre'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                        <label style="margin-top: 5px;" for="telefono" class="col-md-12 control-label">Teléfono de la Sucursal</label>
                        <input style="text-align: center;" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" type="number" name="telefono" value="{{ $subsidiary->telefono }}" required>
                        @if ($errors->has('telefono'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{ $errors->first('telefono') }}</strong>
                            </span>
                        @endif
                        <label style="margin-top: 5px;" for="email" class="col-md-12 control-label">Correo electrónico de la Sucursal</label>
                        <input style="text-align: center;" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ $subsidiary->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <label style="margin-top: 5px;" for="direccion" class="col-md-12 control-label">Dirección de la Sucursal</label>
                        <textarea style="text-align: center;" id="direccion" type="text" class="form-control" name="direccion" rows="4" cols="50" placeholder="Dirección física">{{ $subsidiary->direccion }}</textarea>
                        @if ($errors->has('direccion'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{ $errors->first('direccion') }}</strong>
                            </span>
                        @endif
                        <label style="margin-top: 5px;" for="direccion" class="col-md-12 control-label">Logo de la sucursal</label>
                        <input style="text-align: center;" class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}" type="file" name="logo" placeholder="Logo de la Sucursal" required>
                        @if ($errors->has('logo'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{ $errors->first('logo') }}</strong>
                            </span>
                        @endif
                        <label style="margin-top: 5px;" for="password" class="col-md-12 control-label">Contraseña de la Sucursal</label>
                        <input style="text-align: center;" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Contraseña" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <button style="margin: 20px 0px 20px 0px;" class="btn btn-danger" type="submit">Guardar</button>
                    </form>
                </div>
            <!--/.row -->
        </div>
        <footer style="background-color: #1A8FD8; color: white;" class="footer text-center"> Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
    Todos los derechos reservados Rapi_Cola. Diseñado por Zisko y Wrappixel </footer>
    </div>
@endsection
