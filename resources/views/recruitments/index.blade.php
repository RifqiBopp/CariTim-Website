<x-dashboard-layout title="Lowongan Tim">
    <x-slot name="header">
        Daftar Lowongan Tim
    </x-slot>

    <div x-data="{ 
        applicationModalOpen: false, 
        selectedRecruitmentId: null, 
        selectedRecruitmentTitle: '',
        openApplicationModal(id, title) {
            this.selectedRecruitmentId = id;
            this.selectedRecruitmentTitle = title;
            this.applicationModalOpen = true;
        }
    }">
        <div class="mb-6">
            <p class="text-gray-400 text-lg">Temukan tim impianmu atau bangun kolaborasi hebat di sini.</p>
        </div>

        <!-- Recruitments Grid -->
        @if($recruitments->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-white">Belum ada lowongan</h3>
                <p class="mt-1 text-sm text-gray-400">Jadilah yang pertama membuka kesempatan!</p>
                @auth
                     @if(Auth::user()->role === 'mahasiswa')
                        <div class="mt-6">
                             <form action="{{ route('ganti-ketua') }}" method="POST">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Buat Lowongan Baru
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($recruitments as $recruitment)
                    <div class="bg-gray-800 overflow-hidden shadow rounded-lg border border-gray-700 hover:border-indigo-500 transition-colors duration-200 flex flex-col h-full">
                        @if($recruitment->competition && $recruitment->competition->poster_path)
                            <div class="h-48 w-full overflow-hidden bg-gray-900 border-b border-gray-700 group-hover:opacity-75 transition-opacity">
                                <img src="{{ Storage::url($recruitment->competition->poster_path) }}" alt="{{ $recruitment->competition->title }}" class="h-full w-full object-cover object-center">
                            </div>
                        @endif
                        <div class="px-4 py-5 sm:p-6 flex-1">
                            <div class="flex items-center justify-between mb-2">
                                 <div class="flex items-center">
                                    <span class="h-2 w-2 rounded-full bg-green-400 mr-2"></span>
                                    <span class="text-xs font-semibold uppercase tracking-wider text-green-400">Open</span>
                                </div>
                                <span class="text-xs text-gray-500">{{ $recruitment->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="text-lg leading-6 font-medium text-white mb-2 line-clamp-2">
                                <a href="{{ route('recruitments.show', $recruitment->id) }}" class="hover:text-indigo-400 transition">{{ $recruitment->title }}</a>
                            </h3>
                            <p class="text-sm text-indigo-300 font-medium mb-4">{{ $recruitment->competition?->title ?? 'Kompetisi Umum' }}</p>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                {{ $recruitment->description }}
                            </p>
                        </div>
                        <div class="bg-gray-700/50 px-4 py-4 sm:px-6 mt-auto">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                           {{ substr($recruitment->user?->name ?? '?', 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-white group-hover:text-gray-900">
                                           {{ Str::limit($recruitment->user?->name ?? 'User Tidak Dikenal', 15) }}
                                        </p>
                                        <p class="text-xs font-medium text-gray-400 group-hover:text-gray-700">
                                            Ketua Tim
                                        </p>
                                    </div>
                                </div>
                                
                                @auth
                                    @if(Auth::id() !== $recruitment->user_id)
                                        @php
                                            $myApplication = $recruitment->applications->where('user_id', Auth::id())->first();
                                        @endphp

                                        <div class="flex space-x-2">
                                            <a href="{{ route('recruitments.show', $recruitment->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-600 shadow-sm text-xs font-medium rounded text-gray-300 bg-gray-600 hover:bg-gray-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                Detail
                                            </a>

                                            @if($myApplication)
                                                {{-- Application Status Badge --}}
                                                @if($myApplication->status == 'approved')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Diterima
                                                    </span>
                                                @elseif($myApplication->status == 'rejected')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Ditolak
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        Menunggu
                                                    </span>
                                                @endif
                                            @else
                                                {{-- MODAL TRIGGER FOR DAFTAR --}}
                                                <button @click="openApplicationModal({{ $recruitment->id }}, '{{ addslashes($recruitment->title) }}')" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                    Daftar
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        <div class="flex space-x-2">
                                            <a href="{{ route('recruitments.show', $recruitment->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-600 shadow-sm text-xs font-medium rounded text-gray-300 bg-gray-600 hover:bg-gray-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                Detail
                                            </a>
                                            @if(Auth::user()->role === 'ketua_tim')
                                            <a href="{{ route('recruitments.applicants', $recruitment->id) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                Lihat Pelamar
                                            </a>
                                            @endif
                                        </div>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Login to Apply
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Application Modal -->
        <div x-show="applicationModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="applicationModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" @click="applicationModalOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-show="applicationModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 border border-gray-700">
                    <div>
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-indigo-900/50 text-indigo-400">
                           <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">Lamar Posisi</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-400">
                                    Anda akan melamar untuk posisi di tim lowongan: <span class="font-bold text-white" x-text="selectedRecruitmentTitle"></span>.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <form :action="'/apply/' + selectedRecruitmentId" method="POST" class="mt-5 sm:mt-6">
                        @csrf
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 text-left">Pesan / Motivasi (Opsional)</label>
                            <div class="mt-1">
                                <textarea name="message" id="message" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-600 bg-gray-700 text-white rounded-md mb-2 p-2" placeholder="Halo, saya tertarik bergabung karena..."></textarea>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                                Kirim Lamaran
                            </button>
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-600 shadow-sm px-4 py-2 bg-gray-700 text-base font-medium text-gray-300 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" @click="applicationModalOpen = false">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>
