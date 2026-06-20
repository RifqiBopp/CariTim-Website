<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-950 antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CariTim - Temukan Tim Juara Kamu</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                    },
                    colors: {
                        gray: {
                            850: '#1f2937',
                            900: '#111827',
                            950: '#0B1120', // Custom premium dark
                        }
                    }
                }
            }
        }
    </script>
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .glass-nav {
            background: rgba(11, 17, 32, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-glow {
            background: radial-gradient(circle at 50% 50%, rgba(79, 70, 229, 0.15) 0%, rgba(11, 17, 32, 0) 50%);
        }
    </style>
</head>
<body class="bg-gray-950 text-gray-200 font-sans selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0 border-b border-white/10 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center shadow-lg shadow-indigo-500/20 ring-1 ring-white/10">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">CariTim</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Fitur</a>
                    <a href="#recruitments" class="text-sm font-medium text-gray-300 hover:text-white transition-colors">Lowongan</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center gap-4 ml-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-semibold shadow-lg shadow-indigo-500/20 hover:bg-indigo-500 hover:-translate-y-0.5 transition-all duration-200">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-100 hover:text-indigo-400 transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-lg bg-white text-gray-900 text-sm font-semibold shadow hover:bg-gray-100 hover:-translate-y-0.5 transition-all duration-200">
                                        Daftar Sekarang
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-gray-400 hover:text-white">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden hero-glow">
        <!-- Background decorative elements -->
        <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-indigo-500/50 to-transparent"></div>
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-indigo-500 to-blue-500 opacity-20 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold uppercase tracking-wide mb-8 hover:bg-indigo-500/20 transition-colors cursor-default">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Platform Kolaborasi Mahasiswa #1
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-8 leading-tight">
                Temukan Tim <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Juara Kamu Disini</span>
            </h1>
            
            <p class="mt-4 text-lg md:text-xl text-gray-400 max-w-3xl mx-auto mb-10 leading-relaxed">
                Platform all-in-one untuk mahasiswa mencari rekan tim kompetisi, mengelola rekrutmen pelamar, dan mendapatkan bimbingan dosen profesional.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#recruitments" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-indigo-600 text-white font-bold shadow-lg shadow-indigo-500/25 hover:bg-indigo-500 hover:scale-105 transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    Cari Lowongan
                </a>
                @guest
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gray-800 text-white font-bold border border-gray-700 hover:bg-gray-700 hover:border-gray-600 transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Buat Tim Baru
                </a>
                @endguest
            </div>

            <!-- Stats -->
            <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 border-t border-white/5 pt-10">
                <div>
                    <div class="text-3xl font-bold text-white">100+</div>
                    <div class="text-sm text-gray-500 mt-1">Tim Terbentuk</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white">50+</div>
                    <div class="text-sm text-gray-500 mt-1">Kompetisi</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white">24/7</div>
                    <div class="text-sm text-gray-500 mt-1">Sistem Aktif</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white">GRATIS</div>
                    <div class="text-sm text-gray-500 mt-1">Untuk Mahasiswa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 relative bg-gray-900/40 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-indigo-400 font-semibold tracking-wide uppercase text-sm mb-3">Fitur Unggulan</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-white mb-4">Semua Tool untuk Menang</h3>
                <p class="text-gray-400">Fokus pada inovasi, biarkan kami yang mengurus manajemen tim administratif kamu.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="group p-8 rounded-2xl bg-gray-900 border border-gray-800 hover:border-indigo-500/50 hover:bg-gray-800 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-all"></div>
                    <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center mb-6 group-hover:bg-indigo-500/20 group-hover:text-indigo-400 transition-all">
                        <svg class="w-7 h-7 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Smart Matchmaking</h4>
                    <p class="text-gray-400 leading-relaxed text-sm">Cari rekan berdasarkan skill spesifik, jurusan, atau minat kompetisi dengan sistem filter canggih.</p>
                </div>

                <!-- Card 2 -->
                <div class="group p-8 rounded-2xl bg-gray-900 border border-gray-800 hover:border-cyan-500/50 hover:bg-gray-800 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-cyan-500/10 rounded-full blur-2xl group-hover:bg-cyan-500/20 transition-all"></div>
                    <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center mb-6 group-hover:bg-cyan-500/20 group-hover:text-cyan-400 transition-all">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Applicant Management</h4>
                    <p class="text-gray-400 leading-relaxed text-sm">Sistem seleksi pelamar terpusat. Review portofolio, terima, atau tolak dengan satu kali klik.</p>
                </div>

                <!-- Card 3 -->
                <div class="group p-8 rounded-2xl bg-gray-900 border border-gray-800 hover:border-teal-500/50 hover:bg-gray-800 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-teal-500/10 rounded-full blur-2xl group-hover:bg-teal-500/20 transition-all"></div>
                    <div class="w-14 h-14 bg-gray-800 rounded-xl flex items-center justify-center mb-6 group-hover:bg-teal-500/20 group-hover:text-teal-400 transition-all">
                        <svg class="w-7 h-7 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Expert Mentorship</h4>
                    <p class="text-gray-400 leading-relaxed text-sm">Terhubung dengan dosen pembimbing yang berpengalaman untuk meningkatkan kualitas projectmu.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Recruitments -->
    <div id="recruitments" class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <h2 class="text-3xl font-bold text-white mb-3">Explore Lowongan</h2>
                <p class="text-gray-400">Tim-tim hebat ini sedang menunggu talent sepertimu.</p>
            </div>
            <a href="{{ route('recruitments.index') }}" class="hidden sm:inline-flex items-center gap-2 text-indigo-400 hover:text-indigo-300 font-medium transition-colors">
                Lihat Semua <span aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($recruitments as $recruitment)
            <div class="group bg-gray-900 rounded-xl overflow-hidden border border-gray-800 hover:border-indigo-500/40 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 flex flex-col h-full">
                <!-- Poster/Image -->
                <div class="h-48 relative overflow-hidden bg-gray-800">
                    @if($recruitment->competition && $recruitment->competition->poster_path)
                        <img src="{{ Storage::url($recruitment->competition->poster_path) }}" 
                             alt="{{ $recruitment->competition->title }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center bg-gray-800 group-hover:bg-gray-750 transition-colors">
                            <span class="text-gray-600 font-medium text-sm">No Poster Available</span>
                        </div>
                    @endif
                    
                    <!-- Overlay Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-80"></div>
                    
                    <!-- Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-900/80 text-white backdrop-blur-sm border border-gray-700">
                            {{ $recruitment->competition->category ?? 'Umum' }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 flex-1 flex flex-col">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition-colors line-clamp-1 mb-1">
                            {{ $recruitment->title }}
                        </h3>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $recruitment->competition->title ?? 'Competition' }}
                        </p>
                    </div>
                    
                    <p class="text-gray-400 text-sm leading-relaxed line-clamp-2 mb-6 flex-1">
                        {{ $recruitment->description }}
                    </p>

                    <!-- User & Action -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-800">
                         <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-600/20 flex items-center justify-center text-xs font-bold text-indigo-400 border border-indigo-500/30">
                                {{ substr($recruitment->user->name, 0, 1) }}
                            </div>
                            <span class="text-sm text-gray-300 font-medium truncate max-w-[100px]">{{ $recruitment->user->name }}</span>
                        </div>
                        
                        <a href="{{ route('recruitments.show', $recruitment->id) }}" class="text-sm font-semibold text-white bg-gray-800 hover:bg-indigo-600 px-4 py-2 rounded-lg transition-colors border border-gray-700 hover:border-indigo-500 group-hover:shadow-lg">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-gray-900/50 rounded-2xl border border-gray-800 border-dashed">
                <div class="w-20 h-20 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Belum Ada Lowongan</h3>
                <p class="text-gray-400 mb-6">Jadilah yang pertama membuka kesempatan kolaborasi!</p>
                @auth
                <a href="{{ route('recruitments.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-indigo-600 hover:bg-indigo-500 transition-all">
                    Buat Lowongan
                </a>
                @else
                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-indigo-600 hover:bg-indigo-500 transition-all">
                    Mulai Buat Tim
                </a>
                @endauth
            </div>
            @endforelse
        </div>
        
        <div class="mt-12 text-center sm:hidden">
             <a href="{{ route('recruitments.index') }}" class="inline-block px-6 py-3 rounded-lg bg-gray-800 text-white font-medium border border-gray-700">
                Lihat Semua Lowongan
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-950 border-t border-white/5 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="text-xl font-bold text-white">CariTim</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                        Platform kolaborasi nomor #1 untuk mahasiswa Indonesia. Temukan tim impian, menangkan kompetisi, dan raih prestasi gemilang.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Menu</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#features" class="hover:text-indigo-400 transition-colors">Fitur</a></li>
                        <li><a href="#recruitments" class="hover:text-indigo-400 transition-colors">Lowongan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li>support@caritim.id</li>
                        <li>Jl. Kampus Merdeka No. 1</li>
                        <li class="flex gap-4 mt-4">
                            <a href="#" class="text-gray-500 hover:text-white transition-colors"><span class="sr-only">Instagram</span>ISO</a>
                            <a href="#" class="text-gray-500 hover:text-white transition-colors"><span class="sr-only">Twitter</span>TW</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-xs">
                    &copy; {{ date('Y') }} CariTim Indonesia. All rights reserved.
                </p>
                <div class="flex gap-6 text-xs text-gray-500">
                    <a href="#" class="hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
