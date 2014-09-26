@extends('layouts.master')

@section('content')
    <!--@if(Route::currentRouteName() == 'current.location' || Route::currentRouteName() == 'lots.near.current.location')
        @include('partials.geolocation')
    @elseif(Route::currentRouteName() == 'lots.near.address.web')
        @include('partials.address')
    @endif-->

    <!--<div class="test">
        Test
    </div>
    {{ HTML::link('api/lot_info/lot_id/51', 'Lot_info by lot_id') }}
    <br />
    {{ HTML::link('api/region_info/region_id/35', 'Regon_info by region_id') }}
    <br />
    {{ HTML::link('api/lots_near_coordinates', 'Lot_near_my_coordinates') }}
    <br />
    {{ HTML::link('api/lots_near_address/address/', 'Lot_near_address') }}

    <br />
    <br />

    {{ Form::open(array('route' => 'upload.image', 'files' => 'true')) }}
        Lot Id: {{ Form::text('lot_id') }}
        <br />
        Region Id: {{ Form::text('region_id') }}
        <br />
        Orientation: {{ Form::text('orientation') }}
        <br />
        Image: {{ Form::file('image') }}
        <br />
        Password: {{ Form::text('password') }}
        <br />
        {{ Form::submit('Submit') }}
    {{ Form::close() }}-->
@stop
