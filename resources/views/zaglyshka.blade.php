<!DOCTYPE html>
<html>
<head>
	<title>Promise</title>
</head>
<body>
	<form  method="POST" action="{{ route('conTest.update', ['contr' => $content['id']]) }}">
	@method('PATCH') 
	@csrf

	@if($errors->any()) 
	 <div style="color:red;">{{ $errors->first() }}</div>
	@endif
		
	<input type="text" name="title" value="{{$content['title']}}">
                	
	<input class="btn btn-primary" type="submit" name="knopka" value="Изменить">
	
	</form>
</body>
</html>