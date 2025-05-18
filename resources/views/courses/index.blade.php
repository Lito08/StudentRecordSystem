<x-app-layout>
 <x-slot name="header"><h2 class="font-semibold text-xl">Courses</h2></x-slot>

 <div class="p-4">
    @role('admin')
        <a href="{{ route('courses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">+ Add</a>
    @endrole

  @if(session('success'))<p class="text-green-600 mt-2">{{ session('success') }}</p>@endif

  <table class="mt-4 w-full bg-white shadow rounded">
    <thead class="bg-gray-100">
      <tr><th class="px-3 py-2 text-left">Course</th><th>Lecturer</th><th></th></tr>
    </thead>
    <tbody>
    @foreach ($courses as $c)
        <tr class="border-t">
            <td class="px-3 py-2">
                {{-- Course name clickable for lecturers --}}
                @role('lecturer')
                    <a href="{{ route('grades.index', $c) }}"
                    class="text-indigo-600 hover:underline">
                    {{ $c->course_name }}
                    </a>
                @else
                    {{ $c->course_name }}
                @endrole
            </td>

            <td>{{ $c->lecturer->name ?? '-' }}</td>

            <td class="px-2">
                @role('admin')
                    <a href="{{ route('courses.edit', $c) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('courses.destroy', $c) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete?')" class="text-red-600 ml-2">Del</button>
                    </form>
                @else
                    <a href="{{ route('grades.index', $c) }}" class="text-indigo-600">Grades</a>
                @endrole
            </td>
        </tr>
    @endforeach
    </tbody>
  </table>

  {{ $courses->links() }}
 </div>
</x-app-layout>
