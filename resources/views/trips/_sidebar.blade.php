<div class="column is-2">
    <aside class="menu">
        <p class="menu-label">
            Manage Week
        </p>
        <ul class="menu-list">
            <li><a href="{{ route('trips.show', $trip) }}">Week</a></li>
            <li><a href="{{ route('trips.days.index', $trip) }}">Schedule</a></li>
            <li><a href="{{ route('trips.people.index', $trip) }}">People</a></li>
            <li><a href="{{ route('trips.articles.index', $trip) }}">My Week</a></li>
            <li><a href="{{ route('trips.documents.index', $trip) }}">Documents</a></li>
        </ul>
        @if(auth()->user()->id == $trip->creator->id)
            <hr>
            <ul class="menu-list">
                <li><a href="{{ route('trips.collaborators.index', $trip) }}">Collaborators</a></li>
            </ul>
        @endif
    </aside>
</div>