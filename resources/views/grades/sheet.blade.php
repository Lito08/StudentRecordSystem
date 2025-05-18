<x-app-layout>
 <x-slot name="header">
   <h2 class="text-xl font-semibold">{{ $course->course_name }} — Mark Sheet</h2>
 </x-slot>

 <div class="p-4">
  @if(session('success'))
     <p class="text-green-600 mb-3">{{ session('success') }}</p>
  @endif

  <form action="{{ route('grades.saveSheet', $course) }}" method="POST">
    @csrf

    <table class="w-full bg-white shadow rounded">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-3 py-2 text-left">Student</th>
          <th class="w-32">Grade</th>
        </tr>
      </thead>
      <tbody>
      @foreach($students as $st)
        <tr class="border-t">
          <td class="px-3 py-2">{{ $st->name }}</td>
          <td>
            <select name="grades[{{ $st->id }}]" class="w-full rounded bg-gray-50">
              @foreach(['A','B','C','D','F'] as $letter)
                <option value="{{ $letter }}"
                        @selected(($grades[$st->id] ?? '') === $letter)>
                    {{ $letter }}
                </option>
              @endforeach
            </select>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    <x-primary-button class="mt-4">Save All</x-primary-button>
  </form>
 </div>
</x-app-layout>
