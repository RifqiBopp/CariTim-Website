<x-dashboard-layout title="Dashboard Mahasiswa">
    <x-slot name="header">
        Dashboard Mahasiswa
    </x-slot>

    <!-- Create Lowongan Card for Mahasiswa -->
    <div class="overflow-hidden rounded-lg bg-indigo-900 shadow border border-indigo-700 mb-8">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-indigo-100">
                            Mau cari teman untuk lomba/proyek/riset dan lainnya? atau ingin membuat tim yang handal?
                        </dt>
                        <dd class="mt-2">
                            <form action="{{ route('ganti-ketua') }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded bg-white px-3 py-1.5 text-sm font-semibold text-indigo-900 shadow-sm hover:bg-indigo-50">
                                    Buat Lowongan Tim
                                </button>
                            </form>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
        <div class="overflow-hidden rounded-lg bg-gray-800 shadow border border-gray-700">
            <div class="p-5">
                <dt class="truncate text-sm font-medium text-gray-400">Total Lamaran Saya</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
                    {{ \App\Models\Application::where('user_id', Auth::id())->count() }}
                </dd>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-lg bg-gray-800 shadow border border-gray-700">
            <div class="p-5">
                 <dt class="truncate text-sm font-medium text-gray-400">Status Diterima</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-green-500">
                     {{ \App\Models\Application::where('user_id', Auth::id())->where('status', 'approved')->count() }}
                </dd>
            </div>
        </div>
    </div>

    <!-- Latest Applications -->
    <h3 class="text-lg font-medium leading-6 text-white mb-4">Status Lamaran Terbaru</h3>
    <div class="overflow-hidden bg-gray-800 shadow sm:rounded-md border border-gray-700">
        <ul role="list" class="divide-y divide-gray-700">
            @forelse(\App\Models\Application::where('user_id', Auth::id())->latest()->take(5)->get() as $application)
            <li>
                <div class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('recruitments.show', $application->recruitment->id) }}" class="truncate text-sm font-medium text-indigo-400 hover:text-indigo-300 transition">{{ $application->recruitment->title }}</a>
                        <div class="ml-2 flex flex-shrink-0">
                            @if($application->status === 'approved')
                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Diterima</span>
                            @elseif($application->status === 'rejected')
                                <span class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800">Ditolak</span>
                            @else
                                <span class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">Pending</span>
                            @endif
                        </div>
                    </div>
                     <div class="mt-2 text-sm text-gray-400">
                        <p>Posisi: Anggota Tim</p>
                    </div>
                </div>
            </li>
            @empty
             <li>
                <div class="px-4 py-4 sm:px-6 text-center text-gray-500 text-sm">
                    Belum ada lamaran yang dikirim.
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</x-dashboard-layout>