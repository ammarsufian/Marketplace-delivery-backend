    <header id="header-left" class="logo header-left">
        <div class="menu-link">
            <!-- USING CHECKBOX HACK -->
            <input type="checkbox" id="checkbox_toggle" />
            <label for="checkbox_toggle" id="hamburger" class="hamburger material-symbols-outlined">menu</label>
            <!-- NAVIGATION MENUS -->
            <input type="checkbox" id="checkbox_toggle" />
            <nav class="nav">
                <button type="button" class="nav-close">
                    <label class="close" for="checkbox_toggle">
                        <i class="material-symbols-outlined">close</i>
                    </label>
                </button>
                <div class="nav-links-container">
                    <a href="#" class="nav__link">
                        <span class="nav__text">Blog</span>
                    </a>
                    <a href="{{Route('contact')}}" class="nav__link">
                        <span class="nav__text">Contact us</span>
                    </a>
                    <a href="#" class="nav__link">
                        <i class="material-symbols-outlined nav__icon">language</i>
                        <span class="nav__text language-en-size">English</span>
                    </a>
                </div>
            </nav>
        </div>
        <div class="logo">
            <a href="{{ Route('landing-page') }}">
                <img class="logo-img" id="logo_white" src="{{ asset('cova/partnerRiderPage/img/Logo.svg') }}"
                    alt="">
                <img class="logo-img hide" id="logo_purple" src="{{ asset('cova/landingPage/img/Logo.svg') }}"
                    alt="">
            </a>
        </div>
    </header>
