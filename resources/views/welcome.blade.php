<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>Laronlinenotes</title>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
</head>
<body>
    <div id="app">
        <App />
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
