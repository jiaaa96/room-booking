
<div class="nav flex-column nav-pills">
    <a class="nav-link {{(strpos(Route::currentRouteName(), 'home') === 0) ? 'active' : ''}} " href="{{route('home')}}">
        <i class="ti ti-dashboard mr-2"></i>Dashboard
    </a>
    <a class="nav-link {{(strpos(Route::currentRouteName(), 'room') === 0) ? 'active' : ''}}" href="{{route('room.index')}}">
        <i class="ti ti-mushroom mr-2"></i>Rooms
    </a>
    <a class="nav-link {{(strpos(Route::currentRouteName(), 'booking') === 0) ? 'active' : ''}}" href="{{route('booking.index')}}">
        <i class="ti ti-bookmark mr-2"></i>Bookings
    </a>  
</div>