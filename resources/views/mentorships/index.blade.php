<x-dashboard-layout title="Kelola Bimbingan">
    <x-slot name="header">
        Permintaan Bimbingan
    </x-slot>

    <div class="bg-gray-800 shadow rounded-lg border border-gray-700 overflow-hidden">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-white">Daftar Permintaan Bimbingan</h3>
        </div>
        <div class="border-t border-gray-700">
            <ul role="list" class="divide-y divide-gray-700">
                @forelse($mentorships as $mentorship)
                <li class="px-4 py-4 sm:px-6 hover:bg-gray-750 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-indigo-400 truncate">{{ $mentorship->competition->title }}</p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $mentorship->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($mentorship->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($mentorship->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 flex">
                                <div class="flex items-center text-sm text-gray-400">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <p>{{ $mentorship->student->name }} ({{ $mentorship->student->email }})</p>
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-400 italic">
                                "{{ $mentorship->message ?? 'Tidak ada pesan' }}"
                            </div>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex flex-col space-y-2">
                            @if($mentorship->status === 'pending')
                                <form action="{{ route('mentorships.update', $mentorship->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('mentorships.update', $mentorship->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        Tolak
                                    </button>
                                </form>
                            @else
                                <span class="text-sm text-gray-500 text-center">Sudah diproses</span>
                            @endif
                        </div>
                    </div>
                </li>
                @empty
                <li class="px-4 py-8 text-center text-gray-500 text-sm">
                    Belum ada permintaan bimbingan.
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</x-dashboard-layout>
