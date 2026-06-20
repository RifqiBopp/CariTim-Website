<x-dashboard-layout title="Dashboard Dosen">
    <x-slot name="header">
        Dashboard Dosen
    </x-slot>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
        <div class="overflow-hidden rounded-lg bg-gray-800 shadow border border-gray-700">
            <div class="p-5">
                <dt class="truncate text-sm font-medium text-gray-400">Permintaan Bimbingan</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
                     {{ \App\Models\Mentorship::where('lecturer_id', Auth::id())->where('status', 'pending')->count() }}
                </dd>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-lg bg-gray-800 shadow border border-gray-700">
            <div class="p-5">
                 <dt class="truncate text-sm font-medium text-gray-400">Tim Bimbingan Aktif</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-green-500">
                     {{ \App\Models\Mentorship::where('lecturer_id', Auth::id())->where('status', 'approved')->count() }}
                </dd>
            </div>
        </div>
    </div>

    <h3 class="text-lg font-medium leading-6 text-white mb-4">Permintaan Bimbingan Terbaru</h3>
    <div class="overflow-hidden bg-gray-800 shadow sm:rounded-md border border-gray-700">
        <ul role="list" class="divide-y divide-gray-700">
            @forelse(\App\Models\Mentorship::where('lecturer_id', Auth::id())->where('status', 'pending')->latest()->take(5)->get() as $mentorship)
            <li>
                <div class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition block">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                             <div class="h-8 w-8 rounded-full bg-purple-600 flex items-center justify-center text-white text-xs font-bold">
                                {{ substr($mentorship->student->name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">{{ $mentorship->student->name }}</p>
                                <p class="text-xs text-gray-500">Kompetisi: <span class="text-indigo-400">{{ $mentorship->competition->title }}</span></p>
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 ml-2">
                             <a href="{{ route('mentorships.index') }}" class="inline-flex items-center rounded-md border border-gray-600 bg-gray-700 px-2.5 py-1.5 text-xs font-medium text-gray-300 shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Review
                            </a>
                        </div>
                    </div>
                     <div class="mt-2 text-sm text-gray-400">
                        <p>Pesan: "{{ Str::limit($mentorship->message, 50) }}"</p>
                    </div>
                </div>
            </li>
            @empty
             <li>
                <div class="px-4 py-4 sm:px-6 text-center text-gray-500 text-sm">
                    Tidak ada permintaan bimbingan baru.
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</x-dashboard-layout>
