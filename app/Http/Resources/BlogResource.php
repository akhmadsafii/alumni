<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        $file_admin = $this->admins->file ? asset($this->admins->file) : asset('asset/img/user4.jpg');
        $file_user = $this->users->file ? asset($this->users->file) : asset('asset/img/user4.jpg');
        return [
            'id' => $this->id,
            'role' => $this->role,
            'user' => $this->role == 'admin' ? $this->admins->name : $this->users->name,
            'avatar' => $this->role == 'admin' ? $file_admin : $file_user,
            'code' => $this->code,
            'title' => $this->title,
            'content' => $this->content,
            'total_seen' => $this->total_seen,
            'file' => $this->file ? asset($this->file) : asset('asset/img/no_image.jpeg'),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
