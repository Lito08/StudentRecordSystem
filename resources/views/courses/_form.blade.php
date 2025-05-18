@csrf
<div class="space-y-4">
  <div>
    <x-input-label for="course_name" value="Course Name"/>
    <x-text-input id="course_name" name="course_name" class="w-full"
                  value="{{ old('course_name',$course->course_name) }}" required/>
    <x-input-error :messages="$errors->get('course_name')"/>
  </div>

  <div>
    <x-input-label for="lecturer_id" value="Lecturer"/>
    <select id="lecturer_id" name="lecturer_id" class="w-full rounded">
      @foreach($lecturers as $id=>$name)
        <option value="{{ $id }}"
          @selected(old('lecturer_id',$course->lecturer_id)==$id)>{{ $name }}</option>
      @endforeach
    </select>
    <x-input-error :messages="$errors->get('lecturer_id')"/>
  </div>

  <div>
    <x-input-label for="course_description" value="Description"/>
    <textarea id="course_description" name="course_description" rows="3"
              class="w-full rounded">{{ old('course_description',$course->course_description) }}</textarea>
  </div>
</div>
<x-primary-button class="mt-4">{{ $course->exists ? 'Update' : 'Save' }}</x-primary-button>
