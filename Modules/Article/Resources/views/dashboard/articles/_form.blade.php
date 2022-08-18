<!-- 封面 -->
<div class="form-group">
  <label class="form-label mb-1">封面</label>

  <small class="form-text text-muted">
    Please use an image no larger than 1200px * 600px.
  </small>

  <input {{ $article->id ? null : 'required' }} name="cover" type="file" class="form-control {{ $errors->has('cover') ? 'is-invalid' : null }}" value="{{ old('cover') }}" accept="image/*">
  <div class="invalid-feedback">{{ $errors->first('cover') }}</div>

  {{--
  <div class="dropzone dropzone-single mb-3 dz-clickable" data-dropzone='{{ $dropzoneConfig }}'>
    <!-- Fallback -->
    <div class="fallback">
      <div class="custom-file">
        <input type="file" class="form-control" id="projectCoverUploads">
        <label class="form-label" for="projectCoverUploads">Choose file</label>
      </div>
    </div>

    <!-- Preview -->
    <div class="dz-preview dz-preview-single">
      <div class="dz-preview-cover">
        <img class="dz-preview-img" src="data:image/svg+xml,%3csvg3c/svg%3e" alt="..." data-dz-thumbnail>
      </div>
    </div>

    <div class="dz-default dz-message">
      <button class="dz-button" type="button">拖放图片到这里，进行上传</button>
    </div>
  </div>
  --}}
</div>

<div class="form-group">
  <label class="form-label">标题</label>
  <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : null }}" value="{{ old('title', $article->title) }}">
  <div class="invalid-feedback">{{ $errors->first('title') }}</div>
</div>

<div class="form-group">
  <label class="form-label">作者</label>
  <input name="author" type="text" class="form-control {{ $errors->has('author') ? 'is-invalid' : null }}" value="{{ old('author', $article->author) }}">
  <div class="invalid-feedback">{{ $errors->first('author') }}</div>
</div>

<div class="form-group">
  <label class="form-label">简介</label>
  <textarea name="intro" class="form-control {{ $errors->has('intro') ? 'is-invalid' : null }}">{{ old('intro', $article->intro) }}</textarea>
  <div class="invalid-feedback">{{ $errors->first('intro') }}</div>
</div>

<div class="form-group">
  <label class="form-label mb-1">内容</label>
  <input id="input-content" name="content" type="hidden">
  <div id="quill-content" data-quill='{{ $quillEditorConfig }}'>{!! old('content', $article->content) !!}</div>
  <div class="invalid-feedback d-block">{{ $errors->first('content') }}</div>
</div>

<div class="form-group">
  <label class="form-label">分类</label>
  <select name="categories[]" class="form-select {{ $errors->has('categories') ? 'is-invalid' : null }}" data-choices='{"removeItemButton": true, "addItems": true}' multiple>
    @foreach ($categories as $categoryId => $categoryName)
      <option value="{{ $categoryId }}" {{ in_array($categoryId, old('categories', $article->categories->pluck('id')->toArray())) ? 'selected' : null }}>{{ $categoryName }}</option>
    @endforeach
  </select>
  <div class="invalid-feedback d-block">{{ $errors->first('categories') }}</div>
</div>

<div class="form-group">
  <label class="form-label">标签</label>
  <select name="tags[]" class="form-select {{ $errors->has('tags') ? 'is-invalid' : null }}" data-choices='{"removeItemButton": true, "addItems": true}' multiple>
    @foreach ($tags as $tagId => $tagName)
      <option value="{{ $tagId }}" {{ in_array($tagId, old('tags', $article->tags->pluck('id')->toArray())) ? 'selected' : null }}>{{ $tagName }}</option>
    @endforeach
  </select>
  <div class="invalid-feedback d-block">{{ $errors->first('tags') }}</div>
</div>

@if ($article->id)
  <div class="form-group">
    <label class="form-label">发布时间</label>
    <input name="published_at" type="text" class="form-control flatpickr-input {{ $errors->has('published_at') ? 'is-invalid' : null }}"
           value="{{ old('published_at', $article->published_at) }}"
           data-flatpickr='{"enableTime": true, "enableSeconds": true, "dateFormat": "Y-m-d H:i:S"}'>
    <div class="invalid-feedback">{{ $errors->first('published_at') }}</div>
  </div>
@endif

