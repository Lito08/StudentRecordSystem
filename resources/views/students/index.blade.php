<x-app-layout>
 <x-slot name="header"><h2 class="font-semibold text-xl">Students</h2></x-slot>

 <div class="p-4">
  <a href="{{ route('students.create') }}"
     class="px-4 py-2 bg-indigo-600 text-white rounded">+ Add</a>

  @if(session('success'))
    <p class="text-green-600 mt-2">{{ session('success') }}</p>
  @endif

  <table class="mt-4 w-full bg-white shadow rounded">
   <thead class="bg-gray-100">
    <tr><th class="px-3 py-2 text-left">Name</th><th>Email</th><th></th></tr>
   </thead>
   <tbody>
   @foreach($students as $s)
    <tr class="border-t">
      <td class="px-3 py-2">{{ $s->name }}</td>
      <td>{{ $s->email }}</td>
      <td class="px-2">
        <a href="{{ route('students.edit',$s) }}" class="text-blue-600">Edit</a>
        <form action="{{ route('students.destroy',$s) }}" method="POST" class="inline">
          @csrf @method('DELETE')
          <button onclick="return confirm('Delete?')" class="text-red-600 ml-2">Del</button>
        </form>
      </td>
    </tr>
   @endforeach
   </tbody>
  </table>

  {{ $students->links() }}
 </div>
</x-app-layout>
