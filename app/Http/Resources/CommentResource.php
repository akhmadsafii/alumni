<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
        public function toArray($request)
        {
            $file_admin = $this->admins->file ? asset($this->admins->file) : asset('asset/img/user4.jpg');
            $file_user = $this->users->file ? asset($this->users->file) : asset('asset/img/user4.jpg');
            return [
                'id' => $this->id,
                'id_discussion' => $this->id_discussion,
                'role' => $this->role,
                'id_user' => $this->id_user,
                'user' => $this->role == 'admin' ? $this->admins->name : $this->users->name,
                'avatar' => $this->role == 'admin' ? $file_admin : $file_user,
                'comment' => $this->comment,
                'status' => $this->status,
                'created_at' => $this->created_at->diffForHumans(),
            ];
        }
}
