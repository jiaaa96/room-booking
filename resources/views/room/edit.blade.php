@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">{{ $room->id ? "Edit Room - $room->name" : 'Create Room' }}</div>

    <div class="card-body">
        <form id="room-edit" action="{{ $room->id ? route('room.update', $room) : route('room.store') }}" method="POST">
            @csrf
            @method($room->id ? 'put' : 'post')

            @if($room->id) 
                <div class="alert alert-primary" role="alert">
                   Updating
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    Creating
                </div>
            @endif

            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $room->name) }}">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="capacity" class="col-sm-2 col-form-label">Capacity</label>
              <div class="col-sm-6">
                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}">
                
                @error('capacity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
                <label for="capacity" class="col-sm-2 col-form-label">Room Category</label>
                <div class="col-sm-8">
                    <select class="custom-select @error('room_category_id') is-invalid @enderror" id="room_category_id" name="room_category_id">
                        <option value="">Choose..</option>
                        @foreach ($room_categories as $room_category)
                        <option value="{{ $room_category->id }}"
                            {{ $room_category->id == old('room_category_id', $room->room_category_id) ? 'selected' : '' }}>
                            {{ $room_category->name }}</option>
                        @endforeach
                    </select>

                    @error('room_category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

          <div class="d-flex justify-content-end">
              <a href="{{ url()->previous() }}" class="btn btn-link mr-2">Cancel</a>
              <button type="submit" class="btn btn-primary" form="room-edit">{{$room->id ? 'Update' : 'Create'}}</button>
          </div>
        </form>
    </div>
</div>
@endsection
