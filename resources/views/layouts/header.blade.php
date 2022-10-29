    <header id="header-left" class="logo header-left">
        <div class="menu-link">
            <!-- USING CHECKBOX HACK -->
            <input type="checkbox" id="checkbox_toggle" />
            <label for="checkbox_toggle" id="hamburger" class="hamburger material-symbols-outlined">menu</label>
            <!-- NAVIGATION MENUS -->
            <input type="checkbox" id="checkbox_toggle" />
            @include('layouts.navbar')
        </div>
        <div class="logo">
            <a href="{{ Route('landing-page',[app()->getLocale()]) }}">
                <img class="logo-img" id="logo_white" src="{{ asset('cova/partnerRiderPage/img/Logo.svg') }}"
                    alt="">
                <img class="logo-img hide" id="logo_purple" src="{{ asset('cova/landingPage/img/Logo.svg') }}"
                    alt="">
            </a>
        </div>
    </header>
