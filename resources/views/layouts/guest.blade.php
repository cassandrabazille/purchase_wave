<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Vite et CSS --}}
    @vite('resources/css/style.css')

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap"
      rel="stylesheet">

    <title>@yield('title', 'PurchaseWave')</title>
</head>
<body>
    {{-- Header pour les pages guest --}}
    <header>
        <img src="{{ asset('images/logo_desktop.png') }}" alt="Logo de PurchaseWave." class="margin-left-2">
        {{-- Si tu veux un menu ici, tu peux l’ajouter comme dans les pages auth --}}
    </header>

    {{-- Main avec possibilité de classes dynamiques --}}
    <main class="@yield('mainClass')">
        @yield('content')
    </main>

      <footer>
        <p class="margin-2-5">© PurchaseWave</p>
    </footer>


</body>

</html>
