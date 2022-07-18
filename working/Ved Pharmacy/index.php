<?php include "connection.php";

date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

function getdate_Date($DateFormat){

  return date('d-M-Y',strtotime($DateFormat));;
}


$query="SELECT sum(Amount) FROM billing WHERE BillDate=curdate() and Cancelled=0";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$BillToday=$arr['sum(Amount)'];

$query="SELECT sum(Amount) FROM billing WHERE Cancelled=0";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$BillTotal=$arr['sum(Amount)'];


$query="SELECT sum(Qty-SaledQty) as Stock FROM purchase WHERE (Qty-SaledQty)>0;";
$result = mysqli_query($con,$query);
$arr=mysqli_fetch_assoc($result);
$Stock=$arr['Stock'];

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
  <?php include "header.php"; ?>
</head>
<body>

  <!-- Side Navbar -->
  <?php include "sidebar.php"; ?>
  <!-- Counts Section -->

  <section class="py-5">
    <div class="container-fluid">

      <!-- modals -->
      <?php include "modals.php"; ?>
      <!-- modal closed -->

      <div class="row">
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#numbers-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Today Billing</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 <?php echo number_format($BillToday,2); ?></h3>
            </div>
          </div>
        </div>
        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#numbers-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Total Billing</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 <?php echo number_format($BillTotal,2); ?></h3>
            </div>
          </div>
        </div>
        <!-- Count item widget-->
        <div class="col-xl-3 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Items in stock</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0"><?php echo $Stock; ?></h3>
            </div>
          </div>
        </div>

        <!-- Count item widget-->
        <div class="col-xl-3 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Income current month</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 92</h3>
            </div>
          </div>
        </div>

        <!-- Count item widget-->
        <div class="col-xl-2 col-md-4 col-6 gy-4 gy-xl-0">
          <div class="d-flex">
            <svg class="svg-icon svg-icon-sm svg-icon-heavy text-primary mt-1 flex-shrink-0">
              <use xlink:href="#literature-1"> </use>
            </svg>
            <div class="ms-2">
              <h3 class="h4 text-dark text-uppercase fw-normal">Total income</h3>
              <p class="text-gray-500 small"></p>
              <h3 class="mb-0">&#x20b9 92</h3>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- Header Section-->
  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">
        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Sales marketing report</h2>
            <p class="text-sm text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet officiis</p>
            <canvas id="lineCahrt"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">


        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Item less than 25 in stock</h2>                       
            <canvas id="lineCahrt"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-white py-5">
    <div class="container-fluid">
      <div class="row d-flex align-items-md-stretch">

        <!-- Line Chart -->
        <div class="col-lg-12 col-md-12">
          <div class="card shadow-0">
            <h2 class="h3 fw-normal">Item about to expire</h2>
            <canvas id="lineCahrt"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include "footer.php"; 

  ?>


  <!-- JavaScript files-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/just-validate/js/just-validate.min.js"></script>
  <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="vendor/overlayscrollbars/js/OverlayScrollbars.min.js"></script>
  <script src="js/charts-home.js"></script>
  <!-- Main File-->
  <script src="js/front.js"></script>


  <script type="text/javascript">
    function injectSvgSprite(path) {

      var ajax = new XMLHttpRequest();
      ajax.open("GET", path, true);
      ajax.send();
      ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
      }
    }
// this is set to BootstrapTemple website as you cannot 
// inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
// while using file:// protocol
// pls don't forget to change to your domain :)
injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
</script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<?php 
include "js-php.php";

?>
<script type="text/javascript">

  var intervalId = window.setInterval(function(){
    if(navigator.onLine){

    } else {
      alert('No internet connection!');
    }
  }, 5000);
