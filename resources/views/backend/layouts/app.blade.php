<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <!-- Include CSS stylesheets or CDN links here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <header>
        <!-- Navigation bar or header content -->
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <!-- Add more navigation links if needed -->
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content -->
        <p>&copy; {{ date('Y') }} My Laravel App</p>
    </footer>

    <!-- Include JavaScript files or CDN links here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
