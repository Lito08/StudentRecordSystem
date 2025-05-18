<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Course</h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('courses.update', $course) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            @include('courses._form')   {{-- shared form --}}
        </form>
    </div>
</x-app-layout>
