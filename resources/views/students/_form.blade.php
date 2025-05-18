@csrf
@php  $editing = $student->exists;  @endphp

<div class="grid grid-cols-2 gap-4">
    <!-- Name -->
    <div>
        <x-input-label for="name" value="Name"/>
        <x-text-input id="name" name="name" class="w-full"
                      value="{{ old('name', $student->name) }}" required/>
        <x-input-error :messages="$errors->get('name')"/>
    </div>

    <!-- Email -->
    <div>
        <x-input-label for="email" value="Email"/>
        <x-text-input id="email" name="email" type="email" class="w-full"
                      value="{{ old('email', $student->email) }}" required/>
        <x-input-error :messages="$errors->get('email')"/>
    </div>

    <!-- DOB -->
    <div>
        <x-input-label for="date_of_birth" value="DOB"/>
        <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="w-full"
                      value="{{ old('date_of_birth', $student->date_of_birth) }}"/>
    </div>

    <!-- Phone -->
    <div>
        <x-input-label for="phone" value="Phone"/>
        <x-text-input id="phone" name="phone" class="w-full"
                      value="{{ old('phone', $student->phone) }}"/>
    </div>

    <!-- Address -->
    <div class="col-span-2">
        <x-input-label for="address" value="Address"/>
        <textarea id="address" name="address" rows="2"
                  class="w-full rounded">{{ old('address', $student->address) }}</textarea>
    </div>

    <!-- Password (only required on create) -->
    <div>
        <x-input-label for="password" value="Password"/>
        <x-text-input id="password" name="password" type="password" class="w-full" required/>
        <x-input-error :messages="$errors->get('password')"/>
    </div>

    <!-- Confirm Password -->
    <div>
        <x-input-label for="password_confirmation" value="Confirm Password"/>
        <x-text-input id="password_confirmation" name="password_confirmation"
                      type="password" class="w-full" required/>
    </div>
</div>

<x-primary-button class="mt-4">
    {{ $editing ? 'Update' : 'Save' }}
</x-primary-button>
