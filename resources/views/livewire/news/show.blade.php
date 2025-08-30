@extends('components.layouts.app')

@section('title', $news->title)
@section('description', $news->excerpt ?? Str::limit(strip_tags($news->content), 160))

@section('content')
    <div class="block min-h-[60vh]">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Хлебные крошки -->
                <nav class="mb-6">
                    <ol class="flex items-center space-x-2 text-sm text-gray-500">
                        <li>
                            <a href="{{ route('index') }}" class="hover:text-blue-600">Главная</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <a href="{{ route('news.index') }}" class="hover:text-blue-600">Новости</a>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span class="text-gray-400">{{ Str::limit($news->title, 50) }}</span>
                        </li>
                    </ol>
                </nav>

                {{--            <livewire:news.show :news="$news" />--}}
            </div>
        </div>
    </div>
@endsection
