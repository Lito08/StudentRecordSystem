<x-app-layout>
 <x-slot name="header"><h2 class="font-semibold text-xl">My Grades</h2></x-slot>

 <div class="p-4">
  <table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100"><tr><th class="px-3 py-2 text-left">Course</th><th>Grade</th></tr></thead>
    <tbody>
    @foreach($grades as $g)
      <tr class="border-t">
        <td class="px-3 py-2">{{ $g->course->course_name }}</td>
        <td>{{ $g->grade }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
 </div>
</x-app-layout>
