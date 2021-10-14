@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">{{ $booking->applicant }}</div>

    <div class="card-body">
        <div class="form-group row">
          <label for="applicant" class="col-sm-2 col-form-label">Applicant</label>
          <div class="col-sm-10">
            <p>{{ $booking->applicant }}</p>
          </div>
        </div>

        <div class="form-group row">
          <label for="purpose" class="col-sm-2 col-form-label">Purpose</label>
          <div class="col-sm-10">
            <p>{{ $booking->purpose }}</p>
          </div>
        </div>

        <div class="form-group row">
          <label for="notes" class="col-sm-2 col-form-label">Notes</label>
          <div class="col-sm-10">
            <p>{{ $booking->notes }}</p>
          </div>
        </div>

        <div class="form-group row">
          <label for="participant_total" class="col-sm-2 col-form-label">Participant Total</label>
          <div class="col-sm-6">
            <p>{{ $booking->participant_total }}</p>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Supporting Document</label>
          <div class="col-sm-10">
              @if ($booking->supporting_document_attachment)
              <p class="my-2">
                  <a href="{{ $booking->supporting_document_attachment->url }}" target="_blank" class="btn btn-primary btn-sm">
                      <i class="ti ti-download mr-1"></i>
                      {{ $booking->supporting_document_attachment->name }}
                  </a>
              </p>
              @else
              <p class="my-2 text-secondary">
                  No attachment
              </p>
              @endif
          </div>
        </div>
        

        <div class="form-group row">
          <label for="start_date" class="col-sm-2 col-form-label">Start At</label>
          <div class="col-sm-10">
            <p>{{ $booking->start_date->format('d/m/Y g:i A') }}</p>
          </div>
        </div>

        <div class="form-group row">
          <label for="end_date" class="col-sm-2 col-form-label">End At</label>
          <div class="col-sm-10">
            <p>{{ $booking->end_date->format('d/m/Y g:i A') }}</p> 
          </div>
        </div>

        <div class="form-group row">
            <label for="room_id" class="col-sm-2 col-form-label">Room Name</label>
            <div class="col-sm-8">
              <p>{{ $booking->room->name }}</p>
            </div>
        </div>

        <div class="form-group row">
          <label for="booking_status_id" class="col-sm-2 col-form-label">Booking Status</label>
          <div class="col-sm-8">
            <p>{{ $booking->booking_status->name }}</p>
          </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ url()->previous() }}" class="btn btn-link mr-2">Cancel</a>
            @if ($booking->booking_status_id === 1)
            @can ('edit_booking')
            <a href="{{ route('booking.edit', $booking) }}" class="btn btn-primary">Edit</a>
            @endcan
            @endif
        </div>
    </div>
</div>
@endsection
