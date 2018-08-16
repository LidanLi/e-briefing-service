@extends('layouts.app')

@section('content')
    <div class="columns">
        @push('nav-menu')
        @include('trips._sidebar', ['trip' => $event->trip])
        @endpush

        <div class="column">
            <h1 class="title">{{ __('Add a Link') }}</h1>

            @include('layouts.flash')

            <form action="{{ route('events.links.store', $event) }}" method="POST">
                {{ csrf_field() }}
                @include('trips.links._form')

                <button type="submit" class="button is-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection