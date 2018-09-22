@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="border-bottom">
                    <h1>
                        {{ $profileUser->name }}
                    </h1>

                    @can ('update', $profileUser)
                        <form method="POST" action="{{ route('avatar', $profileUser) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" name="avatar">

                            <button type="submit" class="btn btn-primary">Add Avatar</button>
                        </form>
                    @endcan

                    <img src="{{ asset($profileUser->avatar()) }}" width="100" height="100">
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