/*
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{'username':username, 'UserType':UserType},
     success:function(result){
      if((result)==1){

        SuccessAlert('User Created');
        $('#AddUserF').trigger("reset");
        $('#AddUser').modal("hide");


      }else{

        Swal.fire({
          title: 'Error!',
          text: (result),
          icon: 'error',
          confirmButtonText: 'OK'
        })

      }
    }
  });*/

  Array.prototype.contains = function(obj) {
    var i = this.length;
    while (i--) {
      if (this[i] == obj) {
        return true;
      }
    }
    return false;
  }

  function limit(element)
  {
    var max_chars = 10;

    if(element.value.length > max_chars) {
      element.value = element.value.substr(0, max_chars);
    }
  }

  $(document).on('click', '.close', function(){
    $('#AddUserF').trigger("reset");
    $('#AddSellerF').trigger("reset");
    $('#AddCategoryF').trigger("reset");
    $('#AddItemsF').trigger("reset");
    $('#FindItemF').trigger("reset");
    $('#AddPurchaseF').trigger("reset");
  });


  function EmptyErrorAlert(){
    Swal.fire({
      title: 'Error!',
      text: 'Please enter all fields',
      icon: 'error',
      confirmButtonText: 'OK'
    })
  }

  function ExistErr(){
    Swal.fire({
      title: 'Error!',
      text: 'item already exist',
      icon: 'error',
      confirmButtonText: 'OK'
    })
  }

  function SuccessAlert(data){
    Swal.fire({
      title: 'success!',
      text: data,
      icon: 'success',
      confirmButtonText: 'OK'
    })
  }


  function AjaxPost(Page, Data, Modal, Form, Success){

    if (Modal!='NA') {

      $.ajax({
       url:Page,
       method:"POST",
       data:Data,
       success:function(result){
        alert(result);

        if (Modal=='Billing') {
          url='invoice.php?id='+(result);
          window.open(url, "_blank");
          var intervalId = window.setInterval(function(){
            location.reload()
          }, 1000);
        }

        if((result==1) && Modal!='Billing'){
          SuccessAlert(Success);
          $(Form).trigger("reset");
          $(Modal).modal("hide");

        }else if (Modal!='Billing'){

          Swal.fire({
            title: 'Error!',
            text: (result),
            icon: 'error',
            confirmButtonText: 'OK'
          })

        }
      }
    });


    }
  }


  function AjaxRead(Page, Data, Modal, Form, Result){
    $.ajax({
     url:Page,
     method:"POST",
     data:Data,
     success:function(result){
      console.log(result);
      if (Result=='SaleRate') {

        const obj = JSON.parse(result);
        Name = obj.ItemName;
        SellingRate=obj.SellingRate;
        AvQty=obj.AvQty;

        document.getElementById(Result).value=(SellingRate);
        document.getElementById("Name").value=(Name);
        document.getElementById("AvailableQty").value=(AvQty);

      }else{
        $(Result).html(result);
      }
      if (Modal!='NA') {
        $(Modal).modal("show");
      }

    }
  });

  }


  $(document).on('click', '.SaveUser', function(){

    var username = document.getElementById("NewUserName").value;
    var UserType = document.getElementById("UserType").value;
    var Page="insert.php";
    var Modal='#AddUser';
    var Form='#AddUserF';
    var Success='User Created';

    if (username && UserType) {
      var data={'username':username, 'UserType':UserType};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }

  });

  $(document).on('click', '.SaveSeller', function(){

    var NewSeller = document.getElementById("NewSeller").value;
    var NewSellerNumber = document.getElementById("NewSellerNumber").value;
    var Page="insert.php";
    var Modal='#AddSeller';
    var Form='#AddSellerF';
    var Success='Seller Added';

    if (NewSeller && NewSellerNumber) {
      var data={'NewSeller':NewSeller, 'NewSellerNumber':NewSellerNumber};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }

  });

  $(document).on('click', '.SaveCategory', function(){

    var NewCategory = document.getElementById("NewCategory").value;

    var Page="insert.php";
    var Modal='#AddCategory';
    var Form='#AddCategoryF';
    var Success='Category Added';

    if (NewCategory) {
      var data={'NewCategory':NewCategory};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }

  });


  $(document).on('click', '.SaveItem', function(){


    var input = document.getElementsByName('ItemArray[]');
    var input2 = document.getElementsByName('SellingRate[]');
    var input3 = document.getElementsByName('CategoryArray[]');
    var err=0;
    var item=[];
    var rate=[];
    var category=[];
    var Page="insert.php";
    var Modal='#AddItems';
    var Form='#AddItemsF';
    var Success='Item Added';


    for (var i = 0; i < input.length; i++) {

      var a = input[i];
      var b = input2[i];
      var c = input3[i];

      if (a.value && b.value && c.value) {
        item.push(a.value);
        rate.push(b.value);  
        category.push(c.value);           

      }else{
        EmptyErrorAlert();
        err=1;
        break;
      }
    }


    if (err==0) {
      var data={'NewItem':item, 'Category':category, 'SellingRate':rate};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }

  });


  $(document).on('click', '.SearchItem', function(){

    var FindItem = document.getElementById("FindItem").value;

    var Page="read.php";
    var Modal='#ResultItems';
    var Form='#AddCategoryF';
    var Result='#ItemResult';
    if (FindItem) {
      var data={'FindItem':FindItem};
      AjaxRead(Page, data, Modal, Form, Result);
      $('#FindItems').modal("hide");
      $('#FindItemF').trigger("reset");
    }else{
      EmptyErrorAlert();
    }

  });

  $(document).on('change', '#CategoryP', function(){

    var CategoryID=$(this).val();

    var Page="read.php";
    var Modal='NA';
    var Form='NA';
    var Result='#ItemP';
    if (FindItem) {
      var data={'CategoryIDP':CategoryID};
      AjaxRead(Page, data, Modal, Form, Result);
    }else{
      EmptyErrorAlert();
    }

  });



  $(document).on('change', '#ItemInvoice', function(){

    var ItemID=$(this).val();
    var Page="read.php";
    var Modal='NA';
    var Form='NA';
    var Result='SaleRate';
    if (ItemID){
      document.getElementById('ItemExpiryInvoice').disabled = false;
      //console.log(ItemID);
      var data={'ItemRate':ItemID};
      AjaxRead(Page, data, Modal, Form, Result);
    }else{
      document.getElementById('ItemExpiryInvoice').disabled = true;
    }    
  });


  $(document).on('click', '.SavePurchase', function(){

    var SellerID = document.getElementById("SellerID").value;
    var ItemID = document.getElementById("ItemP").value;
    var PurchaseRate = document.getElementById("PurchaseRate").value;
    var Qty = document.getElementById("Qty").value;
    var PurchaseDate = document.getElementById("PurchaseDate").value;
    var Discount = document.getElementById("Discount").value;
    var ItemExpiry = document.getElementById("ItemExpiry").value;
    var Amount = document.getElementById("Amount").value;

    var Page="insert.php";
    var Modal='#AddPurchase';
    var Form='#AddPurchaseF';
    var Success='Purchase Added';

    if (SellerID && ItemID && PurchaseRate && Qty && PurchaseDate && Discount && ItemExpiry && Amount) {
      var data={'SellerID':SellerID, 'ItemID':ItemID, 'PurchaseRate':PurchaseRate, 'Qty':Qty, 'PurchaseDate':PurchaseDate, 'Discount':Discount, 'ItemExpiry':ItemExpiry, 'Amount':Amount};
      AjaxPost(Page, data, Modal, Form, Success);
    }else{
      EmptyErrorAlert();
    }

  });


  $(document).on('change', '#CategoryInvoice', function(){

    var CategoryID=$(this).val();

    var Page="read.php";
    var Modal='NA';
    var Form='NA';
    var Result='#ItemInvoice';
    if (CategoryID) {
      var data={'CategoryIDP':CategoryID};
      AjaxRead(Page, data, Modal, Form, Result);
    }    
  });

  var DateErr=0;
  $(document).on('change', '#ItemExpiryInvoice', function(){

    var ExDate=$(this).val();
    var ItemID=document.getElementById("ItemInvoice").value;

    if (ExDate && ItemID) {
      $.ajax({
       url:"read.php",
       method:"POST",
       data:{'ExDate':ExDate, 'ItemIDEx':ItemID},
       success:function(result){
        if((result)==1){
          DateErr=0;
        }else{
          DateErr=1;
          Swal.fire({
            title: 'Error!',
            text: (result),
            icon: 'error',
            confirmButtonText: 'OK'
          })

        }
      }
    });
    }

  });



  // Node.js program to demonstrate the
