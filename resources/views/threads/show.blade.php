@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="level">
                        <span class="flex">
                            <a href="{{ route('profile', $thread->creator->name) }}">{{ $thread->creator->name }}</a> posted
                            {{ $thread->title }}
                        </span>

                        @if (Auth::check())
                            <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-link"> Delete Thread</button>
                            </form>
                        @endif
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
            <br>
            @foreach ($replies as $reply)
                @include ('threads.reply')
            @endforeach

            {{ $replies->links() }}

            @if(auth()->check())
                <div class="card">
                    <div class="card-header">
                        Leave a Comment
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ $thread->path() . '/replies' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" row="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>
                </div>
            @else
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
