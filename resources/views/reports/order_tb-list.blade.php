
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Order No</th>
            <th>Item Name</th>
            <th>Rate</th>
            <th>Qty</th>
            <th>Total Amount</th>
            <th>Vendors Name</th>
            <th>Firstname</th>
            <th> Lastname</th>
            <th>Mat No</th>
            <th>Date</th>
            <th>Order Status</th>
            <th>Sales Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->order_no }}</td>
            <td>{{ $record->products_tb_product_name }}</td>
            <td>{{ $record->rate }}</td>
            <td>{{ $record->qty }}</td>
            <td>{{ $record->total_amount }}</td>
            <td>{{ $record->vendors_tb_name }}</td>
            <td>{{ $record->users_tb_firstname }}</td>
            <td>{{ $record->users_tb_lastname }}</td>
            <td>{{ $record->mat_no }}</td>
            <td>{{ $record->date }}</td>
            <td>{{ $record->order_status }}</td>
            <td>{{ $record->sales_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
