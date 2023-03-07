<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'nisn' => $this->nisn,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'graduating_class' => $this->graduating_class,
            'graduation_year' => $this->graduation_year,
            'id_major' => $this->id_major,
            'major' => $this->majors->name,
            'file' => $this->file ? asset($this->file) : asset('asset/img/user4.jpg'),
            'status' => $this->status
        ];
    }
}
