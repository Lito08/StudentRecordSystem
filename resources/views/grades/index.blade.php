<x-app-layout>
 <x-slot name="header">
  <h2 class="text-xl font-semibold">{{ $course->course_name }} — Grades</h2>
 </x-slot>

 <div class="p-4">
  @if(session('success'))<p class="text-green-600 mb-2">{{ session('success') }}</p>@endif

  {{-- quick add / update --}}
  <form action="{{ route('grades.store',$course) }}" method="POST" class="flex space-x-2 mb-4">
    @csrf
    <select name="student_id" class="rounded">
      @foreach($students as $st)
        <option value="{{ $st->id }}">{{ $st->name }}</option>
      @endforeach
    </select>
    <x-text-input name="grade" class="w-20 text-center" placeholder="A+" required/>
    <x-primary-button>Save</x-primary-button>
  </form>

  <table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100"><tr><th class="px-3 py-2 text-left">Student</th><th>Grade</th></tr></thead>
    <tbody>
    @foreach($grades as $g)
      <tr class="border-t">
        <td class="px-3 py-2">{{ $g->student->name }}</td>
        <td>{{ $g->grade }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
 </div>
</x-app-layout>
