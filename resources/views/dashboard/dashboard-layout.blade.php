@vite(['resources/scss/app.scss', "resources/js/collapseSection.js"])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Document</title>
</head>

<body>
    <main class="dashboard">
        <x-dashboard.flash-message />

        @yield('dashboard')

    </main>
</body>

</html>