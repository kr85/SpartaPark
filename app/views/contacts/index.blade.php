@extends('layouts.master')

@section('content')
    <div class="content-wrapper-navbar-push">
        <div class="content-wrapper">
            <h3>Questions. Concerns. Feedback. No Problem!</h3>

            <div class="contact-form-wrapper">
                <div class="contact-form-center">
                    <h3>Drop Us A Line</h3>

                    {{ Form::open(array('route' => 'contact.request')) }}

                        @if(count($errors->all()))
                            <ul class="errors">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                {{ Form::label('first_name', 'First Name:') }}
                                <br />
                                {{ Form::text('first_name', '', array('class' => 'col-xs-12 col-sm-12 col-md-12')) }}
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                {{ Form::label('last_name', 'Last Name:') }}
                                <br />
                                {{ Form::text('last_name', '', array('class' => 'col-xs-12 col-sm-12 col-md-12')) }}
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {{ Form::label('email', 'E-mail Address:') }}
                                <br />
                                {{ Form::email('email', '', array('placeholder' => 'example@email.com', 'class' => 'textarea-style')) }}
                            </div>
                        </div>
                        <br />

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {{ Form::label('subject', 'Subject:') }}
                                <br />
                                {{ Form::text('subject', '', array('class' => 'textarea-style')) }}
                            </div>
                        </div>
                        <br />

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {{ Form::label('message', 'Message:') }}
                                <br />
                                {{ Form::textarea('message', '', array('class' => 'textarea-style')) }}
                            </div>
                        </div>
                        <br />

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="pull-right">
                                    {{ Form::reset('Reset', array('class' => 'btn btn-default')) }}
                                    {{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
                                </div>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <br /><br />
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer-assets')

@stop
