<x-app-layout>
 <x-slot name="header">
   <h2 class="text-xl font-semibold">Edit Course</h2>
 </x-slot>

 <div class="p-4 space-y-8">
   {{-- ===== course details form ===== --}}
   <form action="{{ route('courses.update', $course) }}" method="POST" class="space-y-6">
     @csrf @method('PUT')
     @include('courses._form')   {{-- title / desc / lecturer dropdown --}}
     <x-primary-button>Save Course</x-primary-button>
   </form>

   {{-- ===== enrolment form ===== --}}
   <form action="{{ route('enrolments.store', $course) }}" method="POST">
     @csrf
     @include('courses._enrol_form')
   </form>
 </div>
</x-app-layout>
