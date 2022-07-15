<div class="modal fade" id="AddUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add new user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="AddUserF">
          <div class="row">

            <div class="col-lg-6">
              <label>Enter User Name</label>
              <input type="text" class="form-control" name="NewUserName" id="NewUserName">
            </div>

            <div class="col-lg-6">
              <label>Select User Type</label>
              <select class="form-select" id="UserType">
                <option value="">Select</option>
                <option value="Admin">Admin</option>
                <option value="Employee">Employee</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SaveUser">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="AddCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="AddCategoryF">
          <center>
            <div class="col-lg-6">
              <label>Enter Category Name</label>
              <input type="text" class="form-control" name="NewCategory" id="NewCategory">
            </div>
          </center>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SaveCategory">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="AddSeller" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add new seller</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="AddSellerF">
          <div class="row">
            <div class="col-lg-6">
              <label>Enter Seller Name</label>
              <input type="text" class="form-control" name="NewSeller" id="NewSeller">
            </div>
            <div class="col-lg-6">
              <label>Enter Seller Number</label>
              <input type="number" min=0 class="form-control" name="NewSellerNumber" id="NewSellerNumber" onkeydown="limit(this);" onkeyup="limit(this);">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SaveSeller">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="AddItems" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="AddItemsF">
          <div class="row field">

            <div class="col-lg-6">
              <label>Enter Item Name</label>
              <input type="text" class="form-control" name="ItemArray[]" id="NewItem">
            </div>

            <div class="col-lg-3">
              <label>Selling Rate</label>
              <input type="number" min=0 class="form-control" name="SellingRate[]" id="SellingRate">
            </div>

            <div class="col-lg-3">
              <label>Select Item Category</label>
              <select class="form-select form-control" name="CategoryArray[]" id="Category">
                <option value="">Select</option>
                <?php 
                $query="SELECT * from category order by Category";
                $result = mysqli_query($con,$query);
                if(mysqli_num_rows($result)>0)
                {
                  while ($row=mysqli_fetch_assoc($result))
                  {
                    echo "<option value='".$row['CategoryID']."'>".$row['Category']."</option><br>";
                  }
                }
                ?>
              </select>
            </div>
            
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary add_button" onclick="javascript:void(0);">More items</button>
        <button type="button" class="btn btn-primary SaveItem">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="FindItems" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Find Items</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="FindItemF">
          <div class="row">
            <center>
              <div class="col-lg-6">
                <label>Enter Item Name</label>
                <input type="text" class="form-control" name="FindItem" id="FindItem">
              </div>
            </center>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SearchItem">Search</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ResultItems" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Item details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="ItemResult">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="FindBill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Find Bill</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="row">
          <center>
            <div class="col-lg-6">
              <label>Enter invoice number</label>
              <input type="text" class="form-control" name="FindBill" id="FindBill">
            </div>
          </center>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Search</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="AddPurchase" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Enter Purchase Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="AddPurchaseF">
          <div class="row">

            <div class="col-lg-6">
              <label>Seller Name</label>
              <select class="form-select" id="SellerID">
                <option value="">Select</option>
                <?php 
                $query="SELECT * from sellers Order By SellerName";
                $result = mysqli_query($con,$query);
                if(mysqli_num_rows($result)>0)
                {
                  while ($row=mysqli_fetch_assoc($result))
                  {
                    echo "<option value='".$row['SellerID']."'>".$row['SellerName']."</option><br>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="col-lg-6">
              <label>Select Category</label>
              <select class="form-select" id="CategoryP">
                <option value="">Select</option>
                <?php 
                $query="SELECT * from category order by Category";
                $result = mysqli_query($con,$query);
                if(mysqli_num_rows($result)>0)
                {
                  while ($row=mysqli_fetch_assoc($result))
                  {
                    echo "<option value='".$row['CategoryID']."'>".$row['Category']."</option><br>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="col-lg-6">
              <label>Select Item</label>
              <select class="form-select" id="ItemP">
                <option value="">Select</option>
              </select>
            </div>

            <div class="col-lg-6">
              <label>Purchase MRP Rate</label>
              <input type="number" min=0 class="form-control" name="PurchaseRate" id="PurchaseRate">
            </div>
            <div class="col-lg-6">
              <label>Quantity</label>
              <input type="number" min=0 class="form-control" name="Qty" id="Qty">
            </div>
            <div class="col-lg-6">
              <label>Purchase Date</label>
              <input type="date" class="form-control" name="PurchaseDate" id="PurchaseDate">
            </div>
            <div class="col-lg-6">
              <label>Amount</label>
              <input type="number" min=0 class="form-control" name="Amount" id="Amount">
            </div>
            <div class="col-lg-6">
              <label>Discount</label>
              <input type="number" min=0 class="form-control" name="Discount" id="Discount">
            </div>
            <center>
              <div class="col-lg-6">
                <label>Item Expiry Date</label>
                <input type="date" class="form-control" min="<?php echo $Date; ?>" name="ItemExpiry" id="ItemExpiry">
              </div>
            </center>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary SavePurchase">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="CreateInvoice" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Invoice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form id="AddPurchaseF">
          <div class="row">

            <div class="col-lg-6">
              <label>Select Category</label>
              <select class="form-select" id="CategoryInvoice">
                <option value="">Select</option>
                <?php 
                $query="SELECT * from category order by Category";
                $result = mysqli_query($con,$query);
                if(mysqli_num_rows($result)>0)
                {
                  while ($row=mysqli_fetch_assoc($result))
                  {
                    echo "<option value='".$row['CategoryID']."'>".$row['Category']."</option><br>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="col-lg-6">
              <label>Select Item</label>
              <select class="form-select" id="ItemInvoice">
                <option value="">Select</option>
              </select>
            </div>

            <div class="col-lg-6">
              <label>MRP Rate</label>
              <input type="text" min=0 class="form-control" name="SaleRate" id="SaleRate" disabled>
            </div>
            <div class="col-lg-6">
              <label>Quantity</label>
              <input type="number" min=0 class="form-control" name="Qty" id="QtyInvoice">
            </div>
            <div class="col-lg-6">
              <label>Discount</label>
              <input type="number" min=0 class="form-control" name="Discount" id="DiscountInvoice">
            </div>

            <div class="col-lg-6">
              <label>Item Expiry Date</label>
              <input type="date" class="form-control" min="<?php echo $Date; ?>" name="ItemExpiryInvoice" id="ItemExpiryInvoice">
            </div>

          </div>
        </form>
        <table class="table table-hover table-bordered border-primary table-responsive" style="margin: 20px;">
          <thead>
            <th>Sr No.</th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Discount</th>
            <th>Amount</th>
            <th>Expiry Date</th>
            <th>Action</th>
          </thead>
          <tbody id="BillData">
            
          </tbody>
          
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary AddInvoice">Add</button>
        <button type="button" class="btn btn-primary SaveItem">Save</button>
      </div>
    </div>
  </div>
</div>