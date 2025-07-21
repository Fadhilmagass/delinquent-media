<x-app-layout>
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Hero Section --}}
            <div class="mb-14 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Selamat Datang di Dashboard Admin</h1>
                <p class="text-gray-600 text-base">Pantau konten, kelola data, dan tetap kendalikan sistem dengan mudah.
                </p>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                @php
                    $stats = [
                        [
                            'icon' => 'document-text',
                            'count' => \App\Models\Article::count(),
                            'label' => 'Artikel',
                            'color' => 'blue',
                        ],
                        [
                            'icon' => 'musical-note',
                            'count' => \App\Models\Band::count(),
                            'label' => 'Band',
                            'color' => 'green',
                        ],
                        [
                            'icon' => 'clock',
                            'count' => \App\Models\Release::count(),
                            'label' => 'Rilisan',
                            'color' => 'purple',
                        ],
                        [
                            'icon' => 'users',
                            'count' => \App\Models\User::count(),
                            'label' => 'Pengguna',
                            'color' => 'red',
                        ],
                    ];
                @endphp

                @foreach ($stats as $item)
                    <div
                        class="bg-white border-t-4 border-{{ $item['color'] }}-900 shadow-md rounded-xl p-6 hover:shadow-lg transform hover:-translate-y-1 transition duration-200">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-full bg-{{ $item['color'] }}-900 mb-4 mx-auto">
                            <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-6 h-6 text-zinc-900" />
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-{{ $item['color'] }}-700">{{ $item['count'] }}</div>
                            <div class="mt-1 text-gray-600 font-medium">Total {{ $item['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Navigasi Cepat --}}
            <div class="bg-white shadow rounded-xl p-8 mb-16">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                    <x-heroicon-o-bolt class="w-6 h-6 text-blue-600" />
                    Akses Manajemen Cepat
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
                    @php
                        $menus = [
                            [
                                'url' => '/admin/articles',
                                'icon' => 'document-text',
                                'label' => 'Kelola Artikel',
                                'color' => 'blue',
                            ],
                            [
                                'url' => '/admin/bands',
                                'icon' => 'musical-note',
                                'label' => 'Kelola Band',
                                'color' => 'green',
                            ],
                            [
                                'url' => '/admin/releases',
                                'icon' => 'clock',
                                'label' => 'Kelola Rilisan',
                                'color' => 'purple',
                            ],
                            [
                                'url' => '/admin/events',
                                'icon' => 'calendar',
                                'label' => 'Kelola Event',
                                'color' => 'yellow',
                            ],
                            [
                                'url' => '/admin/comments',
                                'icon' => 'chat-bubble-left-right',
                                'label' => 'Kelola Komentar',
                                'color' => 'red',
                            ],
                            [
                                'url' => '/admin/categories',
                                'icon' => 'list-bullet',
                                'label' => 'Kelola Kategori',
                                'color' => 'indigo',
                            ],
                            [
                                'url' => '/admin/tags',
                                'icon' => 'tag',
                                'label' => 'Kelola Tag',
                                'color' => 'pink',
                            ],
                            [
                                'url' => '/admin/users',
                                'icon' => 'users',
                                'label' => 'Kelola Pengguna',
                                'color' => 'blue',
                            ],
                        ];
                    @endphp

                    @foreach ($menus as $menu)
                        <a href="{{ url($menu['url']) }}"
                            class="flex flex-col items-center text-center bg-{{ $menu['color'] }}-50 hover:bg-{{ $menu['color'] }}-100 border border-{{ $menu['color'] }}-200 rounded-lg p-5 shadow-sm hover:shadow-md transition group">
                            <x-dynamic-component :component="'heroicon-o-' . $menu['icon']"
                                class="w-8 h-8 mb-2 text-{{ $menu['color'] }}-600 group-hover:text-{{ $menu['color'] }}-800" />
                            <span
                                class="text-sm font-medium text-{{ $menu['color'] }}-700 group-hover:text-{{ $menu['color'] }}-900">{{ $menu['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Komentar Terbaru --}}
            <div class="bg-white shadow rounded-xl p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Komentar Terbaru</h2>
                <ul class="divide-y divide-gray-200">
                    @forelse (\App\Models\Comment::latest()->take(5)->get() as $comment)
                        <li class="py-4">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">{{ $comment->user?->name ?? 'Anonim' }}</span>
                                mengomentari
                                <a href="{{ route('articles.show', $comment->article) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $comment->article->title }}
                                </a>
                            </p>
                            <p class="mt-1 text-gray-800 text-sm">{{ Str::limit($comment->body, 100) }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                        </li>
                    @empty
                        <li class="text-center text-gray-500 py-4">Belum ada komentar terbaru.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
