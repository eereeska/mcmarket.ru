<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="padding: 5em">
    <label for="sort" style="display: block; margin-bottom: 20px;">Сортировка</label>
    <div class="select-new">
        <select name="sort" class="select-new__original">
            <option value="last_update" selected>Последнее обновление</option>
            <option value="newest" selected>Новые</option>
            <option value="most_downloaded" selected>Самые скачиваемые</option>
            <option value="most_viewed" selected>Самые просматриваемые</option>
        </select>
    </div>
</body>
</html>