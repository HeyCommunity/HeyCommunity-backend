<script src="https://cdn.tiny.cloud/1/zq2hetxt2m781ynva699yr0o0ccbxa4vr86rduyn23owsf5q/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#tiny-editor',
    language: 'zh_CN',
    font_family_formats: '微软雅黑;宋体;黑体;仿宋;楷体;隶书;幼圆;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings',
    style_formats: [
      {title: '首行缩进', 'block': 'p', 'styles': {'text-indent': '2em'}},
    ],
    // content_style: 'body {font-size:13pt;} img {max-width:100%;}',
    font_size_formats: '8pt 10pt 12pt 13pt 14pt 16pt 18pt 24pt 36pt',
    style_formats_merge: true,
    // 仅包含 free plugins
    plugins: ['advlist','autolink','code', 'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks', 'fullscreen','insertdatetime','media','table','help','wordcount'],
    // 包含 Premium plugins
    // plugins: ['a11ychecker','advlist','advcode','advtable','autolink','checklist','export', 'code', 'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks', 'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'],
    document_base_url: '{{ request()->root() . '/' }}',
    images_upload_url: '{{ route("common.uploads.tiny-editor-image-upload") }}',
    image_advtab: true,
    image_dimensions: true,
    relative_urls : false,
    extended_valid_elements: 'p[class=tiny-p|style],img[class=tiny-img|src|border=0|alt|title|hspace|vspace|width~100%|height~auto|align|onmouseover|onmouseout|name]',
    dtoolbar: [
      'undo redo | styles | bold italic | link image',
      'alignleft aligncenter alignright'
    ],
    toolbar_mode: 'sliding',
    toolbar: [
      {name: 'history', items: ['undo', 'redo' ]},
      {name: 'styles', items: ['blocks', 'fontfamily', 'fontsize' ]},
      {name: 'formatting', items: ['bold', 'italic', 'underline', 'removeformat', ]},
      {name: 'font', items: ['forecolor', 'backcolor', 'lineheight' ]},
      {name: 'alignment', items: ['alignleft', 'aligncenter', 'alignright', 'alignjustify' ]},
      {name: 'list', items: ['bullist', 'numlist', 'checklist', ]},
      {name: 'indentation', items: ['outdent', 'indent', ]},
      {name: 'ext', items: ['image', 'link', ]},
      {name: 'other', items: ['a11ycheck', 'fullscreen', 'code' ]},
    ],
  })
</script>
<textarea id="tiny-editor" name="{{ $inputName }}">{{ $inputValue }}</textarea>
