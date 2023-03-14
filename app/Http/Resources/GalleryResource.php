<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'file' => $this->file,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
