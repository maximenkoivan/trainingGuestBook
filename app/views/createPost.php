<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title><?= $this->e($title) ?></title>
</head>
<body>
    <main>
        <?= flash()->display() ?>
            <div class="container-fluid">
                <form class="" action="/guest_book" method="post">
                    <div class="container-fluid">
                        <div class="mb-sm-1 col-md-4">
                            <label for="exampleInputPassword1" class="form-label">User name</label>
                            <input type="text" name="username" class="form-control" id="exampleInputPassword1" value="<?= $_SESSION['old_data']['username'] ?? null ?>">
                        </div>
                        <div class="mb-sm-1 col-md-4">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $_SESSION['old_data']['email'] ?? null ?>">
                        </div>
                        <div class="mb-sm-1 col-md-4">
                            <label for="exampleFormControl" class="form-label">Message</label>
                            <input type="text" name="post" class="form-control" id="exampleFormControl" value="<?= $_SESSION['old_data']['post'] ?? null ?>">
                        </div>
                        <div class="mb-sm-1 col-md-4">
                            <label for="exampleInputEmail1" class="form-label">Date and time</label>
                            <input type="datetime-local" name="date_time" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= date('Y-m-d\TH:i:s')?>" readonly>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
        </div>
    </main>
</body>
</html>
<?php unset($_SESSION['old_data']) ?>