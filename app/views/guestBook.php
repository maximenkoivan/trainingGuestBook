<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title><?=$this->e($title)?></title>
</head>
<body>
    <main>
        <div class="text-center">
        <h1>Guest Book</h1>
        </div>
        <ul>
        <?php foreach ($posts as $post): ?>
            <div class="container-fluid col-md-6">
                <li><i><?= $post['post'] ?></i></li>
                <div>
                    <p><small>It was writtеn by  <b><?= $post['username'] ?></b> (<?= $post['email'] ?>), on <?= $post['date_time'] ?></small></p>
                </div>
            </div>
        <?php endforeach; ?>
        </ul>
        <div class="container-fluid d-flex justify-content-center  fixed-bottom">
            <?=$this->insert('paginator', $paginator)?>
        <form class="" action="/guest_book/create_post" method="get"><button class="btn btn-primary" type="submit">Leave a message</button></form>
        </div>
    </main>
</body>
</html>
