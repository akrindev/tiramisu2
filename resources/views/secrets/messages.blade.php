<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $user->username }} Secret Message</title>
    <link rel="stylesheet" href="/css/secrets-app.css">
</head>
<body>
    <div id="react-root"></div>

    <div id="user-data" data-user="{{ $user->id }}"></div>
    <script src="/js/secrets-app.js"></script>
</body>
</html>
