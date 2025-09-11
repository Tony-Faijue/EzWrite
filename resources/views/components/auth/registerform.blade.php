<div class="bg-grad-4">
    <div class="user-form-bg">
        <h1 class="heading-form-title">Create an Account</h1>
        <!-- Form for user to register -->
        <!-- Action calls the register fucntion of the register route -->
        <form id="registerForm" name="registerForm" method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <!--UserName-->
            <div>
                <label for="name" class="block label-form mb-1">Username</label>
                <input type="text" id="name" name="name" placeholder="Username" required
                    class="input-form input-form-focus" />
            </div>
            <!--FirstName-->
            <div>
                <label for="firstname" class="block label-form mb-1">Firstname</label>
                <input type="text" id="firstname" name="firstname" placeholder="Firstname" required
                    class="input-form input-form-focus" />
            </div>
            <!--LastName-->
            <div>
                <label for="lastname" class="block label-form mb-1">Lastname</label>
                <input type="text" id="lastname" name="lastname" placeholder="Lastname" required
                    class="input-form input-form-focus" />
            </div>
            <!--Email-->
            <div>
                <label for="email" class="block label-form mb-1">Email</label>
                <input type="text" id="email" name="email" placeholder="youremail@example.com" required
                    class="input-form input-form-focus" />
            </div>
            <!--Passowrd-->
            <div>
                <label for="password" class="block label-form mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required
                    class="input-form input-form-focus" />
            </div>
            <!--Submit Button-->
            <div class="flex justify-center">
                <button class="auth-btn">Signup</button>
            </div>
            <!--Login Redirect-->
            <div>
                <p class="text-center text-sm text-sky-900 mt-2">
                    Already have an account? <a href="{{ route('login') }}"
                        class="text-purple-600 font-medium hover:underline">Login</a>
                </p>
            </div>
            <div class="text-center">
                @if($errors->any())
                    <ul class="text-red-600 text-md">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </form>
    </div>
</div>