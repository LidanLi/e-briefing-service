<?php

namespace App\Http\Controllers;

use App\Article;
use App\Day;
use App\Document;
use App\Event;
use App\Person;
use App\Trip;

class GenerateTripDelete extends Controller
{
    public function __invoke(Trip $trip)
    {
        $trip->load('people', 'days', 'days.events', 'days.events.contacts', 'days.events.participants', 'days.events.documents', 'articles', 'documents', 'collaborators');

        foreach($trip->getRelation('people') as $people){
            $people->delete();
        }

        foreach($trip->getRelation('documents') as $documents){
            $documents->delete();
        }

        foreach($trip->getRelation('days') as $days){
           

            foreach($days->getRelation('events') as $events){
               
              

                foreach($events->getRelation('documents') as $edocument){
                    $events->documents()->detach($edocument);
                }

                $events->delete();
            }

            $days->delete();
        }

        $trip->delete();

        return redirect()->back()->with('success', 'Week deleted');
    }
}
