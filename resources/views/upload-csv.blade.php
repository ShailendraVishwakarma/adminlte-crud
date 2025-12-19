@extends('layouts.admin')

@section('content')

<form action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" accept=".csv" required>
    <button type="submit">Upload CSV</button>
</form>

@if(isset($rows) && count($rows))
<hr>

<table border="1" cellpadding="8">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Status</th>
    </tr>

    @foreach($rows as $row)
        <tr>
            <td>{{ $row[0] }}</td>
            <td>{{ $row[1] }}</td>
            <td>{{ $row[2] }}</td>
        </tr>
    @endforeach
</table>
@endif

@endsection
