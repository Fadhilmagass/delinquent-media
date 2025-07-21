<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Menampilkan daftar artikel yang sudah di-publish untuk publik.
     */
    public function index(Request $request)
    {
        $query = Article::query()
            ->with(['user', 'category']) // Eager loading untuk performa
            ->where('status', 'published');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $articles = $query->latest('published_at')->paginate(10)->withQueryString(); // Paginasi standar untuk halaman publik

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        // Hanya artikel PUBLISHED yang bisa dilihat publik
        if ($article->status !== \App\Enums\Article\Status::PUBLISHED) {
            abort(404);
        }

        // Performa: Eager load relasi
        $article->load(['user', 'category', 'tags']);

        /**
         * Ambil Artikel Terkait (dari kategori yang sama, kecuali artikel ini)
         */
        $relatedArtciles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->with('category')
            ->latest('published_at')
            ->limit(3)
            ->get();

        /**
         * Render konten Markdown ke HTML
         */
        $article->body = Str::markdown($article->body);

        return view('articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArtciles,
        ]);
    }
}
