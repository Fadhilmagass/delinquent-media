<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-slate-200 mb-8">
            Edit Band
        </h1>

        <div class="bg-white dark:bg-slate-800 shadow-md rounded-lg p-8">
            <form action="{{ route('bands.update', $band) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Band Name</label>
                    <x-text-input type="text" name="name" id="name" class="w-full" value="{{ $band->name }}" required />
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Origin</label>
                        <x-text-input type="text" name="origin" id="origin" class="w-full" value="{{ $band->origin }}" />
                    </div>
                    <div>
                        <label for="genre" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Genre</label>
                        <x-text-input type="text" name="genre" id="genre" class="w-full" value="{{ $band->genre }}" />
                    </div>
                </div>

                <div class="mb-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Biography</label>
                    <textarea name="bio" id="bio" rows="6" class="w-full border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-md shadow-sm focus:border-blue-500 dark:focus:border-sky-500 focus:ring-blue-500 dark:focus:ring-sky-500">{{ $band->bio }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-2">Photo</label>
                    <input type="file" name="photo" id="photo" class="w-full border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-md shadow-sm focus:border-blue-500 dark:focus:border-sky-500 focus:ring-blue-500 dark:focus:ring-sky-500">
                    @if ($band->getFirstMediaUrl('band-photos'))
                        <img src="{{ $band->getFirstMediaUrl('band-photos') }}" alt="{{ $band->name }}" class="mt-4 h-32 rounded-md">
                    @endif
                </div>

                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        Update Band
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
