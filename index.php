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


        <a href="action.php?export=excel" class ="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;Eksportuj u Excel</a>
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

  <!-- Izmena postojeceg korisnika (struktura je ista kao za dodavanje, samo su odredjeni IDjevi izmenjeni--> 
  <div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Izmeni korisnicke podatke</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">
          <form action="" method = "post" id = "edit-form-data">
            <input type="hidden" name = "id" id = "id">
            <div class="form-group">
              <input type="text" name="fname" class = "form-control" id= "fname" required >
            </div>
            <div class="form-group">
              <input type="text" name="lname" class = "form-control" id = "lname" required >
            </div>
            <div class="form-group">
              <input type="text" name="email" class = "form-control" id = "email" required >
            </div>
            <div class="form-group">
              <input type="text" name="phone" class = "form-control" id = "phone" required >
            </div>
            <div class="form-group">
              <input type="submit" name = "update" id = "update" value = "Izmeni podatke"
              class = "btn btn-primary btn-block">
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
        e.preventDefault(); //zaustavlja rifresovanje stranice


        $.ajax({
          url: "action.php",
          type: "POST",
          data: $("#form-data").serialize() + "&action=insert",  //selialize ce da vrati podatke (iz forme koju pokrece dugme) kao array
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
    });
    
    //izmena podataka korisnika
    $("body").on("click", ".editBtn", function(e) {
      e.preventDefault(); //zaustavlja rifresovanje stranice

      var edit_id = $(this).attr('id'); //uzimam id korisnika kome nameravam da ((promenim podatke
      $.ajax({
        url:"action.php",
        type:"POST",
        data: {'edit_id':edit_id},
        success:function(response) {
           pom = JSON.parse(response); //json objekat iz odgovora parsiramo u JS objekat
           console.log(pom);
            $('#id').val(pom.id);
            $('#fname').val(pom.first_name);
            $('#lname').val(pom.last_name);
            $('#email').val(pom.email);
            $('#phone').val(pom.phone);
        }
      });

    });
    
    //update ajax poziv
    $("#update").click(function(e){
      if($("#edit-form-data")[0].checkValidity()){ //ne znam sto sam ovo radio iskr, nasao bagfix na StackOverflow
        e.preventDefault(); //zaustavlja rifresovanje stranice


        $.ajax({
          url: "action.php",
          type: "POST",
          data: $("#edit-form-data").serialize() + "&action=update",  //selialize ce da vrati podatke (iz forme koju pokrece dugme) kao array
          success: function(response) {
            Swal.fire({ //pop-up 
                        title: 'Kontakt je uspesno azuriran!',
                        icon: 'success'
                      })
                  $("#editModal").modal('hide');
                  $("#edit-form-data")[0].reset();
                  showAllUsers(); //da bi azuriranu listu korisnika odmah
          }
        });
      }
    });

    //ajax zahtev za brisanje korisnika

    $("body").on("click", ".delBtn", function(e){
      e.preventDefault();

      var tr = $(this).closest('tr'); //uzimam red samo da bih napravio vizuelni efekat da pocrveni kad se obrise korisnik
      var del_id = $(this).attr('id'); //uzima id od korisnika koji se nalazi u istom redu kao i pritisnuto dugme
      console.log(del_id);
      Swal.fire({   //preuzeo sa https://sweetalert2.github.io/
            title: 'Da li ste sigurni?',
            text: "Necete moci da opozovete ovu radnju!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Da!'
          }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                url: "action.php",
                type: "POST",
                data: {del_id:del_id},
                success:function(response){
                  
                  tr.css('background-color','#ff6666');
                  Swal.fire(
                    'Obrisan',
                    'Uspesno obrisan korisnik',
                    'success'
                  )
                  showAllUsers();
                }
              });
            }
          })
    });
  });
  
  

</script>
</body>
</html>