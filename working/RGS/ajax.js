$(document).ready(function () {
  $.ajax({
    type:'POST',
    url:'read.php',
    data:{'LeaveDetails':'LeaveDetails'},
    success:function(result){
      $('#LeaveData').html(result);
    }
  }); 
});

$(document).on('change', '#BranchIDF', function(){
  var BranchID=$(this).val();
  console.log(BranchID);
  if (BranchID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'BranchID':BranchID},
      success:function(result){
        $('#FeesStudent').html(result);
      }
    });
  }else{
    $('#FeesStudent').html('<option value="">No Students</option>'); 
  }
});


$(document).on('change', '#FeesStudent', function(){
  var StudentID=$(this).val();
  console.log(StudentID);
  if (StudentID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'StudentID':StudentID},
      success:function(result){
        var r = (result);

        document.getElementById("TotalAmount").value = r;

      }
    });
  }
});


$(document).on('click', '.SaveFees', function(){
  var BranchID=document.getElementById("BranchIDF").value;
  var TotalAmount = document.getElementById("TotalAmount").value;
  var StudentID= document.getElementById("FeesStudent").value;
  var Year = document.getElementById("year").value;
  var ReceivedAmount=document.getElementById("FeesAmount").value;
  var Remark=document.getElementById("RemarkFees").value;


  if (StudentID!='' && BranchID !='' && TotalAmount!='' && ReceivedAmount!='' && Year!='' && Remark!='') {
    $.ajax({
      type:'POST',
      url:'insert.php',
      data:{'TotalAmount':TotalAmount, 'ReceivedAmount':ReceivedAmount, 'Year':Year, 'StudentID':StudentID, 'BranchID':BranchID, 'Remark':Remark},
      success:function(result){
        swal("success","Fees Updated","success"); 
        $('#re').html(result);
        $('#AddFees').modal('hide');
        $('#FeesForm').trigger("reset");
      }
    });
  }else{
    swal("error","Please enter all fields","error");
  }
});


$(document).on('click', '.SearchStudent', function(){
  var Name = document.getElementById("FStudentName").value;
  if (Name) {
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'StudentName':Name},
      success:function(result){
        $('#StudentData').html(result);
        $('#StudentDetails').modal('show');
      }
    });
  }
});

$(document).on('change', '#CourseID', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseID':CourseID},
      success:function(result){
        $('#BranchID').html(result);
      }
    }); 
  }else{
    $('#BranchID').html('<option value="">Branch</option>'); 
  }

});

$(document).on('change', '#CourseIDF', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseIDF':CourseID},
      success:function(result){
        $('#BranchIDF').html(result);
      }
    }); 
  }else{
    $('#BranchIDF').html('<option value="">Branch</option>'); 
  }

});


$(document).on('change', '#CIDAddStaff', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseIDF':CourseID},
      success:function(result){
        $('#BIDAddStaff').html(result);
      }
    }); 
  }else{
    $('#BIDAddStaff').html('<option value="">Branch</option>'); 
  }

});


//salary

$(document).on('change', '#CIDAddSalary', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseIDF':CourseID},
      success:function(result){
        $('#BIDAddSalary').html(result);
      }
    }); 
  }else{
    $('#BIDAddSalary').html('<option value="">Branch</option>'); 
  }

});


$(document).on('change', '#BIDAddSalary', function(){
  var BranchID=$(this).val();

  if (BranchID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'BranchIDS':BranchID},
      success:function(result){
        $('#StaffIDS').html(result);
      }
    });

  }else{
    $('#StaffIDS').html('<option value="">Staff</option>'); 
  }
});


$(document).on('change', '#StaffIDS', function(){
  var StaffID=$(this).val();
  console.log(StaffID);
  if (StaffID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'StaffID':StaffID},
      success:function(result){
        document.getElementById("SalaryAmount").value=(result);
      }
    });

    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'StaffIDD':StaffID},
      success:function(result){
        $('#SalaryData').html(result);
      }
    });

  }
});


$(document).on('click', '.SaveSalary', function(){

  var SID=$(this).attr("id2");
  var Salary = document.getElementById(SID).value;
  console.log(Salary);
  var StaffID= document.getElementById("StaffIDS").value;
  if (Salary) {
    $.ajax({
      type:'POST',
      url:'insert.php',
      data:{'SalaryAmount':Salary, 'SID':SID},
      success:function(result){
        swal("success","Salary Updated","success"); 
      }
    });

    var delayInMilliseconds = 1000; 

    setTimeout(function() {
     $.ajax({
      type:'POST',
      url:'read.php',
      data:{'StaffIDD':StaffID},
      success:function(result){
        $('#SalaryData').html(result);
      }
    });
   }, delayInMilliseconds);

  }else{
    swal("error","Please enter salary release amount","error");
  }
});

$(document).on('click', '.cl', function(){

  var delayInMilliseconds = 1000; 

  setTimeout(function() {
    location.reload();
  }, delayInMilliseconds);


});


