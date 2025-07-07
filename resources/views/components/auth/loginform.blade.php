<div class="bg-grad-1">
    <div class="user-form-bg">
        <h1 class="heading-form-title">Login</h1>
        <form id="loginForm" name="loginForm" method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div class="grid gap-4">
                <div class="grid grid-cols-1 gap-4">
                    <!--Email-->
                    <div class="flex items-center space-x-4">
                        <label for="email" class="label-form w-32 text-right">Email</label>
                        <input type="email" id="email" name="email" placeholder="youremail@example.com" required
                            class="input-form input-form-focus" />
                    </div>
                    <!--Password-->
                    <div class="flex items-center space-x-4">
                        <label for="password" class="label-form w-32 text-right">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your Password" required
                            class="input-form input-form-focus" />
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="auth-btn">Login</button>
                </div>
            </div>
            <!--SignUp Redirect-->
            <div>
                <p class="text-center text-sm text-gray-600 mt-2">
                    Don't have an account? <a href="{{ route('register') }}"
                        class="text-blue-600 font-medium hover:underline">SignUp</a>
                </p>
            </div>
        </form>
    </div>
</div>