// Node.js filehandle.read() Method

// Denotes total number of rows.
var rowIdx = 0;

// jQuery button click event to add a row.
var ItemIDArray=[];
var RateArray=[];
var QtyArray=[];
var AmountArray=[];
var DiscountArray=[];
var ExpArray=[];
var a=0;
$('.AddInvoice').on('click', function () {

  var ItemID=document.getElementById("ItemInvoice").value;
  var SaleRate=document.getElementById("SaleRate").value;
  var Qty=document.getElementById("QtyInvoice").value;
  var Discount=document.getElementById("DiscountInvoice").value;
  var ItemExpiry=document.getElementById("ItemExpiryInvoice").value;
  var ItemName=document.getElementById("Name").value;
  var AvQtys=document.getElementById("AvailableQty").value;
  //ItemIDArray.push(ItemID);

  //console.log(SaleRate);
  //console.log(Qty);
  //console.log(Discount);
  //console.log(ItemExpiry);
  var SubAmount=SaleRate*Qty;
  var Amount=SubAmount-((SubAmount*Discount)/100);

  if (ItemID && SaleRate && Qty && Discount && ItemExpiry && Amount && DateErr==0 && Qty<=AvQtys) {

    if (ItemIDArray.contains(ItemID)==true) {
      ExistErr();
    }else{
      ItemIDArray.push(ItemID);
      RateArray.push(SaleRate);
      QtyArray.push(Qty);
      AmountArray.push(Amount);
      DiscountArray.push(Discount);
      ExpArray.push(ItemExpiry);
      console.log(ExpArray);


      $('#BillData').append(`<tr id="R${++rowIdx}">

        <td class="row-index text-center">
        <p>${rowIdx}</p></td>

        <td class="row-index text-center">
        <p>${ItemName}</p></td>

        <td class="row-index text-center">
        <p>${SaleRate}</p></td>

        <td class="row-index text-center">
        <p>${Qty}</p></td>


        <td class="row-index text-center">
        <p>${Discount}</p></td>

        <td class="row-index text-center">
        <p>${Amount}</p></td>

        <td class="row-index text-center">
        <p>${ItemExpiry}</p></td>



        <td class="text-center">
        <button class="btn btn-danger remove"
        type="button" id="${ItemID}">Remove</button>
        </td>
        </tr>`);
      $('#AddInvoiceF').trigger("reset");
    }
  }else{
    if (DateErr==1) {
      Swal.fire({
        title: 'Error!',
        text: 'This item is not in purchase list with '+ItemExpiry+' expiry date',
        icon: 'error',
        confirmButtonText: 'OK'
      })
    }else if(Qty>AvQtys){
      Swal.fire({
        title: 'Error!',
        text: 'Item quantity must be less than Available quantity',
        icon: 'error',
        confirmButtonText: 'OK'
      })
    }else{
      EmptyErrorAlert();
    }
  }
});


