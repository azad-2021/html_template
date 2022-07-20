<nav class="side-navbar">
  <!-- Sidebar Header    -->
  <div class="sidebar-header d-flex align-items-center justify-content-center p-3 mb-3">
    <!-- User Info-->
    <div class="sidenav-header-inner text-center"><img class="img-fluid rounded-circle avatar mb-3" src="img/avatar-7.jpg" alt="person">
      <h2 class="h5 text-white text-uppercase mb-0"><?php echo $_SESSION['user'] ?></h2>
      <p class="text-sm mb-0 text-muted"><?php echo $_SESSION['usertype'] ?></p>
    </div>
    <!-- Small Brand information, appears on minimized sidebar--><a class="brand-small text-center" href="index.php">
      <p class="h1 m-0">VP</p></a>
    </div>
    <!-- Sidebar Navigation Menus-->
    <span class="text-uppercase text-gray-500 text-sm fw-bold letter-spacing-0 mx-lg-2 heading">Management</span>
    <ul class="list-unstyled">                  
      <li class="sidebar-item">
        <a class="sidebar-link" href="index.php"> 
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#real-estate-1"> </use>
          </svg>Home 
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="profile.php"> 
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#portfolio-grid-1"> </use>
          </svg>Profile 
        </a>
      </li>

      <li class="sidebar-item"><a class="sidebar-link" href="" data-bs-toggle="modal" data-bs-target="#AddUser"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>Add User</a>
      </li>
      <li class="sidebar-item"><a class="sidebar-link" href="" data-bs-toggle="modal" data-bs-target="#AddSeller"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>Add Seller</a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="" data-bs-toggle="modal" data-bs-target="#AddCategory"> 
          <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
            <use xlink:href="#portfolio-grid-1"> </use>
          </svg>Create Category
        </a>
      </li>
      <li class="sidebar-item"><a class="sidebar-link" href="" data-bs-toggle="modal" data-bs-target="#AddItems"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>Add Item</a>
      </li>
      <li class="sidebar-item"><a class="sidebar-link" href="#exampledropdownDropdown" data-bs-toggle="collapse"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#browser-window-1"> </use>
        </svg>Find</a>
        <ul class="collapse list-unstyled" id="exampledropdownDropdown">
          <li><a class="sidebar-link" href="" data-bs-toggle="modal" data-bs-target="#FindItems">Item</a></li>
          <li><a class="sidebar-link" href="" data-bs-toggle="modal" data-bs-target="#FindBill">Bill</a></li>
        </ul>
      </li>

      <li class="sidebar-item"><a class="sidebar-link" href="allitems.php"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>All items</a>
      </li>

    </ul>

    <span class="text-uppercase text-gray-500 text-sm fw-bold letter-spacing-0 mx-lg-2 heading">Stock</span>
    <ul class="list-unstyled">                  

      <li class="sidebar-item"><a class="sidebar-link" href="" data-bs-toggle="modal" data-bs-target="#AddPurchase"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>Purchase Entry</a>
      </li>
      <li class="sidebar-item"><a class="sidebar-link" href="itemlist.php"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>Items in stock</a>
      </li>
      <li class="sidebar-item"><a class="sidebar-link" href="tables.html"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>About to expire</a>
      </li>
    </ul>


    <span class="text-uppercase text-gray-500 text-sm fw-bold letter-spacing-0 mx-lg-2 heading">Billing</span>
    <ul class="list-unstyled py-4">
      <li class="sidebar-item"> <a class="sidebar-link" href=""data-bs-toggle="modal" data-bs-target="#CreateInvoice"> 
        <svg class="svg-icon svg-icon-xs svg-icon-heavy me-xl-2">
          <use xlink:href="#chart-1"> </use>
        </svg>Create Invoice</a>
      </li>
      <li class="sidebar-item"><a class="sidebar-link" href="allinvoice.php"> 
        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
          <use xlink:href="#portfolio-grid-1"> </use>
        </svg>All Invoice</a>
      </li>
    </ul>
  </nav>

  <div class="page">
    <!-- navbar-->
    <header class="header">
      <nav class="navbar">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <a class="menu-btn d-flex align-items-center justify-content-center p-2 bg-gray-900" id="toggle-btn" href="#">
                <svg class="svg-icon svg-icon-sm svg-icon-heavy text-white">
                  <use xlink:href="#menu-1"> </use>
                </svg>
              </a>
              <a class="navbar-brand ms-2" href="index.php">
                <div class="brand-text d-none d-md-inline-block text-uppercase letter-spacing-0">
                  <span class="text-white fw-normal text-xs">Ved Pharmacy </span>
                  <strong class="text-primary text-sm"> Dashboard</strong>
                </div>
              </a>
            </div>
            <ul class="nav-menu mb-0 list-unstyled d-flex flex-md-row align-items-md-center">

              <!-- Log out-->
              <li class="nav-item">
                <a class="nav-link text-white text-sm ps-0" href="logout.php">
                  <span class="d-none d-sm-inline-block">Logout</span>
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#security-1"> </use>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>