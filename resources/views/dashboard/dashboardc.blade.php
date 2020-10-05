@extends('layouts.dashboardTemplate')

@section('content')
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style="background-color: #B2E1FF; padding-top: 3%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <a href="{{url('dashboardrc',Crypt::encrypt($subsidiary->id))}}" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-home"></i> Crear cajero</a>
                    <h3 class="box-title">Cajeros de la Sucursal {{ $subsidiary->nombre}} J-{{ $subsidiary->rif }}</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>CEDULA</th>
                                    <th>NOMBRE</th>
                                    <th>TELEFONO</th>
                                    <th>EMAIL</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashiers as $cashier)
                                <tr>
                                    <td>{{$cashier->cedula}}</td>
                                    <td class="txt-oflo">{{$cashier->nombre}} {{$cashier->apellido}}</td>
                                    <td>{{$cashier->telefono}}</td>
                                    <td class="txt-oflo">{{$cashier->email}}</td>
                                    <td><a class="boton-admin-table" href="{{url('dashboarduc',Crypt::encrypt($cashier->id))}}"><i class="fa fa-edit"></i></a>
                                    <a class="boton-admin-table" href="{{url('dashboarddc',Crypt::encrypt($cashier->id))}}"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div>{{$cashiers->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <footer style="background-color: #1A8FD8; color: white;" class="footer text-center"> Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
    Todos los derechos reservados Rapi_Cola. Diseñado por Zisko y Wrappixel </footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
@endsection
