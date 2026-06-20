<x-dashboard-layout title="Lamaran Saya">
    <x-slot name="header">
        Riwayat Lamaran Saya
    </x-slot>

    <div class="mb-6">
        <p class="text-gray-400">Pantau status lamaran yang telah Anda kirimkan.</p>
    </div>

    @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 mb-6">
            <div class="flex">
                 <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                 <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

     <div class="overflow-hidden bg-gray-800 shadow sm:rounded-lg border border-gray-700">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-700">
            <h3 class="text-lg leading-6 font-medium text-white">Daftar Lamaran</h3>
        </div>
        <ul role="list" class="divide-y divide-gray-700">
             @forelse($applications as $application)
            <li>
                <div class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-indigo-400 truncate">{{ $application->recruitment->title }}</p>
                             <p class="text-xs text-gray-500 mt-1">Kompetisi: {{ $application->recruitment->competition->title }}</p>
                        </div>
                        <div class="ml-2 flex-shrink-0 flex">
                            @if($application->status === 'approved')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                            @elseif($application->status === 'rejected')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                            @endif
                        </div>
                    </div>
                     <div class="mt-2 sm:flex sm:justify-between">
                        <div class="sm:flex">
                             <p class="flex items-center text-sm text-gray-400">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Ketua Tim: {{ $application->recruitment->user->name }}
                            </p>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-400 sm:mt-0">
                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p>Diajukan pada {{ $application->created_at->format('d M Y') }}</p>
                        </div>
                        
                         @if($application->status === 'pending')
                        <div class="mt-2 text-sm sm:mt-0 sm:ml-2">
                            <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan lamaran ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-medium hover:underline">Batalkan</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </li>
            @empty
             <li>
                <div class="px-4 py-8 sm:px-6 text-center text-gray-500">
                    Belum ada lamaran yang diajukan.
                    <div class="mt-2">
                        <a href="{{ route('recruitments.index') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Cari Lowongan &rarr;</a>
                    </div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</x-dashboard-layout>
