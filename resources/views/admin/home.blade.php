@extends('admin.layouts.admin')

@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Concerto Kevin O Chris</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $concerto_x }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Concerto Tay</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $concerto_y }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Concerto João Pedro Pais</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $concerto_z }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($graphPie as $graph)
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $graph['title'] }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas class="pie-chart-admin" id="{{ $graph['id'] }}" data-object="{{ json_encode($graph['data']) }}"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Lotação
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Check-in
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Vagas
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
@section('scripts')
    <!-- Page level plugins -->
    <script src="/dashboard/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="/dashboard/js/demo/chart-area-demo.js"></script> --}}
    <script src="/dashboard/js/demo/chart-pie-demo.js"></script>
@endsection