<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> starlight</a></div>
<div class="sl-sideleft">
  <div class="input-group input-group-search">
    <input type="search" name="search" class="form-control" placeholder="Search">
    <span class="input-group-btn">
      <button class="btn"><i class="fa fa-search"></i></button>
    </span><!-- input-group-btn -->
  </div><!-- input-group -->

  <label class="sidebar-label">Navigation</label>

  <!-- sl-sideleft-menu -->
  <div class="sl-sideleft-menu">
    <!-- sl-menu-link -->
    <a href="{{route('admin.home')}}" class="sl-menu-link @yield('dashboard')">
      <!-- menu-item -->
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div>
    </a>

    {{-- Product --}}
    <a href="{{route('products.index')}}" class="sl-menu-link @yield('products')">
      <div class="sl-menu-item">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        <span class="menu-item-label">Products</span>
      </div><!-- menu-item -->
    </a>

    {{-- Catgeory --}}
    <a href="{{route('categories.index')}}" class="sl-menu-link @yield('categories')">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Categories</span>
      </div><!-- menu-item -->
    </a>

    {{-- attributes --}}
    <a href="#" class="sl-menu-link @yield('attributes')">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
        <span class="menu-item-label">Attributes</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('brands.index')}}" class="nav-link @yield('brands')">Brands</a></li>
      <li class="nav-item"><a href="{{route('coupons.index')}}" class="nav-link @yield('coupons')">Coupons</a></li>
    </ul>

    {{-- Order --}}
    <a href="#" class="sl-menu-link @yield('orders')">
      <div class="sl-menu-item">
          <i class="fa fa-cart-arrow-down"></i>
          <span class="menu-item-label">Orders</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item"><a href="{{route('orders.index')}}" class="nav-link @yield('new_orders')">New Orders</a></li>
      <li class="nav-item"><a href="{{route('orders.confirmed')}}" class="nav-link @yield('confirmed_orders')">Confirmed Orders</a></li>
      <li class="nav-item"><a href="{{route('orders.cancelled')}}" class="nav-link @yield('cancelled_orders')">Cancelled Orders</a></li>
    </ul>
  </div>

  <br>
</div><!-- sl-sideleft -->