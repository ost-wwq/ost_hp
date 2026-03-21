<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = News::latest();

        if ($filter === 'published') {
            $query->where('published', true);
        } elseif ($filter === 'draft') {
            $query->where('published', false);
        }

        $newsList = $query->paginate(20)->withQueryString();

        return view('admin.news.index', compact('newsList', 'filter'));
    }

    public function create()
    {
        return view('admin.news.form', ['news' => new News()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'body'         => ['required', 'string'],
            'published'    => ['sometimes', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data['published'] = $request->boolean('published');

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'お知らせを作成しました。');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'body'         => ['required', 'string'],
            'published'    => ['sometimes', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data['published'] = $request->boolean('published');

        $news->update($data);

        return redirect()->route('admin.news.show', $news)
            ->with('success', 'お知らせを更新しました。');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'お知らせを削除しました。');
    }
}
