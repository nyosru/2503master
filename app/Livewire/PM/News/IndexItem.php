<?php

namespace App\Livewire\PM\News;

use Livewire\Component;

class IndexItem extends Component
{

    public $item;

    public function render()
    {
//        $this->item->image_url = asset('storage/app/public/leed-comments/3VPzdUwdSk7IQlBcYju2Q7ZtBEVPBg20mPQjOwzN.jpg');
        return view('livewire.p-m.news.index-item');
    }
}
