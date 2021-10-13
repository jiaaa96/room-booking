@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Bookings</div>

    <div class="card-body">

        <a href="{{ route('booking.create') }}" class="btn btn-primary">
            <i class="ti ti-circle-plus mr-2"></i>Add
        </a>
    </div>
</div>
@endsection
