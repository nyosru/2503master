<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;

class Show extends Component
{
    public News $news;
    public $relatedNews;

    public function mount(News $news)
    {
        // Проверяем, опубликована ли новость
//        if (!$news->isPublished() && !auth()->check()) {
        if ( !$news->isPublished() ) {
            abort(404);
        }

        $this->news = $news;
        $this->loadRelatedNews();
    }

    protected function loadRelatedNews()
    {
        $this->relatedNews = News::published()
            ->where('id', '!=', $this->news->id)
            ->where(function ($query) {
                $query->where('title', 'like', '%' . $this->news->title . '%')
                    ->orWhereHas('author', function ($q) {
                        $q->where('id', $this->news->author_user_id);
                    });
            })
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();
    }

    public function incrementViews()
    {
//        if (!session()->has('viewed_news_' . $this->news->id)) {
//            $this->news->increment('views_count');
//            session()->put('viewed_news_' . $this->news->id, true);
//        }
    }

    public function render()
    {
        $this->incrementViews();

        return view('livewire.news.show', [
            'news' => $this->news,
            'relatedNews' => $this->relatedNews,
        ]);
    }


//    public function render()
//    {
//        return view('livewire.news.show');
//    }
}
