<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Add Lecturer</h2></x-slot>
<div class="p-4"><form action="{{ route('lecturers.store') }}" method="POST">@include('lecturers._form')</form></div>
</x-app-layout>
