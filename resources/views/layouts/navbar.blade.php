<nav class="nav nav-{{app()->getLocale()=='ar'?'right':'left'}}">
    <button type="button" class="nav-close {{app()->getLocale()=='ar'?'nav-close-left':''}}">
        <label class="close" for="checkbox_toggle">
            <i class="material-symbols-outlined">close</i>
        </label>
    </button>
    <div class="nav-links-container">
        <a href="#" class="nav__link">
            <span class="nav__text">{{ __('messages.Blog') }}</span>
        </a>
        <a href="{{Route('contact',App::getLocale())}}" class="nav__link">
            <span class="nav__text">{{__('messages.Contact us')}}</span>
        </a>
        <a href="{{Route('terms-and-conditions',App::getLocale())}}" class="nav__link">
            <span class="nav__text">{{__('messages.Terms & Conditions')}}</span>
        </a>
        @foreach ( config('app.allowed_languages') as $lang)
            @if ($lang == App::getLocale())
                @continue
            @endif
            <a href="{{ route(Route::current()->getName(), $lang) }}" class="nav__link">
                <i class="material-symbols-outlined nav__icon">language</i>
                <span class="nav__text">{{ __("messages.$lang") }}</span>
            </a>                        
        @endforeach
        {{-- <a href="{{Route(Route::current()->getName(),)}}" class="nav__link">
            <i class="material-symbols-outlined nav__icon">language</i>
            <span class="nav__text language-en-size">{{ __('messages.en')}} </span>
        </a> --}}
    </div>
</nav>