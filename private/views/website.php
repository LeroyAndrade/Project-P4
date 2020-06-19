
<!doctype html>
<html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Sharing is Caring</title>
      <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@300&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" href="<?php echo site_url( '/css/style.css' ) ?>" media="all">
        <?php echo $this->section( 'css' ) ?>
  </head>

  <body>

    <header>
        <h1>Sharing is caring</h1>
    </header>

    <nav>

    </nav>

    <main>

        <section>
          <?php echo $this->section('content'); ?>
        </section>

    </main>

    <footer>

    </footer>

  </body>

</html>
