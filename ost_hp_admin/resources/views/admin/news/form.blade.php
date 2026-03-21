@extends('admin.layouts.app')

@section('title', $news->exists ? 'お知らせ編集' : 'お知らせ作成')

@section('content')

<div style="margin-bottom:20px;">
    <a href="{{ $news->exists ? route('admin.news.show', $news) : route('admin.news.index') }}" class="btn btn--ghost btn--sm">← 戻る</a>
</div>

<div class="card" style="max-width:860px;">
    <div class="card__header">
        <div class="card__title">{{ $news->exists ? 'お知らせ編集' : 'お知らせ作成' }}</div>
    </div>
    <div class="card__body">
        @if($errors->any())
            <div class="alert alert--error">
                <ul style="margin:0;padding-left:16px;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $news->exists ? route('admin.news.update', $news) : route('admin.news.store') }}">
            @csrf
            @if($news->exists) @method('PUT') @endif

            <div class="form-group">
                <label class="form-label" for="title">タイトル <span style="color:#b91c1c;">*</span></label>
                <input type="text" id="title" name="title" class="form-input"
                       value="{{ old('title', $news->title) }}" required maxlength="255">
                @error('title')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="body">本文 <span style="color:#b91c1c;">*</span></label>
                <textarea id="body" name="body" class="form-input" rows="12"
                          style="resize:vertical;" required>{{ old('body', $news->body) }}</textarea>
                @error('body')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="form-group">
                    <label class="form-label" for="published_at">公開日</label>
                    <input type="date" id="published_at" name="published_at" class="form-input"
                           value="{{ old('published_at', $news->published_at?->format('Y-m-d')) }}">
                    @error('published_at')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group" style="display:flex;flex-direction:column;justify-content:flex-end;padding-bottom:4px;">
                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                        <input type="checkbox" name="published" value="1"
                               {{ old('published', $news->published) ? 'checked' : '' }}>
                        <span class="form-label" style="margin:0;">公開する</span>
                    </label>
                </div>
            </div>

            <div style="display:flex;gap:12px;justify-content:flex-end;margin-top:8px;">
                <a href="{{ $news->exists ? route('admin.news.show', $news) : route('admin.news.index') }}"
                   class="btn btn--ghost">キャンセル</a>
                <button type="submit" class="btn btn--primary">
                    {{ $news->exists ? '更新する' : '作成する' }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
