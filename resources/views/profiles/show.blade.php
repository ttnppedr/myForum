@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="border-bottom">
            <h1>
                {{ $profileUser->name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        @foreach ($threads as $thread)
            <br>
            <div class="card">
                <div class="card-header">
                    <div class="level">
                        <span class="flex">
                            <a href="#">{{ $thread->creator->name }}</a> posted
                            {{ $thread->title }}
                        </span>

                        <span>{{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $thread->body }}

                </div>
            </div>
        @endforeach

        <br>
        {{ $threads->links() }}
    </div>
@endsection