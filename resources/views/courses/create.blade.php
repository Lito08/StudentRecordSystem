<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Add Course</h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('courses.store') }}" method="POST" class="space-y-6">
            @include('courses._form')   {{-- shared form --}}
        </form>
    </div>
</x-app-layout>
