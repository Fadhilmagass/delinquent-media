<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleIndex extends Component
{
    use WithPagination;

    public function delete(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        session()->flash('status', 'Article successfully deleted.');
        return $this->redirectRoute('articles.index', navigate: true);
    }

    public function render()
    {
        $articles = Article::with(['user', 'category'])
            ->latest()
            ->paginate(10); // Paginasi standar yang simpel

        return view('livewire.article.article-index', [
            'articles' => $articles,
        ])->layout('layouts.app');
    }
}
