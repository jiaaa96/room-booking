@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Bookings</div>

    <div class="card-body">
        <div class="mb-3"> 
            <div id='calendar'></div>
        </div>

        <div class=mb-3> 
            @foreach ($booking_statuses as $booking_status)
                <span class="badge badge-pilll" style="background-color: {{$booking_status->color}}; color: #fff;"> {{ $booking_status->name}} </span>
            @endforeach
        </div>

        <a href="{{ route('booking.create') }}" class="btn btn-primary">
            <i class="ti ti-circle-plus mr-2"></i>Add
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var bookings = {!!json_encode($bookings)!!};
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prev,next',
                center: 'title',
                end: 'dayGridMonth,dayGridWeek,listWeek'
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            },
            events: bookings
        });
        setTimeout(function(){ //timeout untuk dia load css untuk delaykan dia
             calendar.render();
        }) 
      });
</script>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css"  rel="stylesheet" />
@endpush