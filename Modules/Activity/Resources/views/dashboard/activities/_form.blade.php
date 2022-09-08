<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-label">封面</label>
      <input {{ $activity->id ? null : 'required' }} name="cover" type="file" class="form-control {{ $errors->has('cover') ? 'is-invalid' : null }}" value="{{ old('cover') }}" accept="image/*">
      <div class="invalid-feedback">{{ $errors->first('cover') }}</div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <label class="form-label">标题</label>
          <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : null }}" value="{{ old('title', $activity->title) }}">
          <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label class="form-label">用户 ID</label>
          <input name="user_id" type="text" class="form-control {{ $errors->has('user_id') ? 'is-invalid' : null }}" value="{{ old('user_id', $activity->user_id) }}">
          <div class="invalid-feedback">{{ $errors->first('user_id') }}</div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">简介</label>
      <textarea name="intro" class="form-control {{ $errors->has('intro') ? 'is-invalid' : null }}">{{ old('intro', $activity->intro) }}</textarea>
      <div class="invalid-feedback">{{ $errors->first('intro') }}</div>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="form-label mb-1">内容</label>
  <input id="input-content" name="content" type="hidden">
  <div id="quill-content" data-quill='{{ $quillEditorConfig }}'>{!! old('content', $activity->content) !!}</div>
  <div class="invalid-feedback d-block">{{ $errors->first('content') }}</div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-label">地点名称</label>
      <input name="address_name" type="text" class="form-control {{ $errors->has('address_name') ? 'is-invalid' : null }}" value="{{ old('address_name', $activity->address_name) }}">
      <div class="invalid-feedback">{{ $errors->first('address_name') }}</div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="form-group">
      <label class="form-label">详细地址</label>
      <input name="address_full" type="text" class="form-control {{ $errors->has('address_full') ? 'is-invalid' : null }}" value="{{ old('address_full', $activity->address_full) }}">
      <div class="invalid-feedback">{{ $errors->first('address_full') }}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">经度</label>
      <input name="longitude" type="text" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : null }}" value="{{ old('longitude', $activity->longitude) }}">
      <div class="invalid-feedback">{{ $errors->first('longitude') }}</div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">纬度</label>
      <input name="latitude" type="text" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : null }}" value="{{ old('latitude', $activity->latitude) }}">
      <div class="invalid-feedback">{{ $errors->first('latitude') }}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">开始时间</label>
      <input name="started_at" type="text" class="form-control flatpickr-input {{ $errors->has('started_at') ? 'is-invalid' : null }}"
             value="{{ old('started_at', $activity->started_at) }}"
             data-flatpickr='{"enableTime": true, "enableSeconds": true, "dateFormat": "Y-m-d H:i:S"}'>
      <div class="invalid-feedback">{{ $errors->first('started_at') }}</div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">结束时间</label>
      <input name="ended_at" type="text" class="form-control flatpickr-input {{ $errors->has('ended_at') ? 'is-invalid' : null }}"
             value="{{ old('ended_at', $activity->ended_at) }}"
             data-flatpickr='{"enableTime": true, "enableSeconds": true, "dateFormat": "Y-m-d H:i:S"}'>
      <div class="invalid-feedback">{{ $errors->first('ended_at') }}</div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-label">价格</label>
      <input name="price" type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : null }}" value="{{ old('price', $activity->price) }}">
      <div class="invalid-feedback">{{ $errors->first('price') }}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-label">剩余票数</label>
      <input name="surplus_ticket_num" type="text" class="form-control {{ $errors->has('surplus_ticket_num') ? 'is-invalid' : null }}" value="{{ old('surplus_ticket_num', $activity->surplus_ticket_num) }}">
      <div class="invalid-feedback">{{ $errors->first('surplus_ticket_num') }}</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label class="form-label">总票数</label>
      <input name="total_ticket_num" type="text" class="form-control {{ $errors->has('total_ticket_num') ? 'is-invalid' : null }}" value="{{ old('total_ticket_num', $activity->total_ticket_num) }}">
      <div class="invalid-feedback">{{ $errors->first('total_ticket_num') }}</div>
    </div>
  </div>
</div>
