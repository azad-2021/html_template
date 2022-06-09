<!-- Modal -->
<div class="modal fade" id="ApplyLeave" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-corner">
      <div class="modal-header rounded-corner">
        <h5 class="modal-title">Apply Leave</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form align="center" method="POST" action="" style="color:white;">
          <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-4">
                <label for="recipient-name" class="col-form-label">Reason</label>
                <textarea  style="color:white;" class="form-control" name="Description" required></textarea>
              </div>
              <div class="col-lg-4">
                <label for="recipient-name" class="col-form-label">Start Date</label>
                <input style="color:white" type="date" class="form-control" name="SDate" required>
              </div>            
              <div class="col-lg-4">
                <label for="recipient-name" class="col-form-label">End Date</label>
                <input style="color:white" type="date" class="form-control" name="EDate" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="SaveLeave">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="AddStaff" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content rounded-corner">
        <div class="modal-header rounded-corner">
          <h5 class="modal-title">Enter Staff Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form align="center" method="POST" action="" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input style="color:white" type="text" class="form-control" name="StaffName" required>
              </div>
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">AADHAR Card Number</label>
                <input style="color:white" type="number" class="form-control" name="StaffAadhar" required min="0" maxlength="16">
              </div>
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Salary Amount</label>
                <input style="color:white" type="number" class="form-control" name="SalaryAmount" required min="0" maxlength="16">
              </div>
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Gender:</label>
                <br>
                <div class="form-check form-check-inline">
                  <input style="color:white" class="form-check-input" type="radio" name="Gender" value="Male" required>
                  <label class="form-check-label" for="flexRadioDefault1">
                    Male
                  </label>
                </div>
                <div class="form-check form-check-inline">
                  <input style="color:white" class="form-check-input" type="radio" name="Gender" value="Female">
                  <label class="form-check-label" for="flexRadioDefault2">
                    Female
                  </label>
                </div>
              </div>
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Mobile Number</label>
                <input style="color:white" type="text" class="form-control" name="StaffNumber" onkeydown="limit(this);" onkeyup="limit(this);" required>
              </div>
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Email</label>
                <input style="color:white" type="email" class="form-control" name="StaffEmail" required>
              </div>
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Address</label>
                <input style="color:white" type="text" class="form-control" name="StaffAddress" required>
              </div>
              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Upload Resume</label>
                <input style="color:white" type="file" class="form-control" name = "Resume" />
              </div>  
              <center>
                <div class="col-lg-6">
                  <label for="recipient-name" class="col-form-label">Educational Details</label>
                  <textarea style="color:white" class="form-control" name="StaffEducation" required></textarea>
                  <br>
                </div>
              </center>    
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="SaveStaff">Save</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="AddSalary" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-corner">
        <div class="modal-header rounded-corner">
          <h5 class="modal-title">Release Salary</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form align="center" id="SalaryForm">
            <div class="row">

              <div class="col-lg-3">
                <label for="recipient-name" class="col-form-label">Select Staff</label>
                <select style="color:white" class="form-control" id="StaffIDS">
                  <option value="">Select</option>
                  <?php 
                  $query ="SELECT * FROM staff WHERE Inservice=1";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                      echo '<option value="'.$row['StaffID'].'">'.$row['StaffName'].'</option>';
                    }}?>
                  </select>
                </div> 
                <div class="col-lg-3">
                  <label for="recipient-name" class="col-form-label">Salary Amount</label>
                  <input style="color:white; background-color:black;" type="text" class="form-control" id="SalaryAmount" min="0" disabled="">
                </div>
                <div class="col-lg-3">
                  <label for="recipient-name" class="col-form-label">Enter Amount</label>
                  <input style="color:white" type="number" class="form-control" id="Salary" min="0">
                </div>  
                <div class="col-lg-3">
                  <label for="recipient-name" class="col-form-label">Select Month</label>
                  <input style="color:white" type="month" class="form-control" id="SalaryMonth">
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </form>
              <button type="button" class="btn btn-primary SaveSalary">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="AddFees" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content rounded-corner">
          <div class="modal-header rounded-corner">
            <h5 class="modal-title">Enter Fees Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form align="center" id="FeesForm">
              <div class="row">
                <div class="col-lg-3">
                  <label for="recipient-name" class="col-form-label">Select Course</label>
                  <select style="color:white" class="form-control" id="CourseIDF" required="">
                    <option value="">Select</option>
                    <?php 
                    $query ="SELECT * FROM courses";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result)>0){
                      while($row=mysqli_fetch_assoc($result)){
                        echo '<option value="'.$row['CourseID'].'">'.$row['Course'].'</option>';
                      }}?>
                    </select>
                  </div>

                  <div class="col-lg-3">
                    <label for="recipient-name" class="col-form-label">Select Branch</label>
                    <select style="color:white" class="form-control" id="BranchIDF" required="">
                      <option value="">Select</option>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label for="recipient-name" class="col-form-label">Select Student</label>
                    <select style="color:white" class="form-control" id="FeesStudent">  
                      <option>Select</option>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label for="recipient-name" class="col-form-label">Total Amount</label>
                    <input style="color:white; background-color: black;" type="text" class="form-control" id="TotalAmount" disabled>
                  </div>
                  <div class="col-lg-3">
                    <label for="recipient-name" class="col-form-label">Select Year</label>
                    <select id="year" class="form-control" style="color:white;">
                      <option value="">Select</option>
                      <option value="1">I</option>
                      <option value="2">II</option>
                      <option value="3">III</option>
                      <option value="4">IV</option>
                    </select>
                  </div>
                  
                  <div class="col-lg-3">
                    <label for="recipient-name" class="col-form-label">Paid Amount</label>
                    <input style="color:white; margin-bottom:10px" type="number" class="form-control" id="FeesAmount" min="0">
                  </div>
                  
                  <div class="col-lg-6">
                    <label for="recipient-name" class="col-form-label">Remark</label>
                    <textarea class="form-control" style="color: white;" id="RemarkFees"></textarea>
                  </div>
                </div>
                
                <div class="modal-footer">
                  <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
                <button type="button" class="btn btn-primary SaveFees">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>