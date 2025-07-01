
<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    {{-- @foreach($video as $video) --}}
    <iframe src="https://player.vimeo.com/video/{{$video->vimeo_id}}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        <h3>{{$video->title}}</h3>
        <p>{{$video->getReadableDuration()}}</p>
        <p>{{$video->description}}</p>
        @if($video->alreadyWatchedByCurrentUser())
        <button wire:click="markVideoAsNotCompleted">Mark as  not completed</button>
        @else
        <button wire:click="markVideoAsCompleted">Mark as completed</button>
        @endif
    {{-- @endforeach --}}

    <ul>
        @foreach($courseVideos as $courseVideo)
                <li>
                    @if($this->isCurrentVideo(videoToCheck:$courseVideo))
                            {{$courseVideo->title}}
                    @else
                            <a href="{{route('pages.course-videos',[$courseVideo->course, $courseVideo])}}">
                                {{$courseVideo->title}}
                            </a>
                    @endif
                </li>

                {{-- <li>

                            <a href="{{route('pages.course-videos',$courseVideo->course)}}">
                                {{$courseVideo->getReadableDuration()}}
                            </a> --}}

        @endforeach
    </ul>
</div>
