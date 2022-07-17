<?php  
include('connection.php');   
$Company='Ved Pharmacy';
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$ID=$_GET['id'];

$query="SELECT * FROM billing WHERE BillID=$ID";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
  $arr=mysqli_fetch_assoc($result);
  $Patient=$arr['PateintName'];
  $DrName=$arr['DrName'];
  $InvoiceNo=$arr['InvoiceNo'];
  $BillDate=date('d-M-Y',strtotime($arr['BillDate']));
  
}

?>

<!DOCTYPE html>  
<html>  
<head>   
  <title>Invoice</title>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
    <?php include "header.php"; ?>

    <style type="text/css">
      body{
        color: black;
      }

      .invoice {
        /*border:1px solid Black;*/
        padding:1px;
        height:900pt;
        width:700pt;
      }


      .displayNum {
        /*border:1px solid Black;*/
        border:2px solid #57CF16;
        padding:1px;
        text-align: center;
      }


      .billed {
        /*border:1px solid #ccc;*/
        float:left;
      }

      .invoice-details {
        border:2px solid #57CF16;
        padding: 3px;
        /*width:200pt;*/

      }

      .tax-header{
        border:2px solid black;
        text-align: center;
      }

      .amount-display {
        /*border:1px solid #ccc;*/
        float:right;
        width:200pt;
      }

      .customer-address {
        border:1px solid #57CF16;
        float:right;
        margin-bottom:50px;
        margin-top:100px;
        width:200pt;
      }

      .clear-fix {
        clear:both;
        float:none;
      }

      .tablet {
        width:100%;
      }

      .th {
        text-align: center;
      }

      .td {
        text-align: center;
        margin: 5px;
      }

      .text-left {
        text-align:center;
      }

      .text-center {
        text-align:center;
      }

      .text-right {
        text-align:right;
      }

      h1{
        color: #57CF16;
      }

    </style>
  </head>  
  <body > 
    <div id="invoice">
      <div  style="font-family: Arial;" class="container">
        <div class="row">

          <div class="col-lg-12" style="margin-top: 20px;">
            <p>
              <span style=" float: left;">
                DL No. Lucknow: <strong><br>UP32200009250, UP3210004245 </strong>
              </span>
              <center>
                <span style="border: 1px solid; border-radius: 5px; margin-left: -200px; color: #57CF16;">
                  <strong>Bill/Cash Memo</strong>
                </span>
              </center>
              <span style="margin-top: -50px; float: right;">
                Mobile No. <strong><br>8707488809, 9554539571</strong>
              </span>
            </p>
          </div>


          <div class="col-12">
            <center>
              <h1>
                <span style="margin-top: 10px;">
                  <strong><?php echo $Company; ?></strong>
                </span>
              </h1>
            </center>
          </div>
          <center>
            <p style="margin-top:-10px">
              <strong>Hearist & Druggist</strong>
            </p>
          </center>
        </div>
        <center>
          <p style="font-size:12px; margin-top:-15px; ">
           Address: <strong>Ground Floor, Mishrapur, Near Sport college Kursi Road, Gudamba, Lucknow</strong> 
         </p>
       </center>
     </div>

     <div class="col-12" style="float: right;">
      <p style="font-size:12px; color: black; float: right; margin-top: -80px; margin-right: 70px;">
        Invoice No.: <strong><?php echo $InvoiceNo; ?></strong>
      </p>
      <br>
      <p style="font-size:12px; color: black; margin-top: -80px; margin-right: 90px; float: right;">
        Date: <strong><?php echo ' '.$BillDate ?></strong>
      </p>
    </div>

    <div class="container" style="margin-bottom: 2px;">
      <fieldset class="invoice-details">
        <div class="row">
          <div class="col-6">
            <p style="margin-bottom:-5px; font-size: 15px; float: right;">Patient Name: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $Patient; ?></strong></p>
          </div>
          <div class="col-6">
            <p style="margin-bottom:-3px; font-size: 15px;">Doctor's Name: &nbsp;&nbsp;&nbsp;&nbsp; <strong><?php echo $DrName; ?></strong></p>
          </div>
        </div>
      </fieldset>
    </div>

    <div class="container">
      <table class="table table-hover table-bordered border-primary" align="center">
        <thead>
          <tr>
            <th style="min-width: 20px;" scope="col">Sr.No.</th>
            <th style="min-width: 200px;" scope="col">Particulars</th>
            <th style="min-width: 20px;" scope="col">Qty</th>
            <th style="min-width: 50px;" scope="col">MRP</th>
            <th style="min-width: 20px;" scope="col">Disc</th>
            <th style="min-width: 50px;" scope="col">Amount</th>
            <th style="min-width: 50px;" scope="col">Expiry Date</th>
          </tr>
        </thead>
        <tbody>
          <?php 

          $query="SELECT * FROM u241098585_medshop.billing
          join items on billing.ItemID=items.ItemID WHERE InvoiceNo='$InvoiceNo'";
          $result = mysqli_query($con,$query);
          if(mysqli_num_rows($result)>0)
          {

            $Sr=1;
            $Total=array();
            while ($row=mysqli_fetch_assoc($result))
            {
              $Total[]=$row['Amount'];
              print "<tr>";
              print '<td>'.$Sr.'</td>';
              print '<td>'.$row['ItemName']."</td>";
              print '<td>'.$row['Qty']."</td>";
              print '<td>'.$row['Rate']."</td>";
              print '<td>'.$row['Discount']."</td>";
              print '<td>'.$row['Amount']."</td>";
              print '<td>'.date('d-M-Y',strtotime($row['ExpiryDate']))."</td>";
              print "<tr>";  
            }


          }

          ?>
        </tbody>
      </table>
      <h3>Total : &#x20b9 <?php echo array_sum($Total); ?></h3>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-12" align="center">
          <br>
          <p style="font-size: 12px; float: right;"> FOR <?php echo $Company ?>
          <br>
          <img src="sur.jpg" height="60px" width="120px" style="float: right;">
        </p>
      </div>
      <div class="col-12" align="center">
        <p style="font-size: 12px; float: right;">Authorised Signature</p>

      </div>
    </div>
  </div>
</div>
<center><button id="print" onclick="printContent('invoice'); " class=" btn btn-success">Print</button></center>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/just-validate/js/just-validate.min.js"></script>
<script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="vendor/overlayscrollbars/js/OverlayScrollbars.min.js"></script>
<script src="js/charts-home.js"></script>
<!-- Main File-->
<script src="js/front.js"></script>
<script type="text/javascript">
  function printContent(el){
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
  }
</script>
</body>
</html>