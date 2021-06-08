<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template/css/index.css">
</head>

<body>
    <?php if(isset($email)): ?>
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
    <?php else: ?>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #efefef;">
        <a class="navbar-brand" href="/post">SpecT</a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="btn btn-sm align-middle btn-outline-secondary" href="/login">Вход</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-sm align-middle btn-outline-secondary" href="/register">Регистрация</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>

    <main class="main">
        <?php foreach($postsList as $item): ?>
        <div class="card text-dark bg-light mb-3">
            <div class="card-header">
                <p>Автор: <?= $item['name']; ?></p>
                <p class="date">Дата добавления: <?= $item['date']; ?></p>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $item['header']; ?></h5>
                <p class="card-text"><?= $item['shorttext']; ?></p>
            </div>
            <div class="card-footer">
                <a <?php if(isset($email)): ?> class="btn btn-sm align-middle btn-outline-secondary" <?php else: ?> class="btn btn-sm align-middle btn-outline-secondary btn-nonactive" <?php endif; ?> href="/post/<?= $item['id']; ?>">Открыть</a>
                <?php if(!isset($email)): ?>
                <p>*Авторизируйтесь чтобы просматривать статьи</p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </main>
</body>

</html>
