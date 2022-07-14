<script type="text/javascript">
  var id=2;
  $(document).ready(function(){
    var maxField = 20; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field'); //Input field wrapper

    var x = 1; 
    
    $(addButton).click(function(){

      var inb='<div class="col-lg-4" id="f1'+id+'"><label>Enter Item Name</label><input type="text" class="form-control" name="ItemArray[]"></div>';

      var inb2='<div class="col-lg-3" id="f2'+id+'"><label>Selling Rate</label><input type="number" min=0 class="form-control" name="SellingRate[]"></div>';

      var fieldHTML = inb+ inb2 + '<div class="col-lg-3" id="f3'+id+'"><label>Select Category</label><select name="CategoryArray[]" class="form-control"> <option value="">Select</option><?php
      $Data="SELECT * from category order by Category";
      $result=mysqli_query($con,$Data);
      if (mysqli_num_rows($result)>0)
      {
        while ($arr=mysqli_fetch_assoc($result))
        {
          ?>
          <option value="<?php echo $arr['CategoryID']; ?>"><?php echo $arr['Category']; ?></option> <?php
        }
      }?></select></div><div class="col-lg-2" style="margin-top:20px;" id="f4'+id+'"><button class="btn btn-danger remove_button" onclick="javascript:void(0);" id="'+id+'"> Remove</button></div>';


      if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
            id++;
          }
        });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
      var idf=$(this).attr("id");
      console.log(idf);
      $('#'+'f1'+idf).remove();
      $('#'+'f2'+idf).remove();
      $('#'+'f3'+idf).remove();
      $('#'+'f4'+idf).remove();
      x--;
      id--;
    });
  });
</script>