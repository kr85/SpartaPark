@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="content-wrapper content-wrapper-navbar-push">
            <h3>Questions. Concerns. Feedback. No Problem!</h3>
            <h3>Drop Us A Line</h3>

            {{ Form::open(array('route' => 'contact.request')) }}

                @if(count($errors->all()))
                    <ul class="errors">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @elseif (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-2">
                        {{ Form::label('first_name', 'First Name:') }}
                        <br />
                        {{ Form::text('first_name', '') }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::label('last_name', 'Last Name:') }}
                        <br />
                        {{ Form::text('last_name', '') }}
                    </div>
                </div>
                <br />
                {{ Form::label('email', 'E-mail Address:') }}
                <br />
                {{ Form::email('email', '', array('placeholder' => 'example@email.com')) }}
                <br /><br />

                {{ Form::label('subject', 'Subject:') }}
                <br />
                {{ Form::text('subject', '') }}
                <br /><br />

                {{ Form::label('message', 'Message:') }}
                <br />
                {{ Form::textarea('message', '') }}
                <br /><br />

                {{ Form::reset('Reset', array('class' => 'btn btn-default')) }}
                {{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('footer-assets')

@stop
