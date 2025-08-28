<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginated(10);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        if (!$news->isPublished()) {
            abort(404);
        }

        return view('livewire.news.show', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $news = News::create([
            ...$validated,
            'author_user_id' => auth()->id(),
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $news->update(['image' => basename($imagePath)]);
        }

        return redirect()->route('news.show', $news);
    }
}
