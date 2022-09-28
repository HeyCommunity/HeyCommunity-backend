<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-label">类别</label>
      <select name="type" class="form-select {{ $errors->has('type') ? 'is-invalid' : null }}">
        @foreach (\App\Models\Carousel::$types as $typeValue => $typeName)
          <option value="{{ $typeValue }}" {{ $typeValue === old('type', $carousel->type) ? 'selected' : null }}>{{ $typeName }}</option>
        @endforeach
      </select>
      <div class="invalid-feedback d-block">{{ $errors->first('type') }}</div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="form-group">
      <label class="form-label">图片</label>
      <input {{ $carousel->image_path ? null : 'required' }} name="image_path" type="file" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : null }}" value="{{ old('image_path') }}" accept="image/*">
      <div class="invalid-feedback">{{ $errors->first('image_path') }}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">标题</label>
      <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : null }}" value="{{ old('title', $carousel->title) }}">
      <div class="invalid-feedback">{{ $errors->first('title') }}</div>
    </div>
    <div class="form-group">
      <label class="form-label">链接</label>
      <input name="link" type="text" class="form-control {{ $errors->has('link') ? 'is-invalid' : null }}" value="{{ old('link', $carousel->link) }}">
      <div class="invalid-feedback">{{ $errors->first('link') }}</div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">内容</label>
      <textarea name="content" rows="5" class="form-control {{ $errors->has('content') ? 'is-invalid' : null }}">{{ old('content', $carousel->content) }}</textarea>
      <div class="invalid-feedback">{{ $errors->first('content') }}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">排序</label>
      <input name="sort" type="text" class="form-control {{ $errors->has('sort') ? 'is-invalid' : null }}" value="{{ old('sort', $carousel->sort) }}">
      <div class="invalid-feedback">{{ $errors->first('sort') }}</div>
      <div class="form-text">
        <div>可为空；数值越小越靠前。</div>
        <div></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">状态</label>
      <select name="status" class="form-select {{ $errors->has('status') ? 'is-invalid' : null }}">
        @foreach (\App\Models\Carousel::$statuses as $statusValue => $statusName)
          <option value="{{ $statusValue }}" {{ $statusValue === old('status', $carousel->status) ? 'selected' : null }}>{{ $statusName }}</option>
        @endforeach
      </select>
      <div class="invalid-feedback">{{ $errors->first('status') }}</div>
    </div>
  </div>
</div>
