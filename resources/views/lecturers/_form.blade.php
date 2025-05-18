@csrf
@php
    // True only when we’re editing a stored record
    $editing = $lecturer->exists ?? false;
@endphp

<div class="space-y-4">
    <div>
        <x-input-label for="name" value="Name"/>
        <x-text-input id="name" name="name" class="w-full"
                      value="{{ old('name', $lecturer->name) }}" required/>
    </div>

    <div>
        <x-input-label for="email" value="Email"/>
        <x-text-input id="email" name="email" type="email" class="w-full"
                      value="{{ old('email', $lecturer->email) }}" required/>
    </div>

    <div>
        <x-input-label for="password" value="Password"/>
        <x-text-input id="password" name="password" type="password" class="w-full" required/>
    </div>

    <div>
        <x-input-label for="password_confirmation" value="Confirm Password"/>
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="w-full" required/>
    </div>
</div>

<x-primary-button class="mt-4">
    {{ $editing ? 'Update' : 'Save' }}
</x-primary-button>
