<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">
            Add New Band
        </h1>

        <div class="bg-white shadow-md rounded-lg p-8">
            <form action="{{ route('bands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Band Name</label>
                    <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700 mb-2">Origin</label>
                        <input type="text" name="origin" id="origin" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="genre" class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                        <input type="text" name="genre" id="genre" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Biography</label>
                    <textarea name="bio" id="bio" rows="6" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <div class="mb-6">
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                    <input type="file" name="photo" id="photo" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300">
                        Save Band
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
