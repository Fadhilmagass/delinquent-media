<?php

namespace App\Livewire\Article;

use App\Enums\Article\Status;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ArticleForm extends Component
{
    public ?Article $article = null;

    public string $title = '';
    public int $category_id = 0;
    public string $excerpt = '';
    public string $body = '';
    public array $selectedTags = [];
    public string $status = 'draft';

    public function mount(Article $article)
    {
        if ($article->exists) {
            $this->article = $article;
            $this->title = $article->title;
            $this->category_id = $article->category_id;
            $this->excerpt = $article->excerpt;
            $this->body = $article->body;
            $this->status = $article->status->value;
            $this->selectedTags = $article->tags->pluck('id')->toArray();
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'excerpt' => ['required', 'string', 'min:20'],
            'body' => ['required', 'string', 'min:50'],
            'selectedTags' => ['required', 'array'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $data = array_merge($validated, [
            'user_id' => auth()->id(),
            'published_at' => ($this->status === 'published') ? now() : null,
        ]);

        if (is_null($this->article)) {
            // Create new article
            $article = Article::create($data);
        } else {
            // Update existing article
            $this->article->update($data);
            $article = $this->article;
        }

        $article->tags()->sync($this->selectedTags);

        session()->flash('status', 'Article successfully saved.');
        return $this->redirectRoute('articles.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.article.article-form', [
            'categories' => Category::pluck('name', 'id'),
            'allTags' => Tag::pluck('name', 'id'),
        ])->layout('layouts.app');
    }
}
