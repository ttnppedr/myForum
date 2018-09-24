@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="border-bottom">
                    <avatar-form :user="{{ $profileUser }}"></avatar-form>
                </div>

                @forelse ($activities as $date => $activity)
                    <br>
                    <div class="border-bottom">
                        <h3>{{ $date }}</h3>
                    </div>

                    @foreach ($activity as $record)
                        @if (view()->exists("profiles.activities.{$record->type}"))
                            <br>
                            @include("profiles.activities.{$record->type}", ['activity' => $record])
                        @endif
                    @endforeach
                @empty
                    <br>
                    <p>There is no activity for this user yet.</p>
                @endforelse

                <br>
            </div>
        </div>
    </div>
@endsection
