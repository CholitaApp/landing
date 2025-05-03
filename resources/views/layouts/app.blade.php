<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description"
          content="Cholita.app empowers housewives who love gardening to generate income, earn CO2 credits, and connect with their community."/>
    <meta name="robots" content="index, follow"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="manifest" href="/site.webmanifest">
    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:title" content="Cholita.app - Grow, Earn, Connect"/>
    <meta property="og:description"
          content="Empower housewives through eco-gardening, income generation, and community."/>
    <meta property="og:image" content="https://cholita.app/preview.jpg"/>
    <meta property="og:url" content="https://cholita.app"/>
    <meta property="og:type" content="website"/>

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="Cholita.app - Grow, Earn, Connect"/>
    <meta name="twitter:description"
          content="Empower housewives through eco-gardening, income generation, and community."/>
    <meta name="twitter:image" content="https://cholita.app/preview.jpg"/>

    <title>Cholita.app - Grow, Earn, Connect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LcGAC0rAAAAANWG1Dlb7MBbvwmLpadMHqA5MiCh"></script>
    @yield('scripts')

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
@yield('footer_scripts')
</html>
