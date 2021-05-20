@extends('layouts.app')

<head>
	<title>Edit</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit') }}</div>
					<div class="card-body">
					<form class="form-inline" method="POST" action="{{ route('conTest.update', ['contr' => $content['id']]) }}">
						@method('PATCH') 
						@csrf

						@if($errors->any()) 
					    <div style="color:red;">{{ $errors->first() }}</div>
						@endif
						 <div class="form-group row">
                            <div class="col-md-6">
						<input type="text" name="title" value="{{$content['title']}}">
						</div>
                    </div>

                    	<div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
						<input class="btn btn-primary" type="submit" name="knopka" value="Изменить">
					</div>
				</div>
					</form>
				 </div>
            </div>
        </div>
    </div>
</div>	


@endsection