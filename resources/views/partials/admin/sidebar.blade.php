<aside
id="aside"
                :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 bg-gray-900 overflow-y-auto lg:translate-x-0 lg:inset-0 custom-scrollbar"
            >
                <!-- start::Logo -->
                <div class="flex items-center justify-center bg-black bg-opacity-30 h-16">
                    <h1 class="text-gray-100 text-lg font-bold uppercase tracking-widest flex gap-2">
{{--                        <x-application-logo class="w-12" />--}}
                        {{ __('Dashboard') }}
                    </h1>
                </div>
                <!-- end::Logo -->

                <!-- start::Navigation -->
                <nav class="py-4 custom-scrollbar" id="asidee">
                    <!-- start::Menu link -->
                    <a
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('admin.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                            Dashboard
                        </span>
                    </a>
                    <!-- end::Menu link -->

                    <a
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('admin.platforms.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <svg class="w-5 h-5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                            Platforms
                        </span>
                    </a>

                    <a
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('admin.categories.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 {{ Request::is('dashboard/categories*') ? 'hover:bg-black hover:bg-opacity-30 active' : '' }}">
                        <svg class="w-5 h-5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span class="ml-3 transition duration-200 {{ Request::is('dashboard/categories*') ? 'text-gray-100' : '' }}" :class="linkHover ? 'text-gray-100' : ''">
                            Categories
                        </span>
                    </a>

                    <!-- start::product link -->
                    <div x-data="{ linkHover: false, linkActive: false }">
                        <div @mouseover = "linkHover = true" @mouseleave = "linkHover = false" @click = "linkActive = !linkActive" class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200" :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                                <span class="ml-3">Gift Cards</span>
                            </div>
                            <svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                        <!-- start::Submenu -->
                        <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-gray-400">
                            <!-- start::Submenu link -->
                            <li class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                                <a href="{{ route('admin.cards.index') }}" class="flex items-center">
                                    <span class="mr-2 text-sm">&bull;</span>
                                    <span class="overflow-ellipsis">All Gift Cards</span>
                                </a>
                            </li>
                            <!-- end::Submenu link -->

                            <!-- start::Submenu link -->
                            <li class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                                <a href="{{ route('admin.cards.create') }}" class="flex items-center">
                                    <span class="mr-2 text-sm">&bull;</span>
                                    <span class="overflow-ellipsis">Add New</span>
                                </a>
                            </li>
                        </ul>
                        <!-- end::Submenu -->
                    </div>
                    <!-- end::Menu link -->

                    <!-- start::product link -->
                    <div x-data="{ linkHover: false, linkActive: false }">
                        <div @mouseover = "linkHover = true" @mouseleave = "linkHover = false" @click = "linkActive = !linkActive" class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200" :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>

                                <span class="ml-3">Products</span>
                            </div>
                            <svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                        <!-- start::Submenu -->
                        <ul x-show="linkActive" x-cloak x-collapse.duration.300ms class="text-gray-400">
                            <!-- start::Submenu link -->
                            <li class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                                <a href="{{ route('admin.products.index') }}" class="flex items-center">
                                    <span class="mr-2 text-sm">&bull;</span>
                                    <span class="overflow-ellipsis">All Products</span>
                                </a>
                            </li>
                            <!-- end::Submenu link -->

                            <!-- start::Submenu link -->
                            <li class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                                <a href="{{ route('admin.products.create') }}" class="flex items-center">
                                    <span class="mr-2 text-sm">&bull;</span>
                                    <span class="overflow-ellipsis">Add New</span>
                                </a>
                            </li>
                        </ul>
                        <!-- end::Submenu -->
                    </div>
                    <!-- end::Menu link -->

                    <!-- start::product link -->
                    <a
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('admin.orders.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                            Orders
                        </span>
                    </a>
                    <!-- end::Menu link -->

                    <p class="text-xs text-gray-600 mt-6 mb-2 px-6 uppercase">User Management</p>
                    <!-- start::Menu link -->
                    <a
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('admin.users.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                            All Users
                        </span>
                    </a>

                    <a x-data="{ linkHover: false }" @mouseover = "linkHover = true" @mouseleave = "linkHover = false" href="{{ route('admin.users.create') }}" class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                        <svg class="w-5 h-5 transition duration-200" :class=" linkHover ? 'text-gray-100' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                            Add User
                        </span>
                    </a>

                    <a x-data="{ linkHover: false }" @mouseover = "linkHover = true" @mouseleave = "linkHover = false" href="{{ route('admin.users.verifications.index') }}" class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200">
                        <svg class="w-5 h-5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                           Verifications
                        </span>
                    </a>

                    <p class="text-xs text-gray-600 mt-6 mb-2 px-6 uppercase">Settings</p>
                    <!-- start::Menu link -->
                    <a
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('admin.settings.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <x-cui-cil-settings class="w-5 h-5 transition duration-200" />

                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                            General Settings
                        </span>
                    </a>
                    <!-- end::Menu link -->
                    <!-- start::Menu link -->
                    <a
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('clear-cache') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <svg class="w-5 h-5 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        <span class="ml-3 transition duration-200" :class="linkHover ? 'text-gray-100' : ''">
                            Clear Cache
                        </span>
                    </a>
                    <!-- end::Menu link -->
                </nav>
                <!-- end::Navigation -->
            </aside>

