<x-app-layout>
 <x-slot name="header"><h2 class="text-xl font-semibold">Add Student</h2></x-slot>
 <div class="p-4">
  <form action="{{ route('students.store') }}" method="POST">
    @include('students._form')
  </form>
 </div>
</x-app-layout>
