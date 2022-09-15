<div id="laravel-flash">
  @include('flash::message')

  <style rel="stylesheet">
    #laravel-flash {
      position: fixed;
      top: 24px;
      right: 36px;
      text-align: right;
    }
    #laravel-flash .alert {
      margin-bottom: 10px;
      max-width: 300px;
      text-align: left;
    }
    #laravel-flash .alert.alert-important {
      padding-right: 40px;
    }
    #laravel-flash .alert button.close {
      position: absolute;
      top: 0;
      right: 0;
      background-color: transparent;
      padding: 0.75rem 1rem;
      border: none;
    }
  </style>

  <script>
    // TODO flash()->overlay() 暂不可用

    document.addEventListener('DOMContentLoaded', function () {
      // 自动隐藏非 important Flash
      $('#laravel-flash div.alert').not('.alert-important').delay(3000).fadeOut(650);

      // 手动隐藏 important Flash
      $('#laravel-flash div.alert-important').find('button.close').click(function(event) {
        $(event.target).parent().fadeOut(350);
      });
    });
  </script>
</div>
