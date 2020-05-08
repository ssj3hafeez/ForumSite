@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Threads</div>

                <div class="card-body">
                    <form method="POST" action="/threads">
                       {{csrf_field() }}

                       <div class="form-group">
                           <label for="catergories_id">Choose Catergory</label>
                          <select name="catergories_id" id="catergories_id" class="form-control" required>
                            <option value=""> Choose One... </option>

                            @foreach (App\Catergories::all() as $catergories)
                            <option value=" {{ $catergories->id }}" {{ old( 'catergories_id') == $catergories->id ? 'selected' : ''}}> 
                            {{ $catergories->name }}</option>
                            @endforeach

                       </select>
                       </div>
                       
                        <div class="form-group">
                            <label for ="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" 
                        value="{{ old('title') }}" required>
                        </div>


                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea name="body" id="body" class="form-control" rows="8"> {{old('body') }}</textarea>
                        </div> 
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Publish</button> 
                        </div>

                        @if(count($errors))
                            <ul class="alrt alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif  
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
