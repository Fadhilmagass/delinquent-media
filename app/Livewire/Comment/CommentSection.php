<?php

namespace App\Livewire\Comment;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class CommentSection extends Component
{
    use WithPagination;

    public Article $article;

    public string $body = '';
    public string $guestName = '';
    public string $guestEmail = '';

    protected function rules()
    {
        $rules = [
            'body' => ['required', 'string', 'min:5'],
        ];

        if (auth()->guest()) {
            $rules['guestName'] = ['required', 'string', 'max:255'];
            $rules['guestEmail'] = ['required', 'email', 'max:255'];
        }

        return $rules;
    }

    public function postComment()
    {
        $this->validate();

        $this->article->comments()->create([
            'user_id' => auth()->id(),
            'name' => auth()->check() ? auth()->user()->name : $this->guestName,
            'email' => auth()->check() ? auth()->user()->email : $this->guestEmail,
            'body' => $this->body,
        ]);

        $this->reset('body', 'guestName', 'guestEmail');

        session()->flash('comment_success', 'Komentar Anda telah dikirim dan sedang menunggu moderasi.');
    }

    public function render()
    {
        $comments = $this->article->comments()
            ->with('user')
            ->where('status', 'approved')
            ->latest()
            ->paginate(10); // ✅ solusi penting

        return view('livewire.comment.comment-section', [
            'comments' => $comments
        ])->layout('layouts.app');
    }
}
