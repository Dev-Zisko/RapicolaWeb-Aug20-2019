@extends('layouts.subdashboardTemplate')

@section('content')
<!-- ============================================================== -->
<!-- Page Content -->
<!-- ============================================================== -->
<div id="page-wrapper" style="background-color: #B2E1FF; padding-top: 3%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <a href="{{url('restart', $id)}}" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light"><i class="fa fa-home"></i> Reiniciar cola</a>
                    <h3 class="box-title">Gestión de la Sucursal {{ $subsidiary->nombre}} J-{{ $subsidiary->rif }}</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Personas Disponibles</th>
                                    <th>Personas en cola</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$disponibles}}</td>
                                    <td class="txt-oflo">{{$people}}</td>
                                </tr>
                            </tbody>
                        </table>
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