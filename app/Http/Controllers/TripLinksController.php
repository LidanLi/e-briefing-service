<?php

namespace App\Http\Controllers;

use App\Link;
use App\Http\Requests\StoreLink;
use App\Trip;
use Illuminate\Http\Request;

class TripLinksController extends Controller
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
    public function index(Trip $trip)
    {
        $this->authorize('manage', $trip);

        return view('trips.links.index', [
            'trip' => $trip,
            'linksByType' => $trip->links->groupBy('link_type')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Trip $trip)
    {
        $this->authorize('manage', $trip);

        return view('trips.links.create', [
            'trip' => $trip,
            'link' => new Link()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Trip $trip
     * @param StoreDocument|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Trip $trip, StoreLink $request)
    {
        $this->authorize('manage', $trip);

         $trip->links()->create([
            'name' => $request->name,           
            'link_type' => $request->link_type,
            'linkinfo' => $request->linkinfo
        ]);
        
        

        return redirect()->route('trips.links.index', $trip)->with('success', 'Link uploaded!');
    }
}
