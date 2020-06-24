<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>QrCode</title>
    </head>
    <body>
        <div style="text-align: center" class="visible-print">
            {!! QrCode::size(300)->generate($uri) !!}
            <p>{{ $uri }}</p>
        </div>
    </body>
</html>
