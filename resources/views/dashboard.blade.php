<x-app-layout>
    <div class="bg-gray-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Header --}}
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-slate-100 sm:text-5xl">
                    Dashboard Admin
                </h1>
                <p class="mt-3 text-base text-gray-600 dark:text-slate-400">
                    Pantau konten, kelola data, dan tetap kendalikan sistem dengan mudah.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8">
                {{-- Main Content --}}
                <main class="lg:col-span-2 space-y-8">
                    {{-- Statistik --}}
                    <section>
                        @php
                            $stats = [
                                [
                                    'icon' => 'document-text',
                                    'count' => \App\Models\Article::count(),
                                    'label' => 'Total Artikel',
                                    'theme' => [
                                        'bg' => 'bg-sky-50 dark:bg-sky-900/50',
                                        'icon' => 'text-sky-600 dark:text-sky-400',
                                        'border' => 'border-sky-200 dark:border-sky-800',
                                    ],
                                ],
                                [
                                    'icon' => 'musical-note',
                                    'count' => \App\Models\Band::count(),
                                    'label' => 'Total Band',
                                    'theme' => [
                                        'bg' => 'bg-emerald-50 dark:bg-emerald-900/50',
                                        'icon' => 'text-emerald-600 dark:text-emerald-400',
                                        'border' => 'border-emerald-200 dark:border-emerald-800',
                                    ],
                                ],
                                [
                                    'icon' => 'clock',
                                    'count' => \App\Models\Release::count(),
                                    'label' => 'Total Rilisan',
                                    'theme' => [
                                        'bg' => 'bg-purple-50 dark:bg-purple-900/50',
                                        'icon' => 'text-purple-600 dark:text-purple-400',
                                        'border' => 'border-purple-200 dark:border-purple-800',
                                    ],
                                ],
                                [
                                    'icon' => 'users',
                                    'count' => \App\Models\User::count(),
                                    'label' => 'Total Pengguna',
                                    'theme' => [
                                        'bg' => 'bg-rose-50 dark:bg-rose-900/50',
                                        'icon' => 'text-rose-600 dark:text-rose-400',
                                        'border' => 'border-rose-200 dark:border-rose-800',
                                    ],
                                ],
                            ];
                        @endphp
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach ($stats as $item)
                                <div
                                    class="flex items-center p-5 {{ $item['theme']['bg'] }} border {{ $item['theme']['border'] }} rounded-2xl shadow-sm transition-transform hover:scale-[1.02] hover:shadow-md">
                                    <div class="mr-5">
                                        <x-dynamic-component :component="'heroicon-o-' . $item['icon']"
                                            class="w-9 h-9 {{ $item['theme']['icon'] }}" />
                                    </div>
                                    <div>
                                        <div class="text-3xl font-bold text-gray-900 dark:text-slate-100">
                                            {{ $item['count'] }}</div>
                                        <div class="text-sm font-medium text-gray-600 dark:text-slate-400">
                                            {{ $item['label'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    {{-- Navigasi Cepat --}}
                    <section class="bg-white dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700/50 shadow-sm rounded-2xl">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-slate-100 flex items-center gap-3">
                                <x-heroicon-o-bolt class="w-6 h-6 text-sky-500" />
                                Akses Manajemen Cepat
                            </h2>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-200 dark:bg-slate-700/50 rounded-b-2xl overflow-hidden">
                            @php
                                $menus = [
                                    ['url' => '/admin/articles', 'icon' => 'document-text', 'label' => 'Artikel'],
                                    ['url' => '/admin/bands', 'icon' => 'musical-note', 'label' => 'Band'],
                                    ['url' => '/admin/releases', 'icon' => 'clock', 'label' => 'Rilisan'],
                                    ['url' => '/admin/events', 'icon' => 'calendar', 'label' => 'Event'],
                                    ['url' => '/admin/comments', 'icon' => 'chat-bubble-left-right', 'label' => 'Komentar'],
                                    ['url' => '/admin/categories', 'icon' => 'list-bullet', 'label' => 'Kategori'],
                                    ['url' => '/admin/tags', 'icon' => 'tag', 'label' => 'Tag'],
                                    ['url' => '/admin/users', 'icon' => 'users', 'label' => 'Pengguna'],
                                ];
                            @endphp

                            @foreach ($menus as $menu)
                                <a href="{{ url($menu['url']) }}"
                                    class="flex flex-col items-center justify-center p-5 text-center bg-white dark:bg-slate-800 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors duration-200 group">
                                    <x-dynamic-component :component="'heroicon-o-' . $menu['icon']"
                                        class="w-7 h-7 mb-2 text-gray-500 dark:text-slate-400 group-hover:text-sky-500 dark:group-hover:text-sky-400" />
                                    <span
                                        class="text-sm font-medium text-gray-700 dark:text-slate-300">{{ $menu['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </section>
                </main>

                {{-- Sidebar --}}
                <aside class="mt-8 lg:mt-0">
                    <div class="bg-white dark:bg-slate-800/50 border border-gray-200 dark:border-slate-700/50 shadow-sm rounded-2xl p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-slate-100 mb-4">Komentar Terbaru</h2>
                        <ul class="space-y-5">
                            @forelse (\App\Models\Comment::with('user', 'article')->latest()->take(5)->get() as $comment)
                                <li class="flex items-start">
                                    <img class="h-9 w-9 rounded-full object-cover mr-4 mt-1"
                                        src="https://ui-avatars.com/api/?name={{ urlencode($comment->user?->name ?? 'A') }}&color=7F9CF5&background=EBF4FF"
                                        alt="{{ $comment->user?->name ?? 'Anonim' }}">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-700 dark:text-slate-300">
                                            <span
                                                class="font-semibold text-gray-900 dark:text-slate-100">{{ $comment->user?->name ?? 'Anonim' }}</span>
                                            mengomentari
                                            <a href="{{ route('articles.show', $comment->article) }}"
                                                class="font-semibold text-sky-600 dark:text-sky-400 hover:underline">
                                                {{ Str::limit($comment->article->title, 30) }}
                                            </a>
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-slate-400">{{ Str::limit($comment->body, 80) }}</p>
                                        <p class="text-xs text-gray-500 dark:text-slate-500 mt-1.5">
                                            {{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center text-gray-500 dark:text-slate-400 py-4">
                                    <div class="flex flex-col items-center">
                                        <x-heroicon-o-chat-bubble-left-ellipsis class="w-12 h-12 text-gray-400" />
                                        <p class="mt-2">Belum ada komentar terbaru.</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
