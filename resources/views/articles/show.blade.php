{{-- resources/views/articles/show.blade.php --}}
<x-app-layout>

    {{-- 1. Scroll Progress Bar --}}
    <div class="fixed top-0 left-0 h-1.5 w-0 bg-red-500 z-50" id="progressBar"></div>

    {{-- Latar belakang halaman --}}
    <div class="bg-slate-50">
        <div class="container mx-auto py-12 px-4 md:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                {{-- Kolom utama untuk konten artikel --}}
                <main class="lg:col-span-8">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                        <article class="prose prose-lg max-w-none prose-red">
                            {{--
                                Penggunaan class `prose` dari plugin @tailwindcss/typography
                                akan secara otomatis menata tag HTML seperti <h1>, <p>, <blockquote>.
                                Pastikan plugin tersebut sudah terpasang.
                            --}}
                            {!! Cache::remember("article_content_{$article->id}", 3600, function () use ($article) {
                                return view('articles.partials.content', ['article' => $article])->render();
                            }) !!}
                        </article>
                    </div>

                    {{-- Bagian Komentar --}}
                    <div class="mt-8">
                        @livewire('comment.comment-section', ['article' => $article], key($article->id))
                    </div>
                </main>

                {{-- Sidebar untuk artikel terkait --}}
                <aside class="lg:col-span-4">
                    {{-- 2. Membuat Sidebar menjadi "Sticky" --}}
                    <div class="sticky top-12">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 border-l-4 border-red-500 pl-4">
                                Artikel Terkait
                            </h3>
                            <div class="space-y-5">
                                @forelse ($relatedArticles as $related)
                                    {{-- 3. Desain Kartu Artikel Terkait yang Ditingkatkan --}}
                                    <a href="{{ route('articles.show', $related) }}"
                                        class="block group p-4 rounded-lg transition-all duration-300 hover:bg-red-50 hover:shadow-sm">
                                        <p
                                            class="font-semibold text-gray-900 group-hover:text-red-600 transition-colors">
                                            {{ $related->title }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">{{ $related->category->name }}</p>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-500">Tidak ada artikel terkait.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>

    {{-- 4. Tambahkan JavaScript untuk Interaktivitas --}}
    @push('scripts')
        <script>
            document.addEventListener('scroll', function() {
                // Ambil elemen progress bar
                const progressBar = document.getElementById('progressBar');

                // Hitung persentase scroll
                const scrollTop = document.documentElement.scrollTop;
                const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrollPercent = (scrollTop / scrollHeight) * 100;

                // Atur lebar progress bar
                if (progressBar) {
                    progressBar.style.width = scrollPercent + '%';
                }
            });
        </script>
    @endpush

</x-app-layout>
