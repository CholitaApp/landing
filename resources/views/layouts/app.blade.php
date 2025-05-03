<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description"
          content="Cholita.app empowers housewives who love gardening to generate income, earn CO2 credits, and connect with their community."/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="manifest" href="/site.webmanifest">
    <title>Cholita.app - Grow, Earn, Connect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: monospace;
            font-size: 1.2rem;
        }
    </style>
</head>
<body class="bg-gradient-to-b from-yellow-200 via-pink-200 to-green-100 text-gray-800">
@include('layouts.partials.header')

@yield('content')

@include('layouts.partials.footer')
</body>
</html>
