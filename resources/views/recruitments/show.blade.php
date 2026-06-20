<x-dashboard-layout title="Detail Lowongan">
    <x-slot name="header">
        Detail Lowongan
    </x-slot>

    <div class="bg-gray-800 shadow rounded-lg border border-gray-700 overflow-hidden mb-8">
        @if($recruitment->competition && $recruitment->competition->poster_path)
            <div class="w-full h-64 sm:h-80 overflow-hidden bg-gray-900 border-b border-gray-700">
                <img src="{{ Storage::url($recruitment->competition->poster_path) }}" alt="{{ $recruitment->competition->title }}" class="w-full h-full object-contain">
            </div>
        @endif
        <div class="px-4 py-5 sm:px-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-white">{{ $recruitment->title }}</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-400">Kompetisi: {{ $recruitment->competition->title }}</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    @auth
                         @if(Auth::id() !== $recruitment->user_id)
                            <a href="#application-form" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Daftar Sekarang
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center rounded-md border border-gray-600 bg-gray-700 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Login untuk Melamar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 px-4 py-5 sm:p-0">
            <dl class="sm:divide-y sm:divide-gray-700">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Diposting Oleh</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $recruitment->user->name }}</dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Status</dt>
                    <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                        <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $recruitment->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($recruitment->status) }}
                        </span>
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-400">Deskripsi</dt>
                    <dd class="mt-1 text-sm text-gray-300 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{{ $recruitment->description }}</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- SECTION FOR PUBLIC/MAHASISWA: APPLY BUTTON --}}
    <div id="application-form" class="mt-6 flex justify-end">
        @auth
            @if(Auth::id() !== $recruitment->user_id)
                     {{-- Check if already applied --}}
                     @php
                         $hasApplied = \App\Models\Application::where('recruitment_id', $recruitment->id)->where('user_id', Auth::id())->exists();
                     @endphp

                     @if($hasApplied)
                        <button disabled class="inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-sm font-medium text-white shadow-sm cursor-not-allowed">
                            Sudah Melamar
                        </button>
                     @else
                        <form action="{{ route('applications.store', $recruitment->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="sr-only">Pesan / Motivasi</label>
                                <textarea name="message" id="message" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm text-black p-2" placeholder="Tulis pesan singkat untuk ketua tim (opsional)..."></textarea>
                            </div>
                            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Kirim Lamaran
                            </button>
                        </form>
                     @endif
                @endif
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Login untuk Melamar
                </a>
            @endauth
        </div>

</x-dashboard-layout>
