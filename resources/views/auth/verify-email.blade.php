<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - ApnaPanda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-orange-50 to-red-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo and Header -->
            <div class="text-center">
                <div class="flex justify-center">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-3 shadow-lg">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Verify Your Email
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    We've sent you a verification link
                </p>
            </div>

            <!-- Verification Content -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Main Message -->
                <div class="mb-6 p-4 bg-orange-50 border border-orange-100 rounded-lg">
                    <div class="flex">
                        <svg class="w-5 h-5 text-orange-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-gray-700">
                            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                        </p>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex">
                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-green-700 font-medium">
                                A new verification link has been sent to the email address you provided during registration.
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Resend Verification Email Form -->
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                        @csrf
                        <button 
                            type="submit"
                            class="w-full sm:w-auto flex justify-center items-center py-3 px-6 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-150 ease-in-out transform hover:scale-[1.02]"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>Resend Verification Email</span>
                        </button>
                    </form>

                    <!-- Logout Form -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                        @csrf
                        <button 
                            type="submit"
                            class="w-full sm:w-auto text-sm text-gray-600 hover:text-gray-900 font-medium underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 rounded-md px-3 py-2 transition duration-150 ease-in-out"
                        >
                            Log Out
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <div class="flex items-center justify-center text-xs text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span>Check your spam folder if you don't see the email</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>