<div id="laravel-flash">
  @include('flash::message')

  <style rel="stylesheet">
    #laravel-flash {
      position: absolute;
      top: 24px;
      right: 36px;
    }
  </style>

  <!-- TODO: 全局引用 jquery -->
  <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // TODO: modal flash 需要调整优化
      $('#flash-overlay-modal').modal();
      $('#flash-overlay-modal').show();

      // 自动隐藏非 important Flash
      $('#laravel-flash div.alert').not('.alert-important').delay(3000).fadeOut(650);

      // 手动隐藏 important Flash
      $('#laravel-flash div.alert-important').find('button.close').click(function(event) {
        $(event.target).parent().fadeOut(350);
      });
    });
  </script>
</div>
