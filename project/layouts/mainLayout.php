<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $title ?? '' ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="/project/public/images/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
              rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <link href="/project/public/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid min-vh-100 d-flex flex-column">

            <?= $headerBlock ?>

            <?= $contentBlock ?>

            <footer class="p-4 text-center border-top border-4 border-secondary">Scandiweb Test Assignment</footer>
        </div>

        <?= $scriptBlock ?? '' ?>

    </body>
</html>
