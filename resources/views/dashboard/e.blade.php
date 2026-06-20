<x-app-layout>
    <div class="min-h-screen bg-gray-100">

        {{-- MOBILE SIDEBAR (hidden by default) --}}
        {{-- Untuk simplicity, versi ini fokus desktop (sesuai Tailwind UI contoh) --}}

        <div class="flex h-screen">

            {{-- SIDEBAR --}}
            <div class="hidden md:flex md:w-64 md:flex-col">
                <div class="flex flex-col flex-grow bg-white border-r">

                    {{-- LOGO --}}
                    <div class="flex items-center flex-shrink-0 px-6 py-4">
                        <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center font-bold">
                            R
                        </div>
                        <span class="ml-2 text-lg font-semibold text-gray-900">
                            flex
                        </span>
                    </div>

                    {{-- NAV --}}
                    <div class="flex-1 px-4 space-y-1">

                        {{-- Dashboard (Active) --}}
                        <a href="{{ route('dashboard.mahasiswa') }}"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl
                                  text-white bg-gradient-to-r from-blue-600 to-indigo-500
                                  shadow-lg shadow-blue-500/30">

                            {{-- Icon --}}
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h6m8-11v10a1 1 0 01-1 1h-6"/>
                            </svg>

                            Dashboard
                        </a>

                        {{-- Lowongan --}}
                        <a href="/recruitments"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl
                                  text-gray-700 hover:bg-gray-100">

                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10 6h4m-6 4h8m-9 8h10a2 2 0 002-2V8a2 2 0 00-2-2H7a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>

                            Lowongan Tim
                        </a>

                        {{-- Lamaran --}}
                        <a href="/applications"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl
                                  text-gray-700 hover:bg-gray-100">

                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12h6m-6 4h6M7 20h10a2 2 0 002-2V6a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>

                            Lamaran Saya
                        </a>

                        {{-- Profil --}}
                        <a href="{{ route('profile.edit') }}"
                           class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl
                                  text-gray-700 hover:bg-gray-100">

                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5.121 17.804A9 9 0 1118.9 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>

                            Profil
                        </a>

                        {{-- SECTION --}}
                        <div class="pt-6">
                            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                Integrations
                            </p>
                        </div>

                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl
                                           text-gray-700 hover:bg-gray-100">
                            Jira
                        </a>
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl
                                           text-gray-700 hover:bg-gray-100">
                            Slack
                        </a>
                        <a href="#" class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl
                                           text-gray-700 hover:bg-gray-100">
                            Intercom
                        </a>
                    </div>

                    {{-- LOGOUT --}}
                    <div class="p-4 border-t">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full flex items-center px-3 py-2 text-sm rounded-xl
                                           text-gray-700 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="flex flex-col flex-1 overflow-hidden">

                {{-- TOP BAR --}}
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b">

                    <div class="w-1/3">
                        <input type="text"
                               placeholder="Search..."
                               class="w-full rounded-full border-gray-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex items-center gap-4">
                        <button class="hidden md:inline-flex items-center px-4 py-2 rounded-full
                                       bg-emerald-500 text-white hover:bg-emerald-600">
                            Download Report
                        </button>

                        <div class="flex items-center gap-2">
                            <img class="h-9 w-9 rounded-full"
                                 src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}">
                            <span class="text-sm font-medium text-gray-700">
                                {{ auth()->user()->name }}
                            </span>
                        </div>
                    </div>
                </header>

                {{-- PAGE CONTENT --}}
                <main class="flex-1 overflow-y-auto bg-gray-100 p-6">

                    <h1 class="text-2xl font-semibold text-gray-900">
                        Dashboard Mahasiswa
                    </h1>
                    <p class="text-gray-500 mt-1">
                        Temukan tim dan kelola lamaran kamu
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div class="bg-white rounded-2xl shadow p-6">
                            <h3 class="font-medium text-gray-900">Lowongan Aktif</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Cari tim lomba yang sesuai minat
                            </p>
                            <a href="/recruitments"
                               class="mt-4 inline-block text-blue-600 font-medium">
                                Lihat Lowongan →
                            </a>
                        </div>

                        <div class="bg-white rounded-2xl shadow p-6">
                            <h3 class="font-medium text-gray-900">Status Lamaran</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Pantau pendaftaran tim
                            </p>
                            <a href="/applications"
                               class="mt-4 inline-block text-blue-600 font-medium">
                                Lihat Status →
                            </a>
                        </div>

                        <div class="bg-gradient-to-br from-red-600 to-red-700 text-white rounded-2xl shadow p-6">
                            <h3 class="font-medium">Buat Tim Sendiri</h3>
                            <p class="text-sm opacity-90 mt-1">
                                Beralih menjadi Ketua Tim
                            </p>

                            <form method="POST" action="{{ route('ganti-ketua') }}" class="mt-4">
                                @csrf
                                <button class="px-4 py-2 bg-white text-red-700 rounded-lg font-medium">
                                    Buat Lowongan
                                </button>
                            </form>
                        </div>

                    </div>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
