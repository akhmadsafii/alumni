<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionResource extends JsonResource
{
    public function toArray($request)
    {
        // dd($this->users);
        $file_admin = $this->admins && $this->admins->file ? asset($this->admins->file) : asset('asset/img/user4.jpg');
        $file_user = $this->users && $this->users->file ? asset($this->users->file) : asset('asset/img/user4.jpg');
        return [
            'id' => $this->id,
            'role' => $this->role,
            'id_user' => $this->id_user,
            'user' => $this->role == 'admin' ? $this->admins->name : $this->users->name,
            'avatar' => $this->role == 'admin' ? $file_admin : $file_user,
            'content' => $this->content,
            'amount_comments' => count($this->comments),
            'created_at' => $this->created_at->diffForHumans(),
            'comments' => CommentResource::collection($this->comments->where('status', '!=', 2))->resolve()
            // 'comments' => CommentResource::collection($this->comments->where('status', '!=', 0))->resolve()
        ];
    }
}
