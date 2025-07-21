<?php

namespace App\Livewire\Comment;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Comment;

class CommentSection extends Component
{
    use WithPagination;

    public Article $article;

    public string $body = '';
    public string $name = '';
    public string $email = '';
    public string $website = ''; // Honeypot field

    public function mount()
    {
        $this->article->loadCount(['comments' => function ($query) {
            $query->where('status', 'approved');
        }]);
    }

    protected function rules()
    {
        $rules = [
            'body' => ['required', 'string', 'min:5'],
            'website' => ['present', 'max:0'], // Honeypot validation
        ];

        if (auth()->guest()) {
            $rules['name'] = ['required', 'string', 'max:255'];
            $rules['email'] = ['required', 'email', 'max:255'];
        }

        return $rules;
    }

    public function postComment()
    {
        $this->validate();

        $commentData = [
            'body' => $this->body,
            'status' => \App\Enums\Comment\Status::APPROVED->value,
        ];

        if (auth()->check()) {
            $commentData['user_id'] = auth()->id();
            $commentData['name'] = auth()->user()->name;
            $commentData['email'] = auth()->user()->email;
        } else {
            $commentData['name'] = $this->name;
            $commentData['email'] = $this->email;
        }

        $this->article->comments()->create($commentData);

        $this->reset('body', 'name', 'email');

        session()->flash('comment_success', 'Komentar Anda telah berhasil diposting.');
    }

    public function deleteComment(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        session()->flash('comment_success', 'Komentar berhasil dihapus.');
        $this->article->refresh(); // Refresh article to update comments count
    }

    public function render()
    {
        $comments = $this->article->comments()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('livewire.comment.comment-section', [
            'comments' => $comments
        ]);
    }
}
