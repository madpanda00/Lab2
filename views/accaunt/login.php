<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template/css/login.css">
</head>

<body>
    <div class="container">
        <form action="" class="form-signin" method="post">
            <h1><a href="/post" style="text-decoration: none;">SpecT</a></h1>
            <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="danger"> <?= $error['msg']; ?></div>
            <?php endif; ?>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                <input type="text" name="email" value="<?= $error['email']; ?>" class="form-control" placeholder="Email" required>
            </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-sm align-middle btn-outline-secondary" type="submit">Войти</button>
            <p class="or"> У вас нет аккаунта?<a href="/register">Регистрация</a></p>
        </form>
    </div>
</body>

</html>
