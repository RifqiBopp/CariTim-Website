
<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CariTim Dashboard' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full" x-data="{ sidebarOpen: false }">

    <!-- Mobile sidebar backdrop -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 z-40 lg:hidden" role="dialog" aria-modal="true" @click="sidebarOpen = false"></div>

    <!-- Sidebar -->
    <div class="fixed inset-y-0 z-50 flex w-72 flex-col transition-transform duration-300 transform lg:translate-x-0"
         :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gradient-to-br from-blue-900 to-indigo-900 px-6 pb-4 shadow-2xl ring-1 ring-white/10">
            <div class="flex h-16 shrink-0 items-center gap-x-3 border-b border-white/10">
                <div class="h-8 w-8 rounded-lg bg-indigo-500 flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span class="text-white text-xl font-bold tracking-tight">CariTim</span>
            </div>

            <nav class="flex flex-1 flex-col mt-4">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            @auth
                            {{-- Mahasiswa Links --}}
                            @if(Auth::user()->role === 'mahasiswa')
                            <li>
                                <a href="{{ route('dashboard.mahasiswa') }}" class="{{ request()->routeIs('dashboard.mahasiswa') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('dashboard.mahasiswa') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('applications.*') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                    </svg>
                                    Lamaran Saya
                                </a>
                            </li>
                            @endif

                             {{-- Common Link for Auth Users --}}
                             <li>
                                <a href="{{ route('recruitments.index') }}" class="{{ request()->routeIs('recruitments.index') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                   <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('recruitments.index') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    Cari Lowongan
                                </a>
                            </li>

                            {{-- Ketua Tim Links --}}
                            @if(Auth::user()->role === 'ketua_tim')
                            <li>
                                <a href="{{ route('dashboard.ketua') }}" class="{{ request()->routeIs('dashboard.ketua') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('dashboard.ketua') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                                    </svg>
                                    Dashboard Ketua
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('recruitments.manage') }}" class="{{ request()->routeIs('recruitments.manage') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('recruitments.manage') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                    </svg>
                                    Kelola Lowongan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mentorships.create') }}" class="{{ request()->routeIs('mentorships.create') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                      <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('mentorships.create') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                    Request Bimbingan
                                </a>
                            </li>
                            @endif

                            {{-- Dosen Links --}}
                            @if(Auth::user()->role === 'dosen')
                             <li>
                                <a href="{{ route('dashboard.dosen') }}" class="{{ request()->routeIs('dashboard.dosen') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('dashboard.dosen') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.24 50.552 50.552 0 00-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                    Dashboard Dosen
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mentorships.index') }}" class="{{ request()->routeIs('mentorships.index') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                      <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('mentorships.index') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                    Request Bimbingan
                                </a>
                            </li>
                            @endif

                            @else
                             {{-- GUEST LINKS --}}
                             <li>
                                <a href="{{ route('recruitments.index') }}" class="{{ request()->routeIs('recruitments.index') ? 'bg-indigo-700 text-white' : 'text-indigo-200 hover:text-white hover:bg-indigo-700/50' }} group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                   <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('recruitments.index') ? 'text-white' : 'text-indigo-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    Cari Lowongan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" class="text-indigo-200 hover:text-white hover:bg-indigo-700/50 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                   <svg class="h-6 w-6 shrink-0 text-indigo-200 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                    </svg>
                                    Login
                                </a>
                            </li>
                            @endauth

                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Main content -->
    <div class="lg:pl-72 flex flex-col min-h-screen">
        <!-- Topbar -->
        <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-700 bg-gray-900 px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
            <button type="button" class="-m-2.5 p-2.5 text-gray-400 lg:hidden" @click="sidebarOpen = true">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Separator -->
            <div class="h-6 w-px bg-gray-700 lg:hidden" aria-hidden="true"></div>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6 items-center">
                 <h1 class="text-xl font-bold text-white truncate my-auto">{{ $header ?? '' }}</h1>
                 
                <div class="flex items-center gap-x-4 lg:gap-x-6 ml-auto">
                    
                    @auth
                    {{-- Role Switcher --}}
                    @if(Auth::user()->role === 'mahasiswa')
                        <form action="{{ route('ganti-ketua') }}" method="POST">
                            @csrf
                            <button type="submit" class="hidden sm:flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                </svg>
                                Switch to Ketua
                            </button>
                        </form>
                    @elseif(Auth::user()->role === 'ketua_tim')
                        <form action="{{ route('ganti-mahasiswa') }}" method="POST">
                            @csrf
                            <button type="submit" class="hidden sm:flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Back to Mahasiswa
                            </button>
                        </form>
                    @endif

                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button">
                            <span class="sr-only">Open user menu</span>
                             <div class="h-8 w-8 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="hidden lg:flex lg:items-center">
                                <span class="ml-4 text-sm font-semibold leading-6 text-white" aria-hidden="true">{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none hidden" :class="{ 'block': open, 'hidden': !open }">
                             <a href="{{ route('profile.edit') }}" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">Profile</a>
                             
                             <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50">Sign out</button>
                            </form>
                        </div>
                    </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white">Log in <span aria-hidden="true">&rarr;</span></a>
                    @endauth
                </div>
            </div>
        </div>

        <main class="py-10 flex-1">
            <div class="px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 rounded-md bg-green-50 p-4 border border-green-200" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-md bg-red-50 p-4 border border-red-200" role="alert">
                         <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
