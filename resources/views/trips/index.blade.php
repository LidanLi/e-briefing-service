@extends('layouts.app')

@section('content')
    <h1 class="title">{{ __('Weeks') }}
        <a href="{{ route('trips.create') }}" class="is-size-6">
            <span class="icon">
                <i class="fa fa-plus-circle"></i>
            </span>
            <span>
                {{ __('Create a Week') }}
            </span>
        </a>
    </h1>

    @include('layouts.flash')

    @unless($trips->count())
        {{ __('There are currently no week defined') }}
    @else
   
     

       <div>
           <list-table
            :csrf_token="'{{ csrf_token() }}'">
            </list-table>
       </div>   
   
    <!--<div data-filter="all">
        <table id="datatable" class="table table-bordered table-hover">
             <thead>
                <tr>
                    <td>
                        <input id="coursename" type="text" class="input"
                                placeholder="Search for course name..." name="coursename">
                        <input id="Button1" type="button" value="button" onclick="updateTable()">
                    </td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>{{ __('Course name') }}</th>
                    <th>{{ __('Owner') }}</th>
                    <th>{{__('Date')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
               
                @foreach($trips as $trip)
                    <tr>
                        <td>{{ $trip->name }}</td>
                        <td>{{ $trip->creator->name }}</td>
                        <td>{{ $trip->created_at }}</td>
                        <td class="has-text-right">

                            <form class="is-inline download-form" action="{{ route('trips.copy', $trip) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="button download-button" onclick="return confirm('Are you sure you want to copy {{ $trip->name }}?')">
                                    <span class="icon">
                                        <i class="fa fa-copy"></i>
                                    </span>
                                    <span>
                                        {{ __('Copy Course') }}
                                    </span>
                                </button>
                            </form>

                            <a href="{{ route('trips.days.index', $trip) }}" class="button">
                                <span class="icon">
                                    <i class="fa fa-cogs"></i>
                                </span>
                                <span>
                                    {{ __('Manage Course') }}
                                </span>
                            </a>

                            <form class="is-inline download-form" action="{{ route('trips.generate', $trip) }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="button download-button">
                                    <span class="icon">
                                        <i class="fa fa-download"></i>
                                    </span>
                                    <span>
                                        {{ __('Generate Package') }}
                                    </span>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach 
            </tbody>
           
        </table>
    </div>-->

   
    @endunless
@endsection




