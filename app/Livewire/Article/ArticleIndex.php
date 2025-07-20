<?php

namespace App\Livewire\Article;

use App\Models\Article;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';

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
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.article.article-index', [
            'articles' => $articles,
            'categories' => Category::all(),
        ])->layout('layouts.app');
    }
}
