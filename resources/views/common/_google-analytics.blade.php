@if (config('heycommunity.google-analytics.enabled'))
  <div id="google-analytics">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DEFZDLQNHW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-DEFZDLQNHW');
    </script>
  </div>
@endif
