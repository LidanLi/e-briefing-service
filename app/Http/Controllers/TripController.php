<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrip;
use App\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = request()->user()->is_admin ? Trip::all() : request()->user()->trips;

        return view('trips.index', [
            'trips' => $trips
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trips.create', [
            'trip' => new Trip()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTrip|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrip $request)
    {
        $trip = $request->user()->myTrips()->create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        $trip->update([
          'code' => $trip->id
        ]);

        return redirect()->route('trips.days.index', $trip)->with('success', __('Course created.  Now you may add Days, People, Articles, Links and Documents to your course.'));
    }

    /**
     * Display the specified resource.
     *
     * @param Trip $trip
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Trip $trip)
    {
        $this->authorize('manage', $trip);

        return view('trips.edit', [
            'trip' => $trip
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        $this->authorize('manage', $trip);

        return view('trips.edit', [
            'trip' => $trip
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreTrip|Request $request
     * @param Trip $trip
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(StoreTrip $request, Trip $trip)
    {
        $this->authorize('manage', $trip);

        $trip->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', __('Course updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $this->authorize('manage', $trip);

        
    }

    public function getTrips()
    {
        $trips = request()->user()->is_admin ? Trip::all() : request()->user()->trips;

        $trips->each->append('owner');
        
        return response()->json($trips);
    }
}
