<?php 
session_start();


if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Page</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include('navbar.php');
?>
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="dashboard.php">KEMBALI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php" onclick="goBack()">Back</a>
      </li>
    </ul>
  </div>
</nav> -->

<script>
  function goBack() {
    window.history.back();
  }
</script>

    <div class="container">
        <h2 class="mt-5"></h2>
        <form id="data-form" action="listdo.php" class="mt-3" method="POST">
            <div class="form-group">
                <label for="name">DO</label>
                <input type="text" id="do" name="do" class="form-control" placeholder="Enter your DO" required>
            </div>
            <!-- <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" class="form-control" rows="5" placeholder="Enter your message"></textarea>
            </div> -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
