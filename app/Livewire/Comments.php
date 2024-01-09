<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $exhibitionId;
    public $newComment;
    public $editingCommentId = null;
    public $editingCommentBody = '';

    public function addComment()
    {
        $this->validate(['newComment' => 'required|max:255']);
        Comment::create([
            'body' => $this->newComment,
            'exhibition_id' => $this->exhibitionId,
            'user_id' => auth()->id(),
        ]);
        $this->newComment = '';
    }

    // Prepare a comment for editing
    public function editComment($commentId)
    {
        $this->editingCommentId = $commentId;
        $this->editingCommentBody = Comment::find($commentId)->body;
    }

    // Update the edited comment
    public function updateComment()
    {
        $this->validate(['editingCommentBody' => 'required|max:255']);

        $comment = Comment::find($this->editingCommentId);
        $comment->body = $this->editingCommentBody;
        $comment->save();

        $this->editingCommentId = null;
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        if (auth()->id() === $comment->user_id || auth()->id() === $comment->exhibition->user_id) {
            $comment->delete();
        }
    }

    public function render()
    {
        $comments = Comment::where('exhibition_id', $this->exhibitionId)->get();
        return view('livewire.comments', compact('comments'));
    }
}
