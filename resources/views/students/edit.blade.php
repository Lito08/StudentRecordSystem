<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Student</h2>
    </x-slot>

    <div class="p-4">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')
            @include('students._form')   {{-- uses the shared form --}}
        </form>
    </div>
</x-app-layout>
