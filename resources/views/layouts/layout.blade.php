<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Use of the stack direct to allow js for child views -->
    @stack('scripts')
    <title>Blog App</title>
</head>

<body>
    <header>
        <!-- Use of guest Directive to display corresponding nav for user or guest -->
        <!-- Use include directive to include corresponding components -->
        @guest
            @include('components.nav')
        @else
            @include('components.user.nav')
        @endguest
    </header>

    <main>
        <!-- Use of yield directive to let child views to handle content display -->
        @yield('content')
    </main>
    <!-- Letting Child Views Handle Footer: Should Handle it Here in the main layout -->
    @include('components.footer')
</body>

</html>