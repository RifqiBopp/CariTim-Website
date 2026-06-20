<x-dashboard-layout title="Daftar Pelamar">
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                Pelamar: {{ $recruitment->title }}
            </h2>
            <a href="{{ route('recruitments.manage') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
                &larr; Kembali ke Kelola Lowongan
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-800 shadow rounded-lg border border-gray-700 overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-700 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-white">Daftar Pelamar Masuk</h3>
             <span class="inline-flex items-center rounded-md bg-indigo-400/10 px-2 py-1 text-xs font-medium text-indigo-400 ring-1 ring-inset ring-indigo-400/30">{{ $recruitment->applications->count() }} Total</span>
        </div>
        
        <ul role="list" class="divide-y divide-gray-700">
            @forelse($recruitment->applications as $application)
            <li class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition duration-150 ease-in-out">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center mb-4 sm:mb-0">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($application->user->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-white">{{ $application->user->name }}</div>
                            <div class="text-sm text-gray-400">{{ $application->user->email }}</div>
                            <div class="mt-1 text-xs text-gray-500">
                                NIM: {{ $application->user->profile->nim ?? '-' }}
                            </div>
                            <div class="mt-1 text-sm text-gray-400">
                                <span class="font-medium text-gray-300">Bio:</span> {{ $application->user->profile->bio ?? '-' }}
                            </div>
                            <div class="mt-1 text-sm text-gray-400">
                                <span class="font-medium text-gray-300">Skills:</span> {{ $application->user->profile->skills ?? '-' }}
                            </div>
                            @if($application->user->profile?->portfolio_link)
                            <div class="mt-1 text-sm">
                                <a href="{{ $application->user->profile->portfolio_link }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 underline">
                                    Lihat Portofolio
                                </a>
                            </div>
                            @endif
                            @if($application->message)
                            <div class="mt-2 text-sm text-gray-300 italic bg-gray-700/50 p-2 rounded border border-gray-600">
                                "{{ $application->message }}"
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 sm:ml-4">
                         @if($application->status === 'pending')
                            <form action="{{ route('applications.update', $application->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="inline-flex items-center rounded-md bg-green-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Terima
                                </button>
                            </form>
                            <form action="{{ route('applications.update', $application->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                                    <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Tolak
                                </button>
                            </form>
                         @else
                            <div class="flex flex-col items-end">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                                <span class="text-xs text-gray-500 mt-1">Diproses {{ $application->updated_at->diffForHumans() }}</span>
                            </div>
                         @endif
                    </div>
                </div>
            </li>
            @empty
            <li class="px-4 py-12 text-center text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-white">Belum ada pelamar</h3>
                <p class="mt-1 text-sm text-gray-400">Lowongan ini belum menerima lamaran apapun.</p>
            </li>
            @endforelse
        </ul>
    </div>
</x-dashboard-layout>
