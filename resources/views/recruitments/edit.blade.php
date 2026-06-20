<x-dashboard-layout title="Edit Lowongan">
    <x-slot name="header">
        Edit Lowongan: {{ $recruitment->title }}
    </x-slot>

    <div class="max-w-3xl mx-auto bg-gray-800 shadow rounded-lg border border-gray-700 p-6">
        <form action="{{ route('recruitments.update', $recruitment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-5">
                <label for="title" class="block text-sm font-medium text-gray-300">Judul Lowongan</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('title', $recruitment->title) }}">
                @error('title')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

             <div class="mb-5">
                <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi & Persyaratan</label>
                <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $recruitment->description) }}</textarea>
                 @error('description')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="status" class="block text-sm font-medium text-gray-300">Status</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="open" {{ $recruitment->status == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ $recruitment->status == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-x-3">
                <a href="{{ route('recruitments.manage') }}" class="rounded-md border border-gray-600 bg-gray-700 px-4 py-2 text-sm font-medium text-gray-300 shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Batal</a>
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-dashboard-layout>
