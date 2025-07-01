<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Logout
            </button>
    </header>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{-- <x-welcome /> --}}
                    <h2>User Courses </h2>
                    <ul>
                        @foreach($purchasedCourses as $purchasedCourse)
                        <li>{{$purchasedCourse->title}}</li>
                        <a href="{{route('pages.course-videos', $purchasedCourse)}}">Watch Videos</a>
                        @endforeach
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
