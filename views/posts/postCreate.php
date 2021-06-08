<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template/css/postCreate.css">
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
    <form class="main" action="" method="post" enctype="multipart/form-data">
        <h2>Добавьте свою статью прямо сейчас</h2>
        <?php if(isset($error)): ?>
        <div class="alert alert-danger" role="danger"> <?= $error['msg']; ?></div>
        <?php endif; ?>
        <div class="form-floating mb-3">
            <input type="text" value="<?= $error['header']; ?>" class="form-control" placeholder="Header" name="header" id="floatingHeader" required>
            <label for="floatingHeader">Заголовок</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="content" id="floatingText" style="height: 200px" required><?= $error['content']; ?></textarea>
            <label for="floatingText">Описание</label>
        </div>
        <div class="mb-3">
            <input class="form-control" type="file" name="filename[]" id="formFileMultiple" multiple required>
        </div>
        <button class="btn btn-sm align-middle btn-outline-secondary" type="submit">Добавить</button>
    </form>
</body>

</html>
