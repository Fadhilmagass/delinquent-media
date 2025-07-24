<div class="p-4 sm:p-6 lg:p-8">
    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-slate-200 sm:text-3xl">Manajemen Artikel</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Kelola semua artikel yang ada di sistem.</p>
        </div>

        <a href="{{ route('admin.articles.create') }}" wire:navigate
            class="inline-flex items-center gap-2 mt-4 sm:mt-0 px-4 py-2 font-semibold text-white bg-blue-600 dark:bg-sky-600 rounded-lg shadow-sm hover:bg-blue-700 dark:hover:bg-sky-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-slate-900">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path
                    d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
            </svg>
            Artikel Baru
        </a>
    </div>

    @if (session('status'))
        <div x-data="{ open: true }" x-show="open" x-transition
            class="flex items-center justify-between p-4 mb-4 text-sm text-green-800 dark:text-green-200 bg-green-100 dark:bg-green-900/50 rounded-lg shadow-sm"
            role="alert">
            <span>{{ session('status') }}</span>
            <button @click="open = false" class="text-green-800 dark:text-green-200 hover:text-green-900 dark:hover:text-green-100">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path
                        d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                </svg>
            </button>
        </div>
    @endif

    <div class="mb-4 flex items-center gap-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari artikel..."
            class="w-full px-4 py-2 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-sky-500 focus:border-blue-500 dark:focus:border-sky-500">

        <select wire:model.live="category"
            class="px-4 py-2 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-sky-500 focus:border-blue-500 dark:focus:border-sky-500">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-white dark:bg-slate-800 shadow-md rounded-xl overflow-hidden">
        <div class="hidden md:grid md:grid-cols-6 gap-4 px-6 py-3 bg-gray-50 dark:bg-slate-850 border-b border-gray-200 dark:border-slate-700">
            <div class="col-span-2 text-left text-xs font-semibold text-gray-600 dark:text-slate-300 uppercase tracking-wider">Judul</div>
            <div class="text-left text-xs font-semibold text-gray-600 dark:text-slate-300 uppercase tracking-wider">Penulis</div>
            <div class="text-left text-xs font-semibold text-gray-600 dark:text-slate-300 uppercase tracking-wider">Kategori</div>
            <div class="text-left text-xs font-semibold text-gray-600 dark:text-slate-300 uppercase tracking-wider">Status</div>
            <div class="text-right text-xs font-semibold text-gray-600 dark:text-slate-300 uppercase tracking-wider">Aksi</div>
        </div>

        <div>
            @forelse ($articles as $article)
                <div
                    class="grid grid-cols-1 md:grid-cols-6 gap-4 px-6 py-4 border-b border-gray-200 dark:border-slate-700 last:border-b-0 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors duration-150">
                    <div class="col-span-2 flex items-center">
                        <span class="md:hidden text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase mr-2">Judul: </span>
                        <p class="text-sm font-medium text-gray-900 dark:text-slate-200 truncate">{{ $article->title }}</p>
                    </div>
                    <div class="flex items-center">
                        <span class="md:hidden text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase mr-2">Penulis: </span>
                        <p class="text-sm text-gray-700 dark:text-slate-300">{{ $article->user->name }}</p>
                    </div>
                    <div class="flex items-center">
                        <span class="md:hidden text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase mr-2">Kategori: </span>
                        <x-badge color="green">{{ $article->category->name }}</x-badge>
                    </div>
                    <div class="flex items-center">
                        <span class="md:hidden text-xs font-semibold text-gray-500 dark:text-slate-400 uppercase mr-2">Status: </span>
                        @php
                            $statusColor =
                                $article->status === \App\Enums\Article\Status::PUBLISHED ? 'green' : 'orange';
                        @endphp
                        <x-badge :color="$statusColor">{{ $article->status->value }}</x-badge>
                    </div>
                    <div class="flex items-center justify-start md:justify-end gap-4">
                        <a href="{{ route('admin.articles.edit', $article) }}" wire:navigate
                            class="text-indigo-600 dark:text-sky-400 hover:text-indigo-900 dark:hover:text-sky-300" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path
                                    d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                <path
                                    d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                            </svg>
                        </a>
                        <button wire:click="delete({{ $article->id }})"
                            wire:confirm="Anda yakin ingin menghapus artikel ini?"
                            class="text-red-600 dark:text-red-500 hover:text-red-900 dark:hover:text-red-400" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.58.22-2.365.468a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193v-.443A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center px-6 py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mx-auto h-12 w-12 text-gray-400 dark:text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-slate-200">Belum Ada Artikel</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">Mulai dengan membuat artikel baru.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</div>
