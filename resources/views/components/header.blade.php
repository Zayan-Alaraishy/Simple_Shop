<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>

                <div class="right-top-bar flex-w h-full">
                    @auth
                        <a href={{ route('profile', auth()->user()->id) }} class="flex-c-m trans-04 p-lr-25">
                            My Profile
                        </a>
                        <a href={{ route('orders') }} class="flex-c-m trans-04 p-lr-25">
                            My Orders
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href={{ route('home') }} class="logo">
                    <img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">

                        <li class="active-menu">
                            <a href="{{ route('home') }}">Home</a>
                        </li>

                        <li>
                            <a href="{{ route('about') }}">About</a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                @auth
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="2">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">Logout</button>
                            </form>
                        </li>

                    </div>
                @endauth
                @guest
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <a href="{{ route('login') }}">Login</a>
                        </div>
                        <div class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            <a href="{{ route('signup') }}">Signup</a>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>
                    </div>
                @endguest
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href={{ route('home') }}><img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>
            @auth()
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            @endauth

        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    @auth
                        <a href={{ route('profile', auth()->user()->id) }} class="flex-c-m trans-04 p-lr-25">
                            My Profile
                        </a>
                    @endauth
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li class="active-menu">
                <a href="{{ route('home') }}">Home</a>
            </li>


            <li>
                <a href="{{ route('about') }}">About</a>
            </li>

            <li>
                <a href="{{ route('contact') }}">Contact</a>
            </li>
            @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">Logout</button>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>

                <li>
                    <a href="{{ route('signup') }}">Signup</a>
                </li>
            @endguest
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" method="GET" action="{{ route('products.index') }}">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="name" placeholder="Search...">
            </form>
        </div>
    </div>
</header>

@if (isset($cartItems))
    <script>
        let count = {{ Js::from(count($cartItems)) }}

        let notifyElement = document.querySelector('.icon-header-noti');
        const styleElement = document.createElement('style');

        styleElement.textContent = `
        .icon-header-noti::after {
            content: '${count}' !important;
        }
        `;

        document.head.appendChild(styleElement);
    </script>
@endif
