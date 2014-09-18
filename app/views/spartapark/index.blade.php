@extends('layouts.master')

@section('content')
    @if(Route::currentRouteName() == 'lots.near.coordinates')
        @include('partials.geolocation')
    @elseif(Route::currentRouteName() == 'lots.near.address')
        @include('partials.address')
    @endif

    {{ HTML::link('api/lot_info/lot_id/51', 'Lot_info by lot_id') }}
    <br />
    {{ HTML::link('api/region_info/region_id/35', 'Regon_info by region_id') }}
    <br />
    {{ HTML::link('api/lots_near_coordinates', 'Lot_near_my_coordinates') }}
    <br />
    {{ HTML::link('api/lots_near_address/address/', 'Lot_near_address') }}

@stop
