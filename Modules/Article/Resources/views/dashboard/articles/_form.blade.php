<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-label">封面</label>
      <input {{ $article->id ? null : 'required' }} name="cover" type="file" class="form-control {{ $errors->has('cover') ? 'is-invalid' : null }}" value="{{ old('cover') }}" accept="image/*">
      <div class="invalid-feedback">{{ $errors->first('cover') }}</div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <label class="form-label">标题</label>
          <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : null }}" value="{{ old('title', $article->title) }}">
          <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label">作者</label>
          <input name="author" type="text" class="form-control {{ $errors->has('author') ? 'is-invalid' : null }}" value="{{ old('author', $article->author) }}">
          <div class="invalid-feedback">{{ $errors->first('author') }}</div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">分类</label>
      <select name="categories[]" class="form-select {{ $errors->has('categories') ? 'is-invalid' : null }}" data-choices='{"removeItemButton": true, "addItems": true}' multiple>
        @foreach ($categories as $categoryId => $categoryName)
          <option value="{{ $categoryId }}" {{ in_array($categoryId, old('categories', $article->categories->pluck('id')->toArray())) ? 'selected' : null }}>{{ $categoryName }}</option>
        @endforeach
      </select>
      <div class="invalid-feedback d-block">{{ $errors->first('categories') }}</div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">标签</label>
      <select name="tags[]" class="form-select {{ $errors->has('tags') ? 'is-invalid' : null }}" data-choices='{"removeItemButton": true, "addItems": true}' multiple>
        @foreach ($tags as $tagId => $tagName)
          <option value="{{ $tagId }}" {{ in_array($tagId, old('tags', $article->tags->pluck('id')->toArray())) ? 'selected' : null }}>{{ $tagName }}</option>
        @endforeach
      </select>
      <div class="invalid-feedback d-block">{{ $errors->first('tags') }}</div>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="form-label">简介</label>
  <textarea name="intro" class="form-control {{ $errors->has('intro') ? 'is-invalid' : null }}">{{ old('intro', $article->intro) }}</textarea>
  <div class="invalid-feedback">{{ $errors->first('intro') }}</div>
</div>

<div class="form-group">
  <label class="form-label mb-1">内容</label>
  <x-forms.tiny-editor inputName="content" :inputValue="$article->content"></x-forms.tiny-editor>
  <div class="invalid-feedback d-block">{{ $errors->first('content') }}</div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">状态</label>
      <select name="status" class="form-select">
        @foreach (\Modules\Activity\Entities\Activity::$statuses as $statusKey => $statusValue)
          <option {{ $statusKey === old('status', $article->status) ? 'selected' : '' }} value="{{ $statusKey }}">{{ $statusValue }}</option>
        @endforeach
      </select>
      <div class="invalid-feedback">{{ $errors->first('status') }}</div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">发布时间</label>
      <input name="published_at" type="text" class="form-control flatpickr-input {{ $errors->has('published_at') ? 'is-invalid' : null }}"
             value="{{ old('published_at', $article->published_at) }}"
             data-flatpickr='{"enableTime": true, "enableSeconds": true, "dateFormat": "Y-m-d H:i:S"}'>
      <div class="invalid-feedback">{{ $errors->first('published_at') }}</div>
    </div>
  </div>
</div>

