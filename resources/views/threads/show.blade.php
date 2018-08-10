@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creater->name }}</a> posted
                    {{ $thread->title }}
                    }
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
            @foreach ($thread->replies as $reply)
                @include ('threads.reply')
            @endforeach

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
                            <button type="submit" class="btn btn-default">Post</button>
                        </form>
                    </div>
                </div>
            @else
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
            @endif
        </div>
    </div>
</div>
@endsection
