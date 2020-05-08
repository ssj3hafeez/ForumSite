<div class="card">

    <div class="card-header">
       <a href= "/profiles/{{$reply->owner->name }}">
           {{ $reply->owner->name }} 
       </a> replied {{ $reply->created_at->diffForHumans() }}...
    </div> 

    <div class="card-body">
        {{ $reply->body }}
    </div>
    
 
    <div class="panel-footer">
    <form method="POST" action="/replies/{{ $reply->id }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type ="submit" class= "btn-danger btn-xs">Delete</button>

    </form>
    </div>




</div>