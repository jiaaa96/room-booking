@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rooms</div>

                <div class="card-body">
                    <div class="mb-3"> 
                        <form action="{{route('room.index')}}" method="GET"> 
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{request()->query('name')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="room_category_id">Room Category</label>
                                    <select class="custom-select" id="room_category_id" name="room_category_id">
                                        <option value="">Choose..</option>
                                        @foreach ($room_categories as $room_category)
                                        <option value="{{ $room_category->id }}"
                                            {{ $room_category->id == request()->query('room_category_id') ? 'selected' : '' }}>
                                            {{ $room_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-info">Search</button>
                                <a href="{{route('room.index')}}" class="btn btn-danger">Reset</a>
                        </form>
                    </div>

                    <table class="table">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Capacity</th>
                              <th>Room Category</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($rooms as $room)
                          <tr>
                              <th>
                                  {{ $loop->iteration + $rooms->firstItem() - 1 }}
                              </th>
                              <td>{{ $room->name }}</td>
                              <td>{{ $room->capacity }}</td>
                              <td>{{ $room->room_category->name}}</td>
                              <td>
                                  <form id="form-room-destroy-{{$room->id}}" action="{{ route('room.destroy', $room) }}" method="POST">
                                      @csrf
                                      @method('delete')
                                  </form>
                                      <a class="btn btn-sm btn-link" href="{{ route('room.edit', $room) }}">Edit</a>
                                      <button type="submit" form="form-room-destroy-{{$room->id}}" class="btn btn-sm btn-link" form="form-room-destroy" onclick="return confirm('adakah anda pasti?')">Delete</button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
          
                  {{ $rooms->links() }}

                  <a href="{{route('room.create')}}" class="btn btn-primary">Add</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
