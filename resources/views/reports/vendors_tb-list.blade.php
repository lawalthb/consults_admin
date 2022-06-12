
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Vendor Id</th>
            <th>Title</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department Id</th>
            <th>Status</th>
            <th>Reg Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->vendor_id }}</td>
            <td>{{ $record->title }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->department_id }}</td>
            <td>{{ $record->status }}</td>
            <td>{{ $record->reg_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
