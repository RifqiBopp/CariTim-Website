<x-dashboard-layout title="Kelola Lowongan">
    <x-slot name="header">
        Kelola Lowongan Tim Saya
    </x-slot>

    <div class="mb-6 flex justify-between items-center">
        <p class="text-gray-400">Daftar lowongan yang Anda buat.</p>
        <a href="{{ route('recruitments.create') }}" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Buat Lowongan
        </a>
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
        <ul role="list" class="divide-y divide-gray-700">
            @forelse($recruitments as $recruitment)
            <li>
                <div class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div class="flex-1 min-w-0 mb-4 sm:mb-0">
                        <div class="flex items-center justify-between sm:justify-start mb-2">
                             <h3 class="text-lg font-medium leading-6 text-white truncate mr-3">{{ $recruitment->title }}</h3>
                              <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 {{ $recruitment->status === 'open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($recruitment->status) }}
                            </span>
                        </div>
                        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                            <div class="mt-2 flex items-center text-sm text-gray-400">
                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                {{ $recruitment->competition->title }}
                            </div>
                            <a href="{{ route('recruitments.applicants', $recruitment->id) }}" class="mt-2 flex items-center text-sm text-gray-400 hover:text-indigo-400 transition-colors">
                                <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                {{ $recruitment->applications->count() }} Pelamar
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('recruitments.edit', $recruitment->id) }}" class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">Edit</a>
                         <span class="text-gray-600">|</span>
                        <a href="{{ route('recruitments.applicants', $recruitment->id) }}" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                            Lihat Pelamar
                        </a>  <span class="text-gray-600">|</span>
                        <form action="{{ route('recruitments.destroy', $recruitment->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium">Hapus</button>
                        </form>
                    </div>
                </div>
            </li>
            @empty
             <li>
                <div class="px-4 py-12 sm:px-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-white">Belum ada lowongan</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai buat tim Anda sekarang.</p>
                     <div class="mt-6">
                        <a href="{{ route('recruitments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                             Buat Lowongan
                        </a>
                    </div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>

</x-dashboard-layout>
