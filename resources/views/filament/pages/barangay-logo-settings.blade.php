<x-filament::page>
    <div class="flex flex-col items-center space-y-6">
        @if ($barangayLogo && $barangayLogo->logo_path)
            <div>
                <img src="{{ asset('storage/' . $barangayLogo->logo_path) }}" alt="Barangay Logo"
                    class="w-32 h-32 object-cover rounded-md shadow">
            </div>
        @endif

        <form wire:submit.prevent="updateLogo" class="w-full max-w-md space-y-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Logo</label>

            <!-- File Upload Button -->
            <label
                class="flex items-center px-4 py-2 bg-white text-blue-600 rounded shadow cursor-pointer hover:bg-blue-50 border border-gray-300 dark:bg-gray-800 dark:text-blue-400 dark:border-gray-600 dark:hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M4 12l1.41-1.41a2 2 0 012.83 0L12 15l3.76-3.76a2 2 0 012.83 0L20 12M12 4v11" />
                </svg>
                Choose Image
                <input type="file" wire:model="newLogo" accept="image/*" class="hidden" />
            </label>

            @error('newLogo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <x-filament::button type="submit">
                Update Logo
            </x-filament::button>
        </form>

        @if (session()->has('success'))
            <div class="p-4 text-green-700 bg-green-100 rounded dark:bg-green-900 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif
    </div>
</x-filament::page>
