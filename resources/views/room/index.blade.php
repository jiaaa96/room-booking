@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rooms</div>

                <div class="card-body">
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
