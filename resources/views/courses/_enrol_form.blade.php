<h3 class="mt-8 font-semibold">Enrolled Students</h3>

<div class="border rounded p-3 max-h-56 overflow-y-auto grid grid-cols-2 gap-2">
 @foreach ($allStudents as $stu)
   <label class="flex items-center space-x-2 text-sm">
     <input type="checkbox" name="student_ids[]"
            value="{{ $stu->id }}"
            @checked($course->students->contains($stu->id))>
     <span>{{ $stu->name }}</span>
   </label>
 @endforeach
</div>

<x-primary-button class="mt-3">Update Enrolments</x-primary-button>