$(document).on('click', '.LeaveAction', function(){

  var ApplicationID=$(this).attr("id");
  var Type=$(this).attr("id2");
  var StaffID=$(this).attr("id3");

  if (ApplicationID) {
    $.ajax({
      type:'POST',
      url:'insert.php',
      data:{'ApplicationID':ApplicationID, 'Type':Type, 'StaffIDleave':StaffID},
      success:function(result){
        swal("success","Leave Status Updated","success"); 
      }
    });

    var delayInMilliseconds = 1000; 

    setTimeout(function() {

      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'LeaveDetails':'LeaveDetails'},
        success:function(result){
          $('#LeaveData').html(result);
        }
      });

    }, delayInMilliseconds);

  }else{
    swal("error","Please enter salary release amount","error");
  }
});

$(document).on('change', '#CODAddCourse', function(){
  var CourseID= $(this).val();

  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseIDF':CourseID},
      success:function(result){
        $('#CODAddBanch').html(result);
      }
    }); 
  }else{
    $('#CODAddBanch').html('<option value="">Branch</option>'); 
  }

});


$(document).on('change', '#CODAddBanch', function(){
  var BranchID=$(this).val();

  if (BranchID) {
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'BranchIDS':BranchID},
      success:function(result){
        $('#StaffIDCOD').html(result);
      }
    });

  }else{

    $('#StaffIDCOD').html('<option value="">Staff</option>'); 
  }
});

$(document).on('change', '#StaffIDCOD', function(){
  var ID=$(this).val();
  if (ID) {
    document.getElementById("CODYear").disabled = false;
  }else{
    document.getElementById("CODYear").disabled = true;
  }
});


$(document).on('change', '#CODYear', function(){
  var Year=$(this).val();
  var StaffID=document.getElementById("StaffIDCOD").value;

  if (StaffID=='') {
    swal("error","Please select staff","error")
  }else if(StaffID!='' && Year!=''){
    $.ajax({
      type:'POST',
      url:'insert.php',
      data:{'YearCoordinator':Year, 'StaffCoordinator':StaffID},
      success:function(result){

        $('#CoordinatorForm').trigger("reset");
        swal("success","Updated","success")
      }
    });

  }
});




$(document).on('change', '#CourseIDSt', function(){
  var CourseID= $(this).val();
  console.log(CourseID);
  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseID':CourseID},
      success:function(result){
        $('#BranchIDSt').html(result);
      }
    }); 
  }else{
    $('#BranchIDSt').html('<option value="">Branch</option>'); 
  }

});

$(document).on('change', '#BranchIDSt', function(){
  var BranchID= $(this).val();

  if(BranchID){
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'BranchIDSta':BranchID},
      success:function(result){
        $('#example').DataTable().clear();
        $('#example').DataTable().destroy();
        $('#StaffData').html(result);
        $('#example').DataTable();
      }
    }); 
  }

});



$(document).on('click', '.FeesDetails', function(){

  var StudentID=$(this).attr("id");
  var delayInMilliseconds = 1000; 

  setTimeout(function() {
    if (StudentID) {
      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'StudentIDFees':StudentID},
        success:function(result){
          $('#FeesData').html(result);
        }
      });
    }
  }, delayInMilliseconds)
});

$(document).on('click', '.SalaryDetailsS', function(){

  var StaffID=$(this).attr("id");
  var delayInMilliseconds = 1000; 

  setTimeout(function() {
    if (StaffID) {
      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'StaffIDSalary':StaffID},
        success:function(result){
          $('#SalaryDataS').html(result);
        }
      });
    }
  }, delayInMilliseconds)
});




$(document).on('change', '#CourseIDSt', function(){
  var CourseID= $(this).val();
  console.log(CourseID);
  if(CourseID){
    $.ajax({
      type:'POST',
      url:'search.php',
      data:{'CourseID':CourseID},
      success:function(result){
        $('#BranchIDSt').html(result);
      }
    }); 
  }else{
    $('#BranchIDSt').html('<option value="">Branch</option>'); 
  }

});

$(document).on('change', '#BranchIDSt', function(){
  var BranchID= $(this).val();

  if(BranchID){
    $.ajax({
      type:'POST',
      url:'read.php',
      data:{'BranchIDSt':BranchID},
      success:function(result){
        $('#example').DataTable().clear();
        $('#example').DataTable().destroy();
        $('#StudentData').html(result);
        $('#example').DataTable();
      }
    }); 
  }

});



$(document).on('click', '.FeesDetails', function(){

  var StudentID=$(this).attr("id");
  var delayInMilliseconds = 1000; 

  setTimeout(function() {
    if (StudentID) {
      $.ajax({
        type:'POST',
        url:'read.php',
        data:{'StudentIDFees':StudentID},
        success:function(result){
          $('#FeesData').html(result);
        }
      });
    }
  }, delayInMilliseconds)
});
