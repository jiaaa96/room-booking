<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dump($request->all());

        //with ->(to link relationship)
        $rooms = Room::with('room_category')
            ->where('enabled', 1)
            ->when($request->name, function($query) use ($request) {
                return $query->where('name', 'LIKE', '%'.$request->name.'%');
            }) // untuk search
            ->when($request->room_category_id, function($query) use ($request) {
                return $query->where('room_category_id', $request->room_category_id);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('room.index', [
            'rooms' => $rooms,
            'room_categories' => RoomCategory::where('enabled', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('room.edit', [
            'room' => new Room, 
            'room_categories' => RoomCategory::where('enabled', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //to save data create
        $request->validate([
            'name' => ['required', 'max:255'],
            'capacity' => ['required', 'max:4'],
            'room_category_id' => ['required'],
        ]);

        Room::create([
            'name'=>$request->name,
            'capacity'=>$request->capacity,
            'room_category_id'=>$request->room_category_id,
            'user_id'=>auth()->id(),
        ]);

        return redirect()->route('room.index')->with('success', 'Room created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //edit data

        return view('room.edit', [
            'room' => $room,
            'room_categories' => RoomCategory::where('enabled', 1)->get()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        // update data
        //dd($request->all()); to dump data

        $request->validate([
            'name' => ['required', 'max:255'],
            'capacity' => ['required', 'max:4'],
            'room_category_id' => ['required'],
        ], 

        //untuk custom error
        [
            'name.required' => 'The :attribute is required.',
            'name.max' => 'The :attribute may not be greater than :max characters.',
            'capacity.required' => 'The :attribute is required.',
            'capacity.max' => 'The :attribute may not be greater than :max characters.',
            'room_category_id.required' => 'The :attribute is required.',
        ]);

        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'user_id' => auth()->id(),
            'room_category_id' => $request->room_category_id,
        ]); // set mass assignment

        return redirect()->route('room.index')->with('success', 'Room updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //for delete function
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room deleted.');
    }
}
