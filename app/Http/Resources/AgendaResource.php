<?php

namespace App\Http\Resources;

use App\Helpers\DateHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
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
            'description' => $this->description,
            'location' => $this->location,
            'start_date' => DateHelper::getHoursMinute($this->start_date),
            'file' => $this->file ? asset($this->file) : asset('asset/img/no_image.jpeg'),
            'created_at' => $this->created_at->diffForHumans(),
            'status' => $this->status
        ];
    }
}
