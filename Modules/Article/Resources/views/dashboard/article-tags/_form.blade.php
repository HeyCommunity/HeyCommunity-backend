<div class="row">
  <div class="col-lg-5">
    <div class="form-group">
      <label for="input-slug" class="form-label">标识</label>
      <input id="input-slug" name="slug" type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : null }}" value="{{ old('slug', $articleTag->slug) }}">
      <div class="invalid-feedback">{{ $errors->first('slug') }}</div>
    </div>
  </div>
  <div class="col-lg-7">
    <div class="form-group">
      <label for="input-name" class="form-label">名称</label>
      <input id="input-name" name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : null }}" value="{{ old('name', $articleTag->name) }}">
      <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="input-description" class="form-label">描述</label>
  <textarea id="input-description" name="description" class="form-control {{ $errors->has('title') ? 'is-invalid' : null }}">{{ old('description', $articleTag->description) }}</textarea>
  <div class="invalid-feedback">{{ $errors->first('description') }}</div>
</div>
