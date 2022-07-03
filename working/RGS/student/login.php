<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Student Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <script src="../assets/js/sweetalert.min.js"></script>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3" align="center">Login as student</h3>
              <form>
                <div class="form-group">
                  <label>User Name *</label>
                  <input type="text" class="form-control p_input" style="color:white; text-align: center;" id="username" name="username">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input type="password" id="Password" name="Password" class="form-control p_input" style="color:white; text-align: center;">
                </div>
              </form> 
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn login">Login</button>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->

  <script type="text/javascript">
    $(document).on('click', '.login', function(){

      var username = document.getElementById("username").value;
      //console.log(Email);
      var Password= document.getElementById("Password").value;
      if (username != '' && Password !='') {
        $.ajax({
          type:'POST',
          url:'verify.php',
          data:{'username':username, 'Password':Password},
          success:function(result){
            var accepted=(result);
            console.log(accepted);
            if (accepted==1) {
              //swal("success","Accepted","success");
              window.location.href = "index.php";
            }else{
              swal("error","Invalid Username or Password","error"); 
            }
          }
        });


      }else{
        swal("error","Please enter all fields","error");
      }
    });
  </script>
</body>
</html>