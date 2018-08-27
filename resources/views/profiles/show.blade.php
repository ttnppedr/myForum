@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="border-bottom">
                    <h1>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>

                @foreach ($activities as $date => $activity)
                    <br>
                    <div class="border-bottom">
                        <h3>{{ $date }}</h3>
                    </div>

                    @foreach ($activity as $record)
                        <br>
                        @include("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                @endforeach

                <br>
            </div>
        </div>
    </div>
@endsection