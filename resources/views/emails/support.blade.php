<!DOCTYPE html>
<html>
<body>
    <h1 style="font-size: 72px; color: #0d6efd; width: 100%; text-align: center;">Tripaza</h1>
    <p>Type of request: {{$mailData['type']}}</p>
    <p>Mail of sender: {{$mailData['mail']}}</p>
    @if($mailData['trip'] != 'None')
        <p>Trip request refers to: {{$mailData['type']}}</p>
    @endif
    <p>Text: {{$mailData['text']}}</p>
</body>
</html>
