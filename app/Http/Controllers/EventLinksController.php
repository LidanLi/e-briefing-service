<?php

namespace App\Http\Controllers;

use App\Link;
use App\Event;
use App\Http\Requests\StoreLink;
use Illuminate\Http\Request;

class EventLinksController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function add(Event $event)
    {
        $this->authorize('manage', $event->trip);

        $event->links()->attach(request()->link);

        return redirect()->back()->with('success', 'Link added!');
    }

    public function create(Event $event)
    {
        $this->authorize('manage', $event->trip);

        return view('trips.days.events.links.create', [
            'event' => $event,
            'link' => new Link()
        ]);
    }

    public function store(Event $event, StoreLink $request)
    {
        $this->authorize('manage', $event->trip);
        
        $trip = $event->trip;

       
        $link = $trip->links()->create([
            'name' => $request->name,
            'link_type' => $request->link_type,
            'linkinfo' => $request->linkinfo
        ]);

        $event->links()->attach($link->id);

        return redirect()->route('events.show', $event)->with('success', 'Link added!');
    }

    public function remove(Event $event, Link $link)
    {
        $event->links()->detach($link);

        return redirect()->back()->with('success', 'Link removed');
    }
}
