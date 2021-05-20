<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

<style>
	img {
    max-width: 50%;
    max-height: 50%;
}

.portrait {
    height: 50%;
    width: 50%;
}

#navbar {
  border-top-style: none;
  border-right-style: none;
  border-bottom-style: solid;
  border-left-style: none;
  border-color: #145afc;
}

.example::-webkit-scrollbar {
  display: none;
}

#sidebar {
  min-width: 250px;
  max-width: 250px;
  border-top-style: none;
  border-right-style: none;
  border-bottom-style: solid;
  border-left-style: none;
  border-color: #145afc;
}

li {
    list-style-type: none;
   }

ul {
    padding-left: 10px;
   }
	</style>
	<title>Asiec Project</title>
</head>
<body class="example">
	<nav id="navbar" class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button class="btn btn-link" id="toggle">ASIEC Project</button>
      </div>
    @auth
    @if (Auth::user()->can('create-photo'))

    <div>
       <ul class="nav nav-pills">
         <li class="nav-item">
          <a class="nav-link" href="{{ route('conTest.create') }}">Добавить</a>
        </li>
         <li class="nav-item">
          @if ($isActive)
          <a class="nav-link active" href="{{route('conTest.index')}}">Главная</a>
          @else
          <a class="nav-link" href="{{route('conTest.index')}}">Главная</a>
          @endif
        </li>
        @if ($isActive === 0)
        <li class="nav-item">
          <a class="nav-link active" href="{{route('conUse.index')}}">Пользователи</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{route('conUse.index')}}">Пользователи</a>
        </li>
        @endif
       </ul>
     </div>

    @endauth

     @else
     <div>
       <ul class="nav nav-pills">
         <li class="nav-item">
          @if ($isActive)
          <a class="nav-link active" href="{{route('conTest.index')}}">Главная</a>
          @else
          <a class="nav-link" href="{{route('conTest.index')}}">Главная</a>
          @endif
        </li>
        @if ($isActive === 0)
        <li class="nav-item">
          <a class="nav-link active" href="{{route('conUse.index')}}">Пользователи</a>
        </li>
        @else
         <li class="nav-item">
          <a class="nav-link" href="{{route('conUse.index')}}">Пользователи</a>
        </li>
        @endif
         <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">Войти</a>
        </li>
       </ul>
     </div>

    @endif
    <p><form class="form-inline" method="GET" action="{{route('search.index')}}">
      @csrf
      <div class="mb-2">
      <select class="form-control form-control-sm" id='suppiler' name="choice">
    <option value="false">Photos</option>
    <option value="true">User</option>
      </select>
      </div>

      <div class="form-group mb-2">
      <input type="text" name="search">
      </div>

      <div class="form-group mx-sm-3">
      <input class="btn btn-primary mb-2" type="submit" name="knopochka" value="Найти">
      </div>
    </form>
  </p>
</div>
  </nav>

<div class="container">
  <div class="row">
  @auth
  <div class="col-lg-3">
  <nav id="sidebar">
    <div class="sidebar-header">
            <h3>{{ Auth::user()->name}}</h3>
        </div>
        <ul>
          <li class="nav-item">
            <form method="GET" action="{{route('conUse.show', ['user' => Auth::user()->id])}}">
              @csrf
              <input class="btn btn-primary mb-2" type="submit" name="submit" value="Мои фото">
            </form>
          </li>

          <li class="nav-item">
            <form method="POST" action="{{route('logout')}}">
            @csrf
            <input class="btn btn-primary mb-2" type="submit" name="knopka" value="Выйти">
           </form>
          </li>

          <li class="nav-item">
            <form method="POST" action="{{route('conUse.destroy', ['user' =>  Auth::user()->id])}}">
              @method('DELETE')
              @csrf
              <input class="btn btn-primary mb-2" type="submit" name="submit" value="Удалить аккаунт">
            </form>
          </li>
        </ul>
  </nav>
</div>
  @endauth

  <div class="col-lg-9">
	 @if ($paginator != false)
   @foreach ($paginator as $con)
   @if ($isUs)
   <div class="user"><a href="{{route('conUse.show', ['user' => $con->id])}}">{{$con->name}}</a></div>
   @else
   <div class="portrait">
    <p><h1>{{ $con->title }}</h1></p>
    <a href="{{route('conTest.show', ['contr' => $con->id])}}">
      <img src="{{ URL::asset($con->photo) }}", alt="roki">
   </a>
   </div>
   @endif
   @endforeach
   @else
   <h1>Ничего не найдено</h1>
   @endif

   @if ($paginator != false)
  <p> {{ $paginator->links() }} </p>
   @endif
   </div>

 </div>
</div>

   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>
</html>