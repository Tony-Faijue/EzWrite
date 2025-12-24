@extends('layouts.layout')

@section('content')
    <div class="bg-grad-2 flex">
        <!-- Error Handling -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- import user side-nav and user dashboard component -->
        <x-user.side-nav />
        <div class="user-form-bg mx-auto mt-10 mb-10">
            <!-- Form for user to update the user profile -->
            <form action="{{ route('user-profile-update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h2 class="text-4xl text-center">
                            User Profile
                        </h2>
                        <!-- UserName -->
                        <div>
                            <label for="name" class="block label-form mb-1">Username</label>
                            <input type="text" id="name" name="name" placeholder="Username"
                                class="input-form input-form-focus" value="{{ old('name', $user->name) }}" />
                        </div>
                        <!-- FirstName -->
                        <div>
                            <label for="firstname" class="text-2xl">Firstname</label>
                            <input type="text" id="firstname" name="firstname" placeholder="Firstnaem"
                                class="input-form input-form-focus" value="{{ old('firstname', $user->firstname) }}" />
                        </div>
                        <!-- LastName -->
                        <div>
                            <label for="lastname" class="text-2xl">Lastname</label>
                            <input type="text" id="lastname" name="lastname" placeholder="Lastname"
                                class="input-form input-form-focus" value="{{ old('lastname', $user->lastname) }}" />
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email" class="text-2xl">Email</label>
                            <input type="text" id="email" name="email" placeholder="Email"
                                class="input-form input-form-focus" value="{{ old('email', $user->email) }}" />
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="text-2xl">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password"
                                class="input-form input-form-focus" />
                        </div>
                        <!-- Re-Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="text-2xl">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Password" class="input-form input-form-focus" />
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-center">
                            <button class="auth-btn">Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection