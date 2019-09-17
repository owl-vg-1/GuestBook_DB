<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?=$title?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-info">

<div class="container-fluid bg-secondary">
<div class="d-flex justify-content-center">
<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse font-weight-bold" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item border border-primary rounded-pill m-2 bg-success">
        <a class="nav-link" href="/dashboard">AdminPanel<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item border border-primary rounded-pill m-2 bg-success">
        <a class="nav-link" href="/login">login<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item border border-primary rounded-pill m-2 bg-success">
        <a class="nav-link" href="/feedback">FeedBack<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item border border-primary rounded-pill m-2 bg-success">
        <a class="nav-link" href="/logout">logout<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
</div>
</div>
<div class="user_name font-weight-bold text-white-50 bg-success fixed-bottom">
  <?=$_SESSION['autorized_user'] ?? ''?>
</div>
    <div id='maincontent'>
        <?php $this->body(); ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>