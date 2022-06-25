<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menadzer podataka o zaposlenima</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>   
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">MPZ</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto ">
    <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
</nav> 

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h4 class = "text-center text-danger font-weight-normal my-3">
        Menadzer podataka zaposlenih
      </h4>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6">
      <h4 class = "mt-2 text-primary">Svi zaposleni u bazi!</h4>
    </div>
    <div class="col-lg-6">
        <button type = "button" class = "btn btn-primary m-1 float-right"><i class="fas fa-user-plus fa-lg"></i>
        &nbsp;Dodaj novog korisnika</button>
        <a href="#" class ="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;Eksportuj u Excel</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class = "table-responsive" id="showUser">
        <table class = "table table-striped table-sm table-bordered">
          <thead>
            <tr class = "text-center">
              <th>ID</th>
              <th>Ime</th>
              <th>Prezime</th>
              <th>Email</th>
              <th>Telefon</th>
              <th>Akcija</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <hr class = "my-1">
</div>
<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>