<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-white flex items-center justify-center">

    <!-- LOGIN CARD -->
    <div class="w-full max-w-md  rounded-md border p-8">

        <!-- TITLE -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">Login</h1>
            <p class="text-sm text-gray-500">Please login to continue</p>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <!-- PHONE -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Phone Number</label>
                <input type="text" name="phone" class="w-full h-11 px-4 rounded-xl border border-gray-300
               focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- PASSWORD -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full h-11 px-4 rounded-xl border border-gray-300
               focus:ring-2 focus:ring-indigo-500">
            </div>

            <button type="submit" class="w-full h-11 rounded-xl bg-indigo-600 text-white font-semibold">
                Login
            </button>
        </form>


        <!-- FOOTER -->
        <div class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} Your Website
        </div>

    </div>

</body>

</html>