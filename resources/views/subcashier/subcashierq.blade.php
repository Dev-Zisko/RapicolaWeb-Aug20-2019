@extends('layouts.subcashierTemplate')

@section('content')
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style="background-color: #B2E1FF; padding-top: 3%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">Gestión de la Sucursal {{ $subsidiary->nombre}} J-{{ $subsidiary->rif }}</h3>
                    <h3 class="box-title">Cajero {{ $cashier->nombre}} {{ $cashier->apellido}} CI.-{{ $cashier->cedula}} </h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Personas Disponibles</th>
                                    <th>Personas en cola</th>
                                </tr>
                            </thead>
                            <tbody id="datos">
                            </tbody>
                        </table>
                        <br>
                        @if($cashier->puesto != '')
                        <h3 class="box-title" style="margin-left: 36%;">Número a ser atendido:</h3>
                        @endif
                        <p class="text-info" style="font-size: 3em; margin-left: 45%;">{{ $cashier->puesto}}</p>
                            <a href="{{url('nextqueue', $id)}}" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-home"></i> Siguiente en la cola</a>
                        @if($cashier->puesto != '')
                            <a href="{{url('nowqueue', $id)}}" style="margin-right: 30%;" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-home"></i> Atendiendo</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input id="dato" type="hidden" value="{{ $cashier->id_subsidiary }}">
    <!-- /.container-fluid -->
    <footer style="background-color: #1A8FD8; color: white;" class="footer text-center"> Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
                Todos los derechos reservados Rapi_Cola. Diseñado por Zisko y Wrappixel </footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
@endsection