@extends('layouts.app')

@section('content')
<section>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Report Sales</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Report Sales</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date From</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date To</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" style="margin-top:32px; width:100%;">Search</button>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-2">
                                        <button type="button" class="btn btn-secondary" style="margin-top:32px; width:100%;">Export</button>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="overflow-x:auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:10px">No</th>
                                        <th>DO Number</th>
                                        <th>Rx Number</th>
                                        <th>Dispensing Date</th>
                                        <th>Patient Name</th>
                                        <th>Patient IC No.</th>
                                        <th>Panel</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->do_number }}</td>
                                        <td>{{ $order->prescription->rx_number }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->patient->full_name }}</td>
                                        <td>{{ $order->patient->identification }}</td>
                                        <td>{{ $order->dispensing_by }}</td>
                                        <td>{{ $order->total_amount}}</td>
                                        <td>Complete</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                              {{ $orders->links() }}
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column pb-2">
                                <span class="text-bold text-lg">Total all : RM {{ $totalAll }} </span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right pb-2">
                                <span class="text-success">
                                    {{-- <i class="fas fa-arrow-up"></i> 33.1% --}}
                                    <span>Sales Over Time</span>
                                </span>
                                <span class="text-muted"></span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
            
                            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="sales-chart" height="200" style="display: block; width: 604px; height: 200px;" width="604" class="chartjs-render-monitor"></canvas>
                            </div>
            
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                <i class="mdi mdi-checkbox-blank text-primary"></i> This year
                                </span>
                                {{-- <span>
                                <i class="mdi mdi-checkbox-blank text-secondary"></i> Last year
                                </span> --}}
                            </div>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
</section>




@endsection

@section('script')
@include('reports.dashboard3')
@endsection

