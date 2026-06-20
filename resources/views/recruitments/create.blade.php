<x-dashboard-layout title="Buat Lowongan">
    <x-slot name="header">
        Buat Lowongan Tim Baru
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('recruitments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Section: Detail Kompetisi -->
            <div class="bg-gray-800 shadow rounded-lg border border-gray-700 p-6 mb-6">
                <h3 class="text-lg font-medium leading-6 text-white mb-4 border-b border-gray-700 pb-2">Detail Kompetisi</h3>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    {{-- Judul Kompetisi --}}
                    <div class="col-span-2">
                        <label for="competition_title" class="block text-sm font-medium text-gray-300">Nama Kompetisi</label>
                        <input type="text" name="competition_title" id="competition_title" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Gemastik 2026" value="{{ old('competition_title') }}" required>
                        @error('competition_title')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-300">Kategori</label>
                        <input type="text" name="category" id="category" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Pengembangan Perangkat Lunak" value="{{ old('category') }}" required>
                        @error('category')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Penyelenggara --}}
                    <div>
                        <label for="organizer" class="block text-sm font-medium text-gray-300">Penyelenggara</label>
                        <input type="text" name="organizer" id="organizer" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Puspresnas" value="{{ old('organizer') }}" required>
                        @error('organizer')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deadline --}}
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-300">Tenggat Pendaftaran</label>
                        <input type="date" name="deadline" id="deadline" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('deadline') }}" required>
                        @error('deadline')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Link Guidebook --}}
                    <div>
                        <label for="link_guidebook" class="block text-sm font-medium text-gray-300">Link Guidebook / Info</label>
                        <input type="url" name="link_guidebook" id="link_guidebook" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://..." value="{{ old('link_guidebook') }}">
                        @error('link_guidebook')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Poster --}}
                    <div class="col-span-2">
                        <label for="poster" class="block text-sm font-medium text-gray-300">Upload Poster (Opsional)</label>
                        <input type="file" name="poster" id="poster" accept="image/*" class="mt-1 block w-full text-sm text-gray-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-indigo-600 file:text-white
                            hover:file:bg-indigo-700
                        ">
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, JPEG. Max: 2MB.</p>
                        @error('poster')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Detail Lowongan Tim -->
            <div class="bg-gray-800 shadow rounded-lg border border-gray-700 p-6 mb-6">
                <h3 class="text-lg font-medium leading-6 text-white mb-4 border-b border-gray-700 pb-2">Detail Lowongan Tim</h3>

                <div class="space-y-6">
                    {{-- Judul Lowongan --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300">Judul Lowongan</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Contoh: Dicari Frontend & UI/UX" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi & Posisi yang Dicari</label>
                        <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Jelaskan kebutuhan tim Anda secara detail...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-300">Status Lowongan</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open (Dibuka)</option>
                            <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Closed (Ditutup)</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-x-3">
                <a href="{{ route('recruitments.manage') }}" class="rounded-md border border-gray-600 bg-gray-700 px-4 py-2 text-sm font-medium text-gray-300 shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Batal</a>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Buat Lowongan</button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
