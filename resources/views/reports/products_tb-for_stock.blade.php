
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Vendors Tb Name</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->product_name }}</td>
            <td>{{ $record->vendors_tb_name }}</td>
            <td>{{ $record->qty }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
