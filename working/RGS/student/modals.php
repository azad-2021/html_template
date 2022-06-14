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


