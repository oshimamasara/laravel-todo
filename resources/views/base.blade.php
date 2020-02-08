<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lravel Todo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
      @yield('main')
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  </body>
</html>