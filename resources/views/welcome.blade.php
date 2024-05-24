<!DOCTYPE html>
<html>
<head>
    <title>URL Shortener</title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        <h1>URL Shortener</h1>
        <form method="POST" action="/shorten">
            @csrf
            <input type="text" name="url" placeholder="Paste your URL here" style="width: 300px;">
            <button type="submit">Shorten</button>
        </form>
        @if (isset($result))
            @if (isset($result['error']))
                <p style="color: red;">{{ $result['error'] }}</p>
            @else
                <p>Shortened URL: <a href="/{{ $result['short_code'] }}">{{ request()->getHost() }}/{{ $result['short_code'] }}</a></p>
            @endif
        @endif
    </div>
</body>
</html>
