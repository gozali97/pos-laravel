<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{url('/assets/images/logos/dark-logo.svg')}}" class="dark-logo" width="180" alt="" />
                <img src="{{url('/assets/images/logos/light-logo.svg')}}" class="light-logo"  width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-aperture"></i>
                  </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <!-- ============================= -->
                <!-- Apps -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/kategori')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-category-2"></i>
                  </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/produk')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-cpu-2"></i>
                  </span>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{url('/member')}}" aria-expanded="false">
                  <span>
                    <i class="ti ti-list-details"></i>
                  </span>
                        <span class="hide-menu">Member</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                  <span class="d-flex">
                    <i class="ti ti-basket"></i>
                  </span>
                        <span class="hide-menu">Ecommerce</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="./eco-shop.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Shop</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="./eco-shop-detail.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Details</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="./eco-product-list.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">List</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="./eco-checkout.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Checkout</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- ============================= -->
                <!-- PAGES -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">PAGES</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./page-account-settings.html" aria-expanded="false">
                  <span>
                    <i class="ti ti-user-circle"></i>
                  </span>
                        <span class="hide-menu">Account Setting</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="../../../landingpage/index.html" aria-expanded="false">
                  <span>
                    <i class="ti ti-app-window"></i>
                  </span>
                        <span class="hide-menu">Landing Page</span>
                    </a>
                </li>

                <!-- ============================= -->
                <!-- OTHER -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">OTHER</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="#" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                      <i class="ti ti-award"></i>
                    </span>
                            <span class="hide-menu">Chip</span>
                        </div>
                        <div class="hide-menu">
                            <span class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center round-20 p-0">9</span>
                        </div>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link justify-content-between" href="#" aria-expanded="false">
                        <div class="d-flex align-items-center gap-3">
                    <span class="d-flex">
                      <i class="ti ti-mood-smile"></i>
                    </span>
                            <span class="hide-menu">Outlined</span>
                        </div>
                        <span class="hide-menu badge rounded-pill border border-primary text-primary fs-2 py-1 px-2">Outline</span>
                    </a>
                </li>
            </ul>
            <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded">
                <div class="d-flex">
                    <div class="unlimited-access-title">
                        <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Unlimited Access</h6>
                        <button class="btn btn-primary fs-2 fw-semibold lh-sm">Signup</button>
                    </div>
                    <div class="unlimited-access-img">
                        <img src="../../dist/images/backgrounds/rocket.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </nav>
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt="">
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                    <span class="fs-2 text-dark">Designer</span>
                </div>
                <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </button>
            </div>
        </div>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
