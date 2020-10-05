@extends('layouts.dashboardTemplate')

@section('content')
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper" style="background-color: #B2E1FF; padding-top: 3%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total de Clientes atendidos</h3>
                            <span class="text-success" style="font-weight: bold;">En todas las sucursales</span>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">{{ $atendidos }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Sucursal que más atiende</h3>
                                <span class="text-purple" style="font-weight: bold;">{{ $sucursal }}</span>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                @foreach ($subsidiaries as $subsidiary)
                                    @if($subsidiary->id == $id)
                                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{ $mayor }}</span></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Tiempo promedio de atención</h3>
                            <span class="text-info" style="font-weight: bold;">En minutos</span>
                            <ul class="list-inline two-part">
                                <li>
                                    <div id="sparklinedash3"></div>
                                </li>
                                <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">{{ $promedio }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">N° de Clientes atendidos en cada Sucursal</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>N° de Clientes</th>
                                            <th>RIF</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($subsidiaries as $k => $v)   
                                        <tr>
                                            <td><span class="text-info" style="font-weight: bold;">{{ $arrayatendidos[$k] }}</span></td>
                                            <td class="txt-oflo">{{ $subsidiaries[$k]->rif }}</td>
                                            <td>{{ $subsidiaries[$k]->nombre }}</td>
                                            <td class="txt-oflo">{{ $subsidiaries[$k]->email }}</td>
                                        </tr>  
                                    @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <div>{{$subsidiaries->links()}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">N° de Clientes atendidos por Cajeros</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>N° de Clientes</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Sucursal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cashiers as $cashier)
                                        <tr>
                                            <td><span class="text-info" style="font-weight: bold;">{{ $cashier->atendidos }}</span></td>
                                            <td class="txt-oflo">{{ $cashier->cedula }}</td>
                                            <td>{{ $cashier->nombre }} {{ $cashier->apellido}}</td>
                                            <td class="txt-oflo">{{ $cashier->email }}</td>
                                            @foreach ($subsidiaries as $subsidiary)
                                                @if($subsidiary->id == $cashier->id_subsidiary)
                                                <td>{{ $subsidiary->nombre }}</td>
                                                @endif
                                            @endforeach
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
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Tiempo promedio en cola en cada sucursal</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tiempo promedio</th>
                                            <th>RIF</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subsidiaries as $k => $v)   
                                        <tr>
                                            <td><span class="text-info" style="font-weight: bold;">{{ $arrayprom[$k] }} mins</span></td>
                                            <td class="txt-oflo">{{ $subsidiaries[$k]->rif }}</td>
                                            <td>{{ $subsidiaries[$k]->nombre }}</td>
                                            <td class="txt-oflo">{{ $subsidiaries[$k]->email }}</td>
                                        </tr>  
                                        @endforeach
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
