@extends('layouts.app')

<head>
	<title>Create</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

@section('content')

	@if ($message = Session::get('success'))

        <div>
                <strong>{{ $message }}</strong>

        </div>
        @endif

     @if (count($errors) > 0)
            <div>
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                  @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif  
    @auth   
    @if (Auth::user()->can('create-photo'))    
      
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create') }}</div>
                    <div class="card-body">

                            <form class="" action="{{ route('conTest.store') }}" method="POST" enctype="multipart/form-data">  
                            @csrf  
                                    
                                        <div>
                                            <input class="form-control-file" type="file" name="photo">
                                        </div>
                                        
                                            <p> </p>

                                <div class="form-group row">
                                 <div class="col-md-6">    
                            	<input type="text" name="title" value="untitled">
                                </div>
                                </div>

                            	<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            		<!--<div class="form-group row mb-0">
                                     <div class="col-md-8 offset-md-4">-->
                                         <input class="btn btn-primary" type="submit" name="knopka" value="Upload">
                                    <!--</div>
                                 </div>-->
                            </form> 
                    </div>
            </div>
        </div>
    </div>
</div>  


    @else 
    <h1>You must be a user</h1>
    @endif
    @endauth  

    @endsection