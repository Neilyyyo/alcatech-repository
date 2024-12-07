<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlcaTech</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Loading spinner */
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #9b59b6;
            /* Elegant purple */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Custom styles for the background and content */
        .bg-main {
            background-color: #f8f8f8;
            /* Light background */
        }

        .btn-primary {
            background-color: #9b59b6;
            /* Elegant purple */
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #8e44ad;
            /* Darker purple for hover */
        }

        /* Consistent font */
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Card styling */
        .card {
            background-color: #ffffff;
            /* White card background */
            color: #6c4f9c;
            /* Elegant purple text */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            border: 2px solid #9b59b6;
            /* Purple border for the card */
        }

        .btn-white {
            background-color: #ffffff;
            /* White background */
            color: #6c4f9c;
            /* Elegant purple text */
            border: 2px solid #6c4f9c;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            text-align: center;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-white:hover {
            background-color: #f0e5f9;
            /* Light purple for hover */
            color: #9b59b6;
        }

        .text-primary {
            color: black;
            /* Elegant purple text */
        }

        .text-secondary {
            color: gray;
            /* Slightly darker purple text */
        }

        /* Spin effect for logo */
        .logo-bounce:hover {
    animation: bounce 1s ease-in-out;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    25% {
        transform: translateY(-10px);
    }
    50% {
        transform: translateY(0);
    }
    75% {
        transform: translateY(-5px);
    }
}

    </style>
</head>

<body class="bg-main min-h-screen flex flex-col justify-center"> <!-- Changed to flex column to stack logo and card -->

    <!-- Auto-Redirect for Logged-In User -->
    @if(auth()->check())
    <script>
        window.location.href = "{{ route('dashboard') }}"; // Redirect to dashboard if logged in
    </script>
    @endif

    <!-- Main Content Container -->
    <div class="w-full max-w-lg mx-auto px-6 py-12 flex flex-col items-center"> <!-- Centered content -->
        <!-- Logo Holder -->
        <div class="mb-4">
            <a href="/">
                <img src="{{ asset('logo/ALCALOGO.png') }}" alt="Logo" class="mx-auto max-w-xs logo-bounce">
            </a>
        </div>
        
        <p>The No.1 Boarding House Management System at Alcate, Victoria Oriental Mindoro</p>

        <!-- Welcome Card -->
        <div class="card mt-4"> <!-- Reduced margin-top -->
            <h2 class="text-4xl font-bold text-primary mb-4">Welcome to ALCATECH</h2>

            @auth
            <p class="text-xl text-secondary mb-4">Hello, <span class="font-semibold">{{ auth()->user()->name }}</span>! You are logged in.</p>
            @else
            <p class="text-xl text-secondary mb-4">Please <a href="{{ route('login') }}" class="text-primary hover:text-secondary font-semibold">Login</a> or <a href="{{ route('register') }}" class="text-primary hover:text-secondary font-semibold">Register</a> to continue.</p>
            @endauth

            <!-- Button for Login/Register -->
            @guest
            @endguest
        </div>

    </div>
</body>

</html>
