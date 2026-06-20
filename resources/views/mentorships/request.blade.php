<x-dashboard-layout title="Ajukan Bimbingan">
    <x-slot name="header">
        Ajukan Bimbingan Dosen
    </x-slot>

    <div class="mb-6">
        <p class="text-gray-400">Pilih dosen pembimbing untuk tim dan kompetisi yang Anda ikuti.</p>
    </div>

    @if(session('error'))
        <div class="rounded-md bg-red-50 p-4 mb-6">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-gray-800 shadow rounded-lg border border-gray-700 p-6 mb-8">
        <form action="{{ route('mentorships.store') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="competition_id" class="block text-sm font-medium text-gray-300">Pilih Kompetisi / Tim</label>
                <select name="competition_id" id="competition_id" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @forelse($recruitments as $recruitment)
                        <option value="{{ $recruitment->competition->id }}">{{ $recruitment->competition->title }} ({{ $recruitment->title }})</option>
                    @empty
                        <option disabled>Anda belum memiliki lowongan aktif</option>
                    @endforelse
                </select>
                @if($recruitments->isEmpty())
                     <p class="mt-2 text-xs text-yellow-500">Buat lowongan terlebih dahulu untuk mengajukan bimbingan.</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($lecturers as $lecturer)
                <label class="relative flex cursor-pointer rounded-lg border border-gray-700 bg-gray-750 p-4 shadow-sm focus:outline-none hover:bg-gray-700 transition">
                    <input type="radio" name="lecturer_id" value="{{ $lecturer->id }}" class="sr-only" aria-labelledby="lecturer-Label-{{ $loop->index }}">
                    <span class="flex flex-1">
                        <span class="flex flex-col">
                            <span id="lecturer-Label-{{ $loop->index }}" class="block text-sm font-medium text-white">{{ $lecturer->name }}</span>
                            <span class="mt-1 flex items-center text-sm text-gray-400">NIDN: {{ $lecturer->profile->nim ?? '-' }}</span> <!-- Assuming NIM field used for NIDN for simplicity or create specific field -->
                            <span class="mt-6 text-sm font-medium text-indigo-400">Keahlian: {{ $lecturer->profile->skills ?? '-' }}</span>
                        </span>
                    </span>
                    <svg class="h-5 w-5 text-indigo-600 hidden checked:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <!-- Add active state styling via JS or simplify UI -->
                </label>
                @endforeach
            </div>
             @error('lecturer_id')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror

            <div class="mt-8 flex justify-end">
                <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Ajukan Bimbingan
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
<script>
    // Simple script to highlight selected radio
    const radios = document.querySelectorAll('input[type="radio"]');
    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            radios.forEach(r => r.parentElement.classList.remove('ring-2', 'ring-indigo-500'));
            if(this.checked) {
                this.parentElement.classList.add('ring-2', 'ring-indigo-500');
            }
        });
    });
</script>
