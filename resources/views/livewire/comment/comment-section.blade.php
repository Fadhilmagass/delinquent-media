<div class="mt-12">
    <h3 class="text-2xl font-bold mb-6 text-slate-800 dark:text-slate-200">
        Komentar ({{ $article->comments_count }})
    </h3>

    {{-- Form Kirim Komentar --}}
    <div class="bg-gray-100 dark:bg-slate-800 p-4 sm:p-6 rounded-xl mb-10 shadow-sm">
        @if (session('comment_success'))
            <div class="p-3 sm:p-4 mb-4 text-sm text-green-700 dark:text-green-200 bg-green-100 dark:bg-green-900/50 rounded-md" role="alert">
                {{ session('comment_success') }}
            </div>
        @endif

        <form wire:submit.prevent="postComment">
            @guest
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4 mb-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Nama</label>
                        <x-text-input type="text" id="name" wire:model.defer="name" class="w-full text-sm" placeholder="Nama Anda" />
                        @error('name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Email</label>
                        <x-text-input type="email" id="email" wire:model.defer="email" class="w-full text-sm" placeholder="Email Anda (tidak akan dipublikasikan)" />
                        @error('email')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endguest

            <div class="mb-4" style="display: none;">
                <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                <input type="text" id="website" wire:model.defer="website">
            </div>

            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">
                    @auth
                        Tulis Komentar Anda
                    @else
                        Komentar
                    @endauth
                </label>
                <textarea id="body" wire:model.defer="body" rows="4"
                    class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 focus:ring-blue-500 dark:focus:ring-sky-500 focus:border-blue-500 dark:focus:border-sky-500 shadow-sm text-sm"
                    placeholder="Apa pendapatmu?"></textarea>
                @error('body')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-primary-button type="submit">
                    Kirim Komentar
                </x-primary-button>
            </div>
        </form>
    </div>

    {{-- Daftar Komentar --}}
    <div class="space-y-6">
        @forelse ($comments as $comment)
            <div class="flex items-start space-x-2 sm:space-x-4" wire:key="comment-{{ $comment->id }}">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-blue-100 dark:bg-sky-900 flex items-center justify-center text-blue-600 dark:text-sky-300 font-bold text-base sm:text-lg uppercase">
                        {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                    </div>
                </div>

                {{-- Konten Komentar --}}
                <div class="flex-1">
                    <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 p-3 sm:p-4 rounded-lg shadow-sm">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-900 dark:text-slate-200 text-sm sm:text-base">{{ $comment->author_name }}</span>
                            <span class="text-xs text-gray-500 dark:text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="mt-2 text-gray-800 dark:text-slate-300 text-sm sm:text-base">{{ $comment->body }}</p>
                        @can('delete', $comment)
                            <button wire:click="deleteComment({{ $comment->id }})" onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?') || event.stopImmediatePropagation()" class="text-red-500 hover:underline mt-2 text-xs sm:text-sm">Hapus</button>
                        @endcan
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 dark:text-slate-400 text-sm">Jadilah yang pertama berkomentar!</p>
        @endforelse
    </div>

    {{-- Navigasi Halaman Komentar --}}
    <div class="mt-8">
        {{ $comments->links() }}
    </div>
</div>
