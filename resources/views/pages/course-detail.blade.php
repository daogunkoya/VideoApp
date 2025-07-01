<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>{{$course->title}}</h1>
    <p>{{$course->description}}</p>
    <p>{{$course->tagline}}</p>
    <img src="{{asset("images/$course->image_name")}}" alt="{{$course->title}}">

    <ul>
        @foreach($course->learnings as $learning)
            <li>{{$learning}}</li>
        @endforeach
    </ul>

    <ul>
        <h3>Total videos: {{$course->videos_count}}</h3>
        @foreach($course->videos as $video)
            <li>{{$video->title}}</li>
        @endforeach
    </ul>
    
</body>
</html>