<footer>
    <section class="social-media">
        <div>
            <h5>Cova App</h5>
        </div>
        <div>
            <a href="#" class="fa fa-youtube-play"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-twitter"></a>
        </div>
    </section>
    <section class="list-link-footer">
        <div class="flex flex-justify-center flex-wrap">
            <div class="store-size-btn">
                <a href="#">
                    <img src="{{ asset('cova/landingPage/img/App_Store_Badge.svg.png') }}" alt="">
                </a>
            </div>
            <div class="store-size-btn">
                <a href="#">
                    <img src="{{ asset('cova/landingPage/img/Google_Play_Store_badge.svg.png') }}" alt="">
                </a>
            </div>
            <div class="store-size-btn">
                <a href="#">
                    <img src="{{ asset('cova/landingPage/img/app-gallery.webp') }}" alt="">
                </a>
            </div>
        </div>
        <nav class="nav-footer">
            <ul>
                <li><a href="#">{{__('messages.Blog')}}</a></li>
                <li><a href="{{Route('contact')}}">{{__('messages.Contact')}}</a></li>
                <li><a href="#">{{__('messages.About us')}}</a></li>
                <li><a href="{{ Route('rider') }}">{{__('messages.Become a rider')}} </a></li>
                <li><a href="{{ Route('partner') }}">{{__('messages.Become a partner')}}</a></li>
            </ul>
        </nav>
    </section>
    <section class="social-media copy-cova">
        <!-- © 2022 Cova Terms & Conditions -->
        <div>
            &copy; 2022 Cova
        </div>
        <div>
            {{__('messages.Terms & Conditions')}}
        </div>
    </section>
</footer>