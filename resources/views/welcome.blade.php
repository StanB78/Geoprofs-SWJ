<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-blue-950 text-white flex flex-col items-center justify-start min-h-screen">

    <div class="text-center mt-48">
        <h1 class="text-4xl font-bold mb-6">Welcome</h1>
        <h2 class="text-3xl font-bold mb-6 text-orange-500">Log in with your employee account</h2>


        <a href="{{ route('login') }}"
           class="inline-block px-8 py-3 bg-white text-blue-950 font-semibold text-lg rounded-md shadow-lg hover:bg-blue-200 hover:shadow-xl transition duration-300 ease-in-out">
            Log In
        </a>
    </div>

    </body>
    </html>
</x-app-layout>
