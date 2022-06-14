<header x-data="{openProSubmenu:false, openCompanyMenu:false, openAccountMenu:false}" class="js-page-header top-0 z-50 w-full backdrop-blur shadow-md bg-white dark:bg-gray-900 transition-colors" :class="{'h-full fixed':menuOpened, 'sticky': !menuOpened}">
    <div class="flex items-center px-6 py-2 container">

        <a href="{{ route('index') }}" class="shrink-0">
            <x-application-logo class="h-12 sm:h-16 max-h-20 fill-current text-gray-600" type="light" />
        </a>

        <!-- Primary Nav -->
        <nav class="navbar w-full ml-12 hidden sm:flex">
            <ul class="flex flex-col lg:flex-row">
                <li class="group">
                    <a href="{{route('index')}}" class="text-primary font-display hover:text-accent focus:text-accent dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white font-semibold lg:px-5">Home
                        <i class="lg:hidden">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                class="h-4 w-4 text-primary dark:fill-secondary"
                            >
                                <path fill="currentColor" d="M0 0h24v24H0z" />
                                <path d="M12 13.172l4.95-4.95 1.414 1.414L12 16 5.636 9.636 7.05 8.222z" />
                            </svg>
                        </i>
                    </a>
                </li>
                @if(1>0)
                <li class="js-nav-dropdown nav-item dropdown group relative">
                    <a href="#" class="dropdown-toggle text-primary font-display font-semibold hover:text-accent focus:text-accent dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5" id="navDropdown-3" aria-expanded="false" role="button" data-bs-toggle="dropdown">Product & Services
                        <i class="lg:hidden">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                                class="h-4 w-4 dark:fill-white">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M12 13.172l4.95-4.95 1.414 1.414L12 16 5.636 9.636 7.05 8.222z" />
                            </svg>
                        </i>
                    </a>
                    <ul class="dropdown-menu dark:bg-jacarta-800 top-[85%] z-10 hidden gap-x-4 whitespace-nowrap rounded-xl bg-white transition-all will-change-transform group-hover:visible group-hover:opacity-100 lg:invisible lg:absolute lg:!grid lg:translate-y-4 lg:py-4 lg:px-5 lg:opacity-0 lg:shadow-2xl lg:group-hover:translate-y-2" aria-labelledby="navDropdown-1">
                        <li>
                            <a href="{{route('pages.products')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">Ninja Power system</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('cards.index')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">Gift Cards</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('pages.web-design')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">Web Design</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('pages.graphic-design')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">Graphic Design</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('pages.content-creation')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">Content Creation</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('pages.social-media-marketing')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">Social Media Marketing</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
{{--                <li class="group">--}}
{{--                    <a href="{{route('pages.products')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">Product & Services</a>--}}
{{--                </li>--}}
{{--                <li class="group">--}}
{{--                    <a href="{{route('cards.index')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">Gift Cards</a>--}}
{{--                </li>--}}
                <li class="group">
                    <a href="{{route('pages.about-us')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">About Us</a>
                </li>
                <li class="group">
                    <a href="{{route('pages.contact')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">Contact Us</a>
                </li>
                @if(1>2)
                <li class="js-nav-dropdown group relative">
                    <a href="#"
                       class="dropdown-toggle text-primary font-display hover:text-accent font-semibold focus:text-accent dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5" id="navDropdown-2" aria-expanded="false"
                       role="button" data-bs-toggle="dropdown">About Us
                        <i class="lg:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="h-4 w-4 dark:fill-white">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M12 13.172l4.95-4.95 1.414 1.414L12 16 5.636 9.636 7.05 8.222z" />
                            </svg>
                        </i>
                    </a>
                    <ul class="dropdown-menu dark:bg-jacarta-800 left-0 top-[85%] z-10 hidden min-w-[200px] gap-x-4 whitespace-nowrap rounded-xl bg-white transition-all will-change-transform group-hover:visible group-hover:opacity-100 lg:invisible lg:absolute lg:grid lg:translate-y-4 lg:py-4 lg:px-2 lg:opacity-0 lg:shadow-2xl lg:group-hover:translate-y-2" aria-labelledby="navDropdown-2">
                        <li>
                            <a href="{{route('pages.about-us')}}"
                               class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-5 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">The Company</span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="tos.html"
                                class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-5 py-2 transition-colors"
                            >
                                <span class="font-display text-jacarta-700 text-sm dark:text-white">Terms of Service</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>

        <!-- Menu / Actions -->
        <div class="js-mobile-menu dark:bg-gray-800 invisible fixed inset-0 z-10 ml-auto items-center bg-white opacity-0 lg:visible lg:relative lg:inset-auto lg:flex lg:bg-transparent lg:opacity-100 dark:lg:bg-transparent max-w-sm w-full lg:justify-end" :class="{'nav-menu--is-open': menuOpened}" x-transition>
            <!-- Mobile Logo / Menu Close -->
            <div class="t-0 dark:bg-gray-800 fixed left-0 z-10 flex w-full items-center justify-between bg-white px-6 py-2 lg:hidden">
                <a href="{{ route('index') }}" class="shrink-0">
                    <x-application-logo class="block h-12 sm:h-16 max-h-20 fill-current text-gray-600" type="light" />
                </a>

                <!-- Mobile Menu Close -->
                <button class="js-mobile-close border-jacarta-100 hover:bg-accent focus:bg-accent group dark:hover:bg-accent ml-2 flex h-10 w-10 items-center justify-center rounded-full border bg-white transition-colors hover:border-transparent focus:border-transparent dark:border-transparent dark:bg-white/[.15]" aria-label="close mobile menu" @click="menuOpened=false">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                        class="fill-jacarta-700 h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:fill-white">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Search -->
            <form action="search" class="relative mt-24 mb-8 w-full lg:hidden">
                <input type="search" class="text-jacarta-700 placeholder-jacarta-500 focus:ring-accent border-jacarta-100 w-full rounded-2xl border py-3 px-4 pl-10 dark:border-transparent dark:bg-white/[.15] dark:text-white dark:placeholder-white" placeholder="Search"/>
                <span class="absolute left-0 top-0 flex h-full w-12 items-center justify-center rounded-2xl">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-jacarta-500 h-4 w-4 dark:fill-white"><path fill="none" d="M0 0h24v24H0z" />
                    <path d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"/>
                  </svg>
                </span>
            </form>

            @if(1>0)
            <!-- Primary Nav -->
            <nav class="navbar w-full lg:hidden">
                <ul class="flex flex-col lg:flex-row">
                    <li class="group">
                        <a href="{{route('index')}}" class="text-primary font-display hover:text-accent focus:text-accent dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white font-semibold lg:px-5">Home
                        </a>
                    </li>
                    <li class="js-nav-dropdown nav-item dropdown group relative">
                        <a href="#" class="dropdown-toggle text-primary font-display font-semibold hover:text-accent focus:text-accent dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5" id="navDropdown-products" aria-expanded="false" role="button" data-bs-toggle="dropdown" @click="openProSubmenu = !openProSubmenu">
                            Product & Services
                            <i class="lg:hidden">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    height="24"
                                    class="h-4 w-4 dark:fill-white">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path d="M12 13.172l4.95-4.95 1.414 1.414L12 16 5.636 9.636 7.05 8.222z" />
                                </svg>
                            </i>
                        </a>
                        <ul class="dropdown-menu dark:bg-gray-600 -left-6 top-0 z-50 grid-flow-col grid-rows-5 gap-x-4 whitespace-nowrap rounded-xl bg-white transition-all will-change-transform group-hover:visible group-hover:opacity-100  lg:translate-y-4 lg:py-8 lg:px-5 lg:opacity-0 lg:shadow-2xl lg:group-hover:translate-y-2" aria-labelledby="navDropdown-products" :class="{'block': openProSubmenu, 'hidden': !openProSubmenu}">

                            <li>
                                <a href="{{route('pages.products')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">Ninja Power system</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('cards.index')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">Gift Cards</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pages.web-design')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">Web Design</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pages.graphic-design')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">Graphic Design</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pages.content-creation')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">Content Creation</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pages.social-media-marketing')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-2 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">Social Media Marketing</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(1>2)
                    <li class="js-nav-dropdown group relative">
                        <a href="#" class="dropdown-toggle text-primary font-display font-semibold hover:text-accent focus:text-accent dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5" id="navDropdown-4" aria-expanded="false" role="button" data-bs-toggle="dropdown" @click="openCompanyMenu = !openCompanyMenu">The Company
                            <i class="lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="h-4 w-4 dark:fill-white">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path d="M12 13.172l4.95-4.95 1.414 1.414L12 16 5.636 9.636 7.05 8.222z" />
                                </svg>
                            </i>
                        </a>
                        <ul class="dropdown-menu dark:bg-jacarta-800 -left-6 top-0 z-50 grid-flow-col grid-rows-5 gap-x-4 whitespace-nowrap rounded-xl bg-white transition-all will-change-transform group-hover:visible group-hover:opacity-100  lg:translate-y-4 lg:py-8 lg:px-5 lg:opacity-0 lg:shadow-2xl lg:group-hover:translate-y-2" :class="{'block': openCompanyMenu, 'hidden': !openCompanyMenu}" aria-labelledby="navDropdown-4">
                            <li>
                                <a href="{{route('pages.about-us')}}"
                                    class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-5 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">About Us</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('pages.terms')}}" class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-5 py-2 transition-colors">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-white">Terms of Service</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li class="group">
                        <a href="{{route('pages.about-us')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">About Us</a>
                    </li>
                    <li class="group">
                        <a href="{{route('pages.contact')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">Contact Us</a>
                    </li>
                    @auth
                        <li class="group">
                            <a href="{{route('account.index')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">My Account</a>
                        </li>
                        <li class="group">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="font-display text-red-700 text-sm dark:text-primary">{{ __('Log Out') }}</span>
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="group">
                            <a href="{{route('login')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">Login</a>
                        </li>
                        <li class="group">
                            <a href="{{route('register')}}" class="text-primary font-display hover:text-accent focus:text-accent font-semibold dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white lg:px-5">Register</a>
                        </li>
                    @endauth
                </ul>
            </nav>
            @endif
            <!-- Actions -->
            <div class="ml-8 hidden lg:flex xl:ml-12 gap-4 items-center">
                @guest
                <a href="{{route('login')}}" class="text-primary font-display hover:text-accent focus:text-accent dark:hover:text-accent dark:focus:text-accent flex items-center justify-between py-3.5 text-base dark:text-white font-semibold lg:px-5">Sign In</a>
                @endguest

                <a href="{{route('register')}}" class="btn btn-primary btn-sm">Get started</a>

                @auth
                <!-- Profile -->
                <div class="js-nav-dropdown group relative">
                    <a href="#" class="dropdown-toggle border-jacarta-100 hover:bg-accent focus:bg-accent group dark:hover:bg-accent ml-2 flex h-10 w-10 items-center justify-center rounded-full border bg-white transition-colors hover:border-transparent focus:border-transparent dark:border-transparent dark:bg-white/[.15]" id="accountDropdown" aria-expanded="false" role="button" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             width="24"
                             height="24"
                             class="fill-jacarta-700 h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:fill-white">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M11 14.062V20h2v-5.938c3.946.492 7 3.858 7 7.938H4a8.001 8.001 0 0 1 7-7.938zM12 13c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6z"/>
                        </svg>
                    </a>
                    <ul class="dropdown-menu dark:bg-jacarta-800 right-0 top-[85%] z-10 hidden min-w-[200px] gap-x-4 whitespace-nowrap rounded-xl bg-white transition-all will-change-transform group-hover:visible group-hover:opacity-100 lg:invisible lg:absolute lg:grid lg:translate-y-4 lg:py-4 lg:px-2 lg:opacity-0 lg:shadow-2xl lg:group-hover:translate-y-2" aria-labelledby="accountDropdown">
                        <li>
                            <a href="{{route('account.index')}}"
                               class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-5 py-2 transition-colors">
                                <span class="font-display text-jacarta-700 text-sm dark:text-primary">My Account</span>
                            </a>
                        </li>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dark:hover:bg-jacarta-600 hover:text-accent focus:text-accent hover:bg-jacarta-50 flex items-center rounded-xl px-5 py-2 transition-colors" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="font-display text-jacarta-700 text-sm dark:text-primary">{{ __('Log Out') }}</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth

                <!-- Dark Mode Switcher-->
                <a href="#" class="theme-toggle border-jacarta-100 hover:bg-accent focus:bg-accent group dark:hover:bg-accent js-dark-mode-trigger ml-2 flex h-10 w-10 items-center justify-center rounded-full border bg-white transition-colors hover:border-transparent focus:border-transparent dark:border-transparent dark:bg-white/[.15]">
                    <svg id="theme-toggle-dark-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                        class="theme-toggle-dark-icon fill-jacarta-700 dark-mode-light h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:hidden">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M11.38 2.019a7.5 7.5 0 1 0 10.6 10.6C21.662 17.854 17.316 22 12.001 22 6.477 22 2 17.523 2 12c0-5.315 4.146-9.661 9.38-9.981z"/>
                    </svg>
                    <svg id="theme-toggle-light-icon"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        width="24"
                        height="24"
                        class="theme-toggle-light-icon fill-jacarta-700 dark-mode-dark hidden h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:block dark:fill-white">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Mobile Menu Actions -->
        <div class="ml-auto flex lg:hidden">
            <!-- Profile -->
            <a href="{{ Auth::check() ? route('account.index') : route('login') }}" class="border-jacarta-100 hover:bg-accent focus:bg-accent group dark:hover:bg-accent ml-2 flex h-10 w-10 items-center justify-center rounded-full border bg-white transition-colors hover:border-transparent focus:border-transparent dark:border-transparent dark:bg-white/[.15]" aria-label="profile">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                    class="fill-jacarta-700 h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:fill-white">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path d="M11 14.062V20h2v-5.938c3.946.492 7 3.858 7 7.938H4a8.001 8.001 0 0 1 7-7.938zM12 13c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6z"/>
                </svg>
            </a>

            <!-- Dark Mode -->
            <a href="javascript:void(0)"
                class="theme-toggle js-dark-mode-trigger border-jacarta-100 hover:bg-accent dark:hover:bg-accent focus:bg-accent group ml-2 flex h-10 w-10 items-center justify-center rounded-full border bg-white transition-colors hover:border-transparent focus:border-transparent dark:border-transparent dark:bg-white/[.15]">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                    class="theme-toggle-dark-icon fill-jacarta-700 dark-mode-light h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:hidden">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path d="M11.38 2.019a7.5 7.5 0 1 0 10.6 10.6C21.662 17.854 17.316 22 12.001 22 6.477 22 2 17.523 2 12c0-5.315 4.146-9.661 9.38-9.981z"/>
                </svg>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                    class="theme-toggle-light-icon fill-jacarta-700 dark-mode-dark hidden h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:block dark:fill-white">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z"/>
                </svg>
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="js-mobile-toggle border-jacarta-100 hover:bg-accent dark:hover:bg-accent focus:bg-accent group ml-2 flex h-10 w-10 items-center justify-center rounded-full border bg-white transition-colors hover:border-transparent focus:border-transparent dark:border-transparent dark:bg-white/[.15]" aria-label="open mobile menu" @click="menuOpened = !menuOpened">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                    class="fill-jacarta-700 h-4 w-4 transition-colors group-hover:fill-white group-focus:fill-white dark:fill-white"
                >
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path d="M18 18v2H6v-2h12zm3-7v2H3v-2h18zm-3-7v2H6V4h12z" />
                </svg>
            </button>
        </div>
    </div>
</header>
