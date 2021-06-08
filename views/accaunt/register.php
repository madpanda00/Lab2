<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template/css/register.css">
</head>

<body>
    <div class="container">
        <form class="form-signin" action="" method="post">
            <h1><a href="/post" style="text-decoration: none;">SpecT</a></h1>
            <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="danger"> <?= $error['msg']; ?></div>
            <?php endif; ?>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" value="<?= $error['email']; ?>" class="form-control" placeholder="Email" required>
            </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person"></i></span>
                <input type="text" name="user_name" value="<?= $error['name']; ?>" class="form-control" placeholder="Username" required>
            </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-key"></i></span>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
            </div>
            <input type="checkbox" id="check" name="check">
            <label for="check" style="font-size: 14px;">Соглашение на обработку персональных данных</label>
            <button class="btn btn-sm align-middle btn-outline-secondary" type="submit">Регистрация</button>
            <p class="or">У вас уже есть аккаунт?<a href="/login">Войти</a></p>
        </form>
    </div>
</body>

</html>
