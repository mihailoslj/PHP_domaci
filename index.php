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
        <button type = "button" class = "btn btn-primary m-1 float-right" data-toggle= "modal" data-target= "#addModal"><i class="fas fa-user-plus fa-lg"></i>
        &nbsp;Dodaj novog korisnika</button>
        <a href="#" class ="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;Eksportuj u Excel</a>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class = "table-responsive" id="showUser">  <!-- showUser koristim u ajax pozivu, pogledaj dole -->
      
      </div>
    </div>
  </div>
  
  <hr class = "my-1">
</div>

  <!-- Dodavanje novog korisnika -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Dodaj novog korisnika</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body, "Dodaj novog korisnika" -->
        <div class="modal-body px-4">
          <form action="" method = "post" id = "form-data">
            <div class="form-group">
              <input type="text" name="fname" class = "form-control" placeholder = "Ime" required >
            </div>
            <div class="form-group">
              <input type="text" name="lname" class = "form-control" placeholder = "Prezime" required >
            </div>
            <div class="form-group">
              <input type="text" name="email" class = "form-control" placeholder = "Email" required >
            </div>
            <div class="form-group">
              <input type="text" name="phone" class = "form-control" placeholder = "Telefon" required >
            </div>
            <div class="form-group">
              <input type="submit" name = "insert" id = "insert" value = "Dodaj korisnika"
              class = "btn btn-danger btn-block"><!--  insert koristim u ajax pozivu, pogledaj dole -->
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
<!-- jQuery library -->
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type = "text/javascript">
  $(document).ready(function(){

    // fja preko koje obavljam ajax poziv da nam vrati sve korisnike
    function showAllUsers() {
      $.ajax({
        url: "action.php",
        type: "POST",
        data: {action: "view"},
        success: function(response){
          // console.log(response);
          $("#showUser").html(response);
          $("table").DataTable({
               order: [0, 'desc']
          });
        }
      });   
    }
    showAllUsers();

    //ajax poziv ka action.php da bi dugme 'Dodaj novog korisnika' uradilo upravo to  
    $("#insert").click(function(e){
      if($("#form-data")[0].checkValidity()){ //ne znam sto sam ovo radio iskr, nasao bagfix na StackOverflow
        e.preventDefault(); //zaustavlja submitovanje forme

        
        $.ajax({
          url: "action.php",
          type: "POST",
          data: $("#form-data").serialize() + &action="insert", //selialize ce da vrati podatke (iz forme koju pokrece dugme) kao array
          success: function(response) {
            Swal.fire({ //pop-up 
                        title: 'Kontakt je uspesno dodat!',
                        icon: 'success'
                      })
                  $("#addModal").modal('hide');
                  $("#form-data")[0].reset();
                  showAllUsers(); //da bi azuriranu listu korisnika odmah
          }
        });
      }
    })
  });
</script>
</body>
</html>