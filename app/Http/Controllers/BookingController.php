<?php

namespace App\Http\Controllers;


use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Str;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use App\Models\BookingStatus;
use Illuminate\Support\Facades\Gate;
use App\Notifications\BookingStatusChanged;
use App\Services\BookingService;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $bookings = Booking::query()
            ->with('booking_status') // eager loading(load siap siap) vs lazy loading 
            ->where('enabled', 1)
            ->where('user_id', auth()->id())
            ->get()
            ->transform(function($booking) {
                return [
                    'id' => $booking->id,
                    'title' => $booking->applicant,
                    'start' => $booking->start_date,
                    'end' => $booking->end_date,
                    'url' => route('booking.show', $booking),
                    'color' => $booking->booking_status->color

                ];
            });

        return view('booking.index', [
            'bookings' => $bookings,
            'booking_statuses' => BookingStatus::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.edit', [
            'booking' => new Booking,
            'booking_statuses' => BookingStatus::where('enabled', 1)->get(),
            'rooms' => Room::where('enabled', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BookingService $bookingService)
    {
        $request->validate([
            'applicant' => ['required', 'max:255'],
            'purpose' => ['required', 'max:255'],
            'notes' => ['required', 'max:500'],
            'participant_total' => ['required', 'numeric'],
            'start_date' => ['required', 'date', 'after_or_equal:now'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'room_id' => ['required', 'numeric'],

        ]); 

        if ($bookingService->isRoomTaken($request->all())) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This room is not available based on selected dates');
        }

        if ($bookingService->isWithinCapacity($request->all())) {
            return redirect()->back()
                ->withInput()
                ->with('error', "Your total participant is more than room's capacity");
        }


        Booking::create([
            'applicant' => $request->applicant,
            'purpose' => $request->purpose,
            'notes' => $request->notes,
            'participant_total' => $request->participant_total,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_id' => $request->room_id,
            'booking_status_id' => 1, //dalam proses
            'user_id' => auth()->id(),
            'uuid' => Str::uuid()
        ]); // set mass assignment

        return redirect()->route('booking.index')->with('success', 'Booking created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('booking.show', [
            'booking' => $booking->load('booking_status', 'room')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        Gate::authorize('update', $booking);

        return view('booking.edit', [
            'booking' => $booking,
            'booking_statuses' => BookingStatus::where('enabled', 1)->get(),
            'rooms' => Room::where('enabled', 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'applicant' => ['required', 'max:255'],
            'purpose' => ['required', 'max:255'],
            'notes' => ['required', 'max:500'],
            'participant_total' => ['required', 'numeric'],
            'start_date' => ['required', 'date', 'after_or_equal:now'],
            'end_date' => ['required', 'date'],
            'room_id' => ['required', 'numeric'],
            'booking_status_id' => ['required', 'numeric'],
        ]); 

        $booking->update([
            'applicant' => $request->applicant,
            'purpose' => $request->purpose,
            'notes' => $request->notes,
            'participant_total' => $request->participant_total,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_id' => $request->room_id,
            'booking_status_id' => $request->booking_status_id,
        ]); // set mass assignment
        
        if ($booking->wasChanged('booking_status_id')){
            Notification::send($booking->user, new BookingStatusChanged($booking)); 
        }
        
        return redirect()->route('booking.index')->with('success', 'Booking updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
