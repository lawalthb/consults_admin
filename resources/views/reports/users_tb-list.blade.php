
@extends('layouts.report')
@section('content')
<div id="report-title"><h1></h1></div>
<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Matric No</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Level</th>
            <th>Status</th>
            <th>Reg Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->firstname }}</td>
            <td>{{ $record->lastname }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->matric_no }}</td>
            <td>{{ $record->phone }}</td>
            <td>{{ $record->gender }}</td>
            <td>{{ $record->department }}</td>
            <td>{{ $record->level }}</td>
            <td>{{ $record->status }}</td>
            <td>{{ $record->reg_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
