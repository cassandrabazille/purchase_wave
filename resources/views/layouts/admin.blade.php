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
    <header class="responsive-header flex-row space-between padding-right-2 padding-left-2">
        <nav>
          <img src="{{ asset('images/logo_desktop.png') }}" alt="Logo PurchaseWave">
        </nav>
        <nav class="responsive-header flex-row align-items-center gap-10">
  
            <a class="font-weight-500" href="{{ route('admin.index') }}">Comptes utilisateurs</a>


            <div class="user-info flex-row align-items-center gap-2 cursor-pointer" onclick="toggleDropdown()">
                <img src="{{ asset('images/user-img.png') }}" alt="Profil" />
                <div class="user-dropdown">
                    <p class="user">{{ auth('admin')->user()->name }}</p>
                    <!-- ↓ Utilisez une classe ET un ID pour plus de fiabilité ↓ -->
                    <ul id="userDropdownMenu" class="white-background cursor-pointer black-box-shadow text-align-center border-radius-0-4 padding-1" style="display: none;">
                        <li class="no-list-style font-size-1-4"><a href="{{ route('admin.profile.edit') }}">Mon compte</a></li>
                        <li class="no-list-style font-size-1-4">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="logout-button blue-background hover-blue font-poppins-ss font-size-1-4 white-color normal-font-weight width-15 height-5 margin-top-1 border-radius-3-4 no-border cursor-pointer">Déconnexion</button>
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
        <p class="margin-2-5">© PurchaseWave</p>
    </footer>


</body>

</html>