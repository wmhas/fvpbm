@extends('layouts.app')

@section('content')
{{-- <div class="content-wrapper"> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Batch View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="batch.html">Batch</a></li>
                        <li class="breadcrumb-item active">Batch View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">B000{{ $group->id }}</h3>
                    </div>
                    <div class="card-body" style="overflow-x:auto;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>DO Number</th>
                                    <th>RX Number</th>
                                    <th>Patient Detail</th>
                                    <th>Agency</th>
                                    <th>Created Date</th>
                                    <th>Batch Person</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batches as $batch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ url('/order/'.$batch->order_id.'/view') }}" title="View Order"><i class="fas fa-folder-open"></i>{{ $batch->order->do_number }}</a> 
                                    </td>
                                    <td>{{ $batch->order->prescription->rx_number }}</td>
                                    <td>
                                        {{ $batch->order->patient->full_name }}
                                        <br><br>
                                        (IC: {{ $batch->order->patient->identification }})
                                    </td>
                                    <td>{{ $batch->order->patient->tariff->name }}</td>
                                    <td>{{ date("d/m/Y", strtotime($batch->order->created_at))}}</td>
                                    <td>{{ $batch->batchperson->name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

@endsection