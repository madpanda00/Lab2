<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template/css/post.css">
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #efefef;">
        <a class="navbar-brand" href="/post"><?= $email; ?></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-sm align-middle btn-outline-secondary" href="/post/create">Добавить статью</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-sm align-middle btn-outline-secondary" href="/logout">Выход</a>
            </li>
        </ul>
    </nav>
    <main class="main">
        <div class="form">
            <div class="page">
                <h1><?= $postsItemById['header']; ?></h1>
                <div class="card-footer text-muted">
                    <p>Автор: <?= $postsItemById['author']; ?></p>
                    <p>Дата публикации: <?= $postsItemById['date']; ?></p>
                </div>
                <p><?= $postsItemById['text']; ?></p>
            </div>
            <form class="files">
                <h2>Прикрепленные файлы</h2>
                <div class="files-list">
                    <?php foreach($postsFilesById as $key): ?>
                    <p><?= $key; ?></p>
                    <?php endforeach; ?>
                </div>
                <a class="btn btn-sm align-middle btn-outline-secondary" href="/download/<?= $params; ?>">Скачать</a>
            </form>
        </div>
    </main>
</body>

</html>
