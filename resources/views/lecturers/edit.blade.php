<x-app-layout>
<x-slot name="header"><h2 class="text-xl font-semibold">Edit Lecturer</h2></x-slot>
<div class="p-4">
 <form action="{{ route('lecturers.update',$lecturer) }}" method="POST">
  @csrf @method('PUT') @include('lecturers._form')
 </form>
</div>
</x-app-layout>