// Node.js program to demonstrate the
// Node.js filehandle.read() Method

// jQuery button click event to remove a row
$('#BillData').on('click', '.remove', function () {


  var delItem = $(this).attr("id");
  console.log(delItem);
  
  const index = ItemIDArray.indexOf(delItem);
  if (index > -1) {
    ItemIDArray.splice(index, 1);
    RateArray.splice(index, 1);
    QtyArray.splice(index, 1);
    AmountArray.splice(index, 1);
    DiscountArray.splice(index, 1);
    ExpArray.splice(index, 1);
    console.log(ItemIDArray);

  }
  

  // Getting all the rows next to the
  // row containing the clicked button
  var child = $(this).closest('tr').nextAll();



  // Removing the current row.
  $(this).closest('tr').remove();

  // Decreasing the total number of rows by 1.
  rowIdx--;
});

$('.GenerateInvoice').on('click', function () {
  var Page="insert.php";
  var Modal='Billing';
  var Form='NA';
  var Success='Bill Generated';
  var Patient= document.getElementById("Pateint").value;
  var Doctor= document.getElementById("DrName").value;
  if ( Doctor && Patient) {

    var data={'ItemIDArray':ItemIDArray, 'RateArray':RateArray, 'QtyArray':QtyArray, 'AmountArray':AmountArray, 'DiscountArray':DiscountArray, 'ExpArray':ExpArray, 'Patient':Patient, 'Doctor':Doctor};
    AjaxPost(Page, data, Modal, Form, Success);
  }else{
    EmptyErrorAlert();
  }
});

</script>
</body>
</html>