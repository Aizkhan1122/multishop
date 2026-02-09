<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('admin-assets/dist/assets/favicon-CvUZKS4z.svg')}}">
    <link rel="icon" type="image/png" href="{{ asset('admin-assets/dist/assets/favicon-B_cwPWBd.png')}}">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/dist/assets/main-DLfE7m78.css') }}">

    <!-- PWA Manifest -->
    <link rel="manifest" href="{{ asset('admin-assets/dist/assets/manifest-DTaoG9pG.json') }}">

    {{-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script> --}}



</head>
<body data-page="@yield('page', 'dashboard')">

    <div class="admin-app">
        <!-- Header -->
        @include('admin.partials.header')

        <!-- Sidebar -->
        @include('admin.partials.sidebar')

        <!-- Main Content -->
        <main class="admin-main">
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        @include('admin.partials.footer')
    </div>



    <!-- Alpine.js (must be loaded AFTER themeSwitch) -->
    <!-- Dark Mode Logic -->
    <script>
        const themeSwitch = {
            currentTheme: localStorage.getItem('theme') || 'light',

            // Called on page load
            init() {
                if (this.currentTheme === 'dark') {
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                } else {
                    document.documentElement.removeAttribute('data-bs-theme');
                }
            },

            // Called when button is clicked
            toggle() {
                if (this.currentTheme === 'light') {
                    this.currentTheme = 'dark';
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                } else {
                    this.currentTheme = 'light';
                    document.documentElement.removeAttribute('data-bs-theme');
                }
                localStorage.setItem('theme', this.currentTheme);
            }
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Bootstrap Bundle with Popper (needed for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS -->
    <script src="{{ asset('admin-assets/js/main.js') }}"></script>

    <!-- Test script for debugging icons and JS -->
    <script src="{{ asset('admin-assets/js/test-icons.js') }}"></script>

    <script>
        // Example: hamburger menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById("menuBtn");
            if (menuBtn) {
                menuBtn.addEventListener("click", function() {
                    document.querySelector(".admin-sidebar") ? .classList.toggle("show");
                });
            }
        });

    </script>

</body>
</html>
