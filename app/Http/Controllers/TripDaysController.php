<?php

namespace App\Http\Controllers;


use App\Day;
use App\Http\Requests\StoreDay;
use App\Trip;

class TripDaysController extends Controller
{
    public function index(Trip $trip)
    {
        return view('trips.days.index', [
            'trip' => $trip,
            'days' => $trip->days()->orderBy('date')->get()
        ]);
    }

    public function create(Trip $trip)
    {
        return view('trips.days.create', [
            'trip' => $trip,
            'day' => new Day()
        ]);
    }

    public function store(Trip $trip, StoreDay $request)
    {
        $trip->days()->create([
            'name' => $request->name,
            'date' => $request->date
        ]);

        return redirect()->route('trips.days.index', $trip)->with('success', 'Day added!');
    }

}