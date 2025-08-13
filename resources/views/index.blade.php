<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dunia Busana Tailor - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        .logo-container {
            transition: transform 0.3s ease;
        }
        .logo-container:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-900">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="logo-container flex justify-center">
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/9bf7ca9d-e243-4981-b425-7d925d0fd0d4.png"
                     alt="Dunia Busana Tailor logo"
                     class="h-44 w-44 rounded-full border-[6px] border-white shadow-xl ring-4 ring-blue-100/50">
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Dunia Busana Tailor
            </h2>
            <p class="mt-2 text-center text-sm text-white/80">
                Exclusive tailoring service since 1985
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-gray-800 py-10 px-8 shadow-xl rounded-2xl border border-gray-700">
                <form class="mb-0 space-y-6" id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">
                            Email address
                        </label>
                        <div class="mt-1 relative">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full px-5 py-4 border-2 border-gray-600 rounded-xl shadow-sm placeholder-gray-400
                                focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all duration-300">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-300"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-300"></i>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember_me" type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-4 px-6 border border-transparent rounded-xl shadow-lg
                            text-base font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 ease-in-out">
                            Sign in
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-800 text-gray-400">
                                New to Dunia Busana?
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="#" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm
                            text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2
                            focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            Create an account
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('remember-me').checked;

            // Here you would typically make an API call to Laravel backend
            console.log('Login attempt with:', { email, password, rememberMe });

            // Show loading state
            const submitBtn = e.target.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Signing in...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                submitBtn.innerHTML = 'Sign in';
                submitBtn.disabled = false;

                // Show success/error message (in a real app, handle response from server)
                alert('Login form submitted successfully (this is a demo)');
            }, 1500);
        });
    </script> --}}
</body>
</html>
