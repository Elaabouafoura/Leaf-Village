<aside class="left-sidebar">
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <div class="logo-container d-flex align-items-center">
        <div class="login-icon">
          <i class="fas fa-leaf"></i>
        </div>
      <h2 class="brand-name">Leaf Village</h2>
   </div>
    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
      <i class="ti ti-x fs-8"></i>
    </div>
</div>

    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <!-- Dashboard Section -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Dashboard</span>
        </li>
      

        <!-- Green Spaces Management -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Green Spaces</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/dashboard/espaces_verts') }}">
            <i class="ti ti-trees"></i>
            <span class="hide-menu">Parks & Gardens</span>
          </a>
        </li>


        <!-- Projects & Planning -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Projects</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/dashboard/projects') }}">
            <i class="ti ti-clipboard-list"></i>
            <span class="hide-menu">All Projects</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/dashboard/activities') }}">
            <i class="ti ti-clipboard-list"></i>
            <span class="hide-menu">Activities</span>
          </a>
        </li>


        <!-- Events & Community -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Community</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('events.index') }}">
            <i class="ti ti-calendar-event"></i>
            <span class="hide-menu">Events</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/dashboard/financements') }}">
            <i class="ti ti-currency-dollar"></i>
            <span class="hide-menu">Partner & Finance</span>
          </a>
        </li>



        

        <!-- Resources -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Resources</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/dashboard/ressources') }}">
            <i class="ti ti-tools"></i>
            <span class="hide-menu">Materials & Plants</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ url('/dashboard/fournisseurs') }}">
            <i class="ti ti-truck"></i>
            <span class="hide-menu">Supplier</span>
          </a>
        </li>

        <!-- Settings -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">System</span>
        </li>
       
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('users.index') }}">
            <i class="ti ti-user-circle"></i>
            <span class="hide-menu">User Management</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<style>
/* Sidebar general styling */
.sidebar-nav {
  height: auto !important;              /* Adjust height to fit content */
  max-height: fit-content;       /* Prevent it from being taller than the viewport */
  overflow-y: auto !important;           /* Scroll if content exceeds screen height */
  overflow-x: hidden;                    /* Avoid horizontal scroll */
  padding-bottom: 10px;
  background-color: #fff;                /* Optional: keep white background */
  border-right: 1px solid #e5e5e5;       /* Optional: soft separation line */
}

/* If using data-simplebar (like your code does), make sure its container adjusts */
.scroll-sidebar[data-simplebar] {
  height: auto !important;
  max-height: calc(100vh - 80px);
  overflow-y: auto !important;
}

/* Sidebar links spacing */
.sidebar-item {
  margin-bottom: 5px;
}

.sidebar-link {
  padding: 8px 14px;
  font-size: 14px;
  border-radius: 8px;
}

.sidebar-link:hover {
  background-color: #f3f4f6;
  color: #16a34a;
}


</style>