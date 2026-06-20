<x-dashboard-layout title="Dashboard Ketua Tim">
    <x-slot name="header">
        Dashboard Ketua Tim
    </x-slot>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-8">
        <div class="overflow-hidden rounded-lg bg-gray-800 shadow border border-gray-700">
            <div class="p-5">
                <dt class="truncate text-sm font-medium text-gray-400">Lowongan Aktif</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
                     {{ \App\Models\Recruitment::where('user_id', Auth::id())->where('status', 'open')->count() }}
                </dd>
            </div>
        </div>
        
        <div class="overflow-hidden rounded-lg bg-gray-800 shadow border border-gray-700">
            <div class="p-5">
                 <dt class="truncate text-sm font-medium text-gray-400">Total Pelamar</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-white">
                     {{ \App\Models\Recruitment::where('user_id', Auth::id())->withCount('applications')->get()->sum('applications_count') }}
                </dd>
            </div>
        </div>

         <div class="overflow-hidden rounded-lg bg-gray-800 shadow border border-gray-700">
            <div class="p-5">
                 <dt class="truncate text-sm font-medium text-gray-400">Menunggu Review</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-yellow-500">
                     {{ \App\Models\Application::whereHas('recruitment', function($q) { $q->where('user_id', Auth::id()); })->where('status', 'pending')->count() }}
                </dd>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium leading-6 text-white">Pelamar Terbaru</h3>
        <a href="{{ route('recruitments.manage') }}" class="text-sm font-medium text-indigo-400 hover:text-indigo-300">Kelola Lowongan &rarr;</a>
    </div>
    
    <div class="overflow-hidden bg-gray-800 shadow sm:rounded-md border border-gray-700">
        <ul role="list" class="divide-y divide-gray-700">
             @forelse(\App\Models\Application::whereHas('recruitment', function($q) { $q->where('user_id', Auth::id()); })->where('status', 'pending')->latest()->take(5)->get() as $application)
            <li>
                <div class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition block">
                     <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($application->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-white">{{ $application->user->name }}</p>
                                <p class="text-xs text-gray-500">Melamar untuk: <span class="text-indigo-400">{{ $application->recruitment->title }}</span></p>
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 ml-2">
                             <a href="{{ route('recruitments.show', $application->recruitment->id) }}" class="inline-flex items-center rounded-md border border-gray-600 bg-gray-700 px-2.5 py-1.5 text-xs font-medium text-gray-300 shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Review
                            </a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-sm text-gray-400 italic">"{{ Str::limit($application->message, 100) }}"</p>
                    </div>
                </div>
            </li>
            @empty
             <li>
                <div class="px-4 py-4 sm:px-6 text-center text-gray-500 text-sm">
                    Tidak ada pelamar baru yang menunggu review.
                </div>
            </li>
            @endforelse
        </ul>
    </div>

    <!-- Mentorship Status Section -->
    <h3 class="text-lg font-medium leading-6 text-white mt-8 mb-4">Status Pengajuan Bimbingan</h3>
    <div class="overflow-hidden bg-gray-800 shadow sm:rounded-md border border-gray-700">
        <ul role="list" class="divide-y divide-gray-700">
            @forelse(\App\Models\Mentorship::where('student_id', Auth::id())->latest()->take(5)->get() as $mentorship)
            <li>
                <div class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-indigo-400">{{ $mentorship->competition->title ?? 'Kompetisi' }}</p>
                            <p class="text-xs text-gray-500">Dosen Pembimbing: <span class="text-white">{{ $mentorship->lecturer->name }}</span></p>
                        </div>
                        <div class="flex-shrink-0">
                             <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 
                                {{ $mentorship->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($mentorship->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($mentorship->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </li>
            @empty
            <li>
                <div class="px-4 py-4 sm:px-6 text-center text-gray-500 text-sm">
                    Belum ada pengajuan bimbingan.
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</x-dashboard-layout>
