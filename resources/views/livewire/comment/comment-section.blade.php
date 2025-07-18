<div class="mt-12">
    <h3 class="text-2xl font-bold mb-6">
        Komentar ({{ $article->comments()->where('status', 'approved')->count() }})
    </h3>

    {{-- Form Kirim Komentar --}}
    <div class="bg-gray-100 p-6 rounded-xl mb-10 shadow-sm">
        @if (session('comment_success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-md" role="alert">
                {{ session('comment_success') }}
            </div>
        @endif

        <form wire:submit.prevent="postComment">
            @guest
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label for="guestName" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" id="guestName" wire:model.defer="guestName"
                            class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        @error('guestName')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="guestEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="guestEmail" wire:model.defer="guestEmail"
                            class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        @error('guestEmail')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endguest

            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Tulis Komentar Anda</label>
                <textarea id="body" wire:model.debounce.500ms="body" rows="4"
                    class="w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                    placeholder="Apa pendapatmu?"></textarea>
                @error('body')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="inline-block px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-md transition duration-200">
                    Kirim Komentar
                </button>
            </div>
        </form>
    </div>

    {{-- Daftar Komentar --}}
    <div class="space-y-6">
        @forelse ($comments as $comment)
            <div class="flex items-start space-x-4" wire:key="comment-{{ $comment->id }}">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    <div
                        class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg uppercase">
                        {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                    </div>
                </div>

                {{-- Konten Komentar --}}
                <div class="flex-1">
                    <div class="bg-white border border-gray-200 p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-900">{{ $comment->author_name }}</span>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-2 text-gray-800">{{ $comment->body }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 text-sm">Jadilah yang pertama berkomentar!</p>
        @endforelse
    </div>

    {{-- Navigasi Halaman Komentar --}}
    <div class="mt-8">
        {{ $comments->links() }}
    </div>
</div>
