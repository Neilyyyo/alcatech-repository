<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Loading spinner */
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #FF6F00; /* Orange color */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Custom styles for the background and content */
        .bg-main {
            background-color: #ffffff; /* White background */
        }

        .btn-primary {
            background-color: #FF6F00; /* Orange */
            color: white;
        }

        .btn-primary:hover {
            background-color: #E65C00; /* Slightly darker orange */
        }
    </style>
</head>
<body class="bg-main min-h-screen flex items-center justify-center">

    <!-- Loading spinner -->
    <div id="loadingSpinner" class="spinner absolute top-0 left-0 right-0 bottom-0 mx-auto my-auto z-50 flex items-center justify-center"></div>

    <!-- Auto-Redirect for Logged-In User -->
    @if(auth()->check())
        <script>
            window.location.href = "{{ route('dashboard') }}";  // Redirect to dashboard if logged in
        </script>
    @endif

    <!-- Main Content Container -->
    <div class="text-center w-full max-w-lg mx-auto px-6 py-12">
        <!-- Logo Holder -->
        <div class="mb-8">
            <img src="https://via.placeholder.com/150" alt="Logo" class="mx-auto">
        </div>

        <!-- Welcome Card -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full border border-orange-500">
            <h2 class="text-4xl font-bold text-orange-600 mb-6">Welcome to My Application</h2>

            @auth
                <p class="text-xl text-gray-700 mb-4">Hello, <span class="font-semibold">{{ auth()->user()->name }}</span>! You are logged in.</p>
            @else
                <p class="text-xl text-gray-700 mb-4">Please <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-700 font-semibold">Login</a> or <a href="{{ route('register') }}" class="text-orange-500 hover:text-orange-700 font-semibold">Register</a> to continue.</p>
            @endauth

            <!-- Button for Login/Register -->
            @guest
                <div class="mt-4 space-x-4">
                    <a href="{{ route('login') }}" class="btn-primary py-2 px-6 rounded-lg shadow-md transition duration-300">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary py-2 px-6 rounded-lg shadow-md transition duration-300">Register</a>
                </div>
            @endguest
        </div>
    </div>

    <script>
        // Show the loading spinner when the page is loading
        window.addEventListener('load', function() {
            const loadingSpinner = document.getElementById('loadingSpinner');
            loadingSpinner.style.display = 'none';  // Hide spinner once the page has loaded
        });

        // Optional: Show the spinner while navigating between pages (via links, for example)
        const links = document.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const loadingSpinner = document.getElementById('loadingSpinner');
                loadingSpinner.style.display = 'flex';  // Show spinner on link click
            });
        });
    </script>

</body>
</html>
