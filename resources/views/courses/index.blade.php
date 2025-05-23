<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Courses</h2>
    </x-slot>

    <div class="p-4">
        {{-- admin-only “+ Add” button --}}
        @role('admin')
            <a href="{{ route('courses.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded">
               + Add
            </a>
        @endrole

        @if (session('success'))
            <p class="text-green-600 mt-2">{{ session('success') }}</p>
        @endif

        <table class="mt-4 w-full bg-white shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 text-left">Course</th>
                    <th>Lecturer</th>
                    <th class="w-40"></th>
                </tr>
            </thead>

            <tbody>
            @foreach ($courses as $c)
                <tr class="border-t">
                    {{-- Course column --}}
                    <td class="px-3 py-2">
                        @role('lecturer')
                            <a href="{{ route('grades.sheet', $c) }}"
                               class="text-indigo-600 hover:underline">
                                {{ $c->course_name }}
                            </a>
                        @else
                            {{ $c->course_name }}
                        @endrole
                    </td>

                    {{-- Lecturer name --}}
                    <td>{{ $c->lecturer->name ?? '-' }}</td>

                    {{-- Action column --}}
                    <td class="px-2">
                        @role('admin')
                            <a href="{{ route('courses.edit', $c) }}"
                               class="text-blue-600">Edit</a>

                            <form action="{{ route('courses.destroy', $c) }}"
                                  method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600 ml-2"
                                        onclick="return confirm('Delete?')">
                                    Del
                                </button>
                            </form>
                        @else
                            <a href="{{ route('grades.sheet', $c) }}"
                               class="text-indigo-600">Mark&nbsp;Sheet</a>
                        @endrole
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $courses->links() }}
    </div>
</x-app-layout>
