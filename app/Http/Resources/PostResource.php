<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'post' => $this->post,
            'like' => $this->like,
            'privacy' => $this->privacy,
            'comments' => $this->comments->map(function ($item, $index){
                return [
                    'id' => $item['id'],
                    'comments' => $item['comments'],
                    'post_id' => $item['post_id'],
                    'created_at' => $item['width'],
                    'creator' => $item['creator'],
                    'updated_at' => $item['updated_at'],
                    'updator' => $item['updator'],
                ];
            }),
            'avatar_base_url' => ($this->creator->avatar) != '' ? url(Storage::url("avatars/")) : 'https://cdn.iconscout.com/icon/free/png-512/person-with-laptop-male-1597386-1354342.png',
            'avatar' => ($this->creator->avatar) != '' ? $this->creator->avatar : '',
            'created_at' => Carbon::parse($this->created_at)->format('D, d m Y H:i A'),
            'creater' => ($this->created_by) ? $this->updator->first_name.' '.$this->updator->last_name : '',
            'creater_id' => ($this->creator) ? $this->creator->id : '',
            'updated_at' => Carbon::parse($this->updated_at)->format('D, d m Y H:i A'),
            'updater' => ($this->updator) ? $this->updator->first_name.' '.$this->updator->last_name : '',
            'updater_id' => ($this->updator) ? $this->updator->id  : ''
        ];
    }
}
