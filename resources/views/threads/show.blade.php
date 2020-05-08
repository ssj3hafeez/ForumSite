@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel-header">
                <div class="card-header">
                    <div class="level">
                        <span class="flex">
                            <a href="{{ route( 'profile', $thread->creator)}}">{{ $thread->creator->name }}</a> Posted:
                             {{ $thread->title }} 
                             </span>
         
                             <form action="{{ $thread->path() }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                             <button type="submit" class="btn btn-link"> Delete</button>
                             </form>
                            </div>
                        </div>

            <div class="card">
                    {{ $thread->body }}
                </div>
          
            <br>

        @foreach ($replies as $reply)
             @include ('threads.reply')
        @endforeach

        {{ $replies->links() }}

        <br>
   @if (auth()->check())

            <form method="POST" action="{{ $thread->path() . '/replies' }}">
                {{ csrf_field() }}

        <div class="form-group">
            <textarea name= "body" id="body" class="form-control" placeholder="Speak your mind" rows="6"></textarea>
        </div>

                <button type="submit" class="btn btn-primary">Post</button>
            </form> 
      
@else 
 <p class="text-center"> Please <a href=" {{ route('login') }}">sign-in </a> to Post  </p>
  @endif

</div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                      Thread was published {{ $thread->created_at->diffForHumans() }} 
                        <a href="#">{{ $thread->creator->name }}</a>
                    </p>
              </div>
            </div>
         </div>
    </div>
</div>

@endsection
