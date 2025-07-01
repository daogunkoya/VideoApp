<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>


<body>
    <header>
        @guest
        <a href="{{route('login')}}">Login</a>
        @endguest
        @auth
        <a href="{{route('logout')}}">Logout</a>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @endauth
    </header>
    <main> 
        @foreach($courses as $course)
            <h1>{{$course->title}}</h1>
            <p>{{$course->description}}</p>
            @endforeach
    </main>
</body>
</html>