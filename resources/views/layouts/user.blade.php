<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Vite et CSS --}}
    @vite(['resources/css/style.css', 'resources/js/navbar.js'])

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap"
        rel="stylesheet" />

    <title>@yield('title', 'PurchaseWave - Auth')</title>
</head>

<body>

    {{-- Header --}}
    <header class="flexrow">
        <nav class="left-nav">
            <a href="{{ route('dashboard.index')}} ">
            <img src="{{ asset('images/logo_desktop.png') }}" alt="Logo PurchaseWave">
            </a>
        </nav>
        <nav class="right-nav">
            <a class="paddingr53 white" href="{{ route('dashboard.index') }}">Dashboard</a>
            <a class="paddingr53 white" href="{{ route('orders.index') }}">Commandes</a>
            <a class="paddingr53 white" href="{{ route('products.index') }}">Produits</a>

     <div class="user-info" onclick="toggleDropdown()">
    <img src="{{ asset('images/user-img.png') }}" alt="Profil" />
    <div class="user-dropdown">
        <p class ="user">{{ Auth::user()->name }}</p>
        <!-- ↓ Utilisez une classe ET un ID pour plus de fiabilité ↓ -->
        <ul id="userDropdownMenu" class="dropdown-menu" style="display: none;">
            <li><a href="{{ route('account.edit') }}" class="account">Mon compte</a></li>
            <li>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit">Déconnexion</button>
                </form>
            </li>
        </ul>
    </div>
</div>
        </nav>
    </header>

    {{-- Main content --}}
    <main>
        @yield('content')
    </main>

    <footer>
        <p>© PurchaseWave</p>
    </footer>


</body>

</html>