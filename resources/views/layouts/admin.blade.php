<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Leaf Village</title>
  <link rel="shortcut icon"  href="{{ asset('images/images.png') }}" />
  <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

  <!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Simplebar -->
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
@vite(['resources/js/app.js', 'resources/css/app.css'])
<style>
.brand-logo {
  padding: 1rem 1.5rem;
  background: linear-gradient(135deg, #2e7d32 0%, #4caf50 100%);
  color: white;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  border-radius: 0 0 12px 12px;
  position: relative;
  overflow: hidden;
}

.brand-logo::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, #81c784, #a5d6a7, #81c784);
  background-size: 200% 100%;
  animation: shimmer 3s infinite linear;
}

@keyframes shimmer {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}

.logo-container {
  gap: 12px;
  transition: transform 0.3s ease;
}

.logo-container:hover {
  transform: translateX(5px);
}

.login-icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.login-icon:hover {
  background: rgba(255, 255, 255, 0.3);
  transform: scale(1.1) rotate(15deg);
}

.login-icon i {
  font-size: 1.2rem;
  color: #e8f5e9;
}

.brand-name {
  margin: 0;
  font-weight: 700;
  font-size: 1.5rem;
  letter-spacing: 0.5px;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
  background: linear-gradient(to right, #e8f5e9, #c8e6c9);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transition: all 0.3s ease;
}

.close-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.15);
  transition: all 0.3s ease;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.close-btn:hover {
  background: rgba(255, 255, 255, 0.25);
  transform: scale(1.1);
}

.close-btn i {
  font-size: 1.1rem;
  color: #e8f5e9;
}

/* Responsive adjustments */
@media (max-width: 1199.98px) {
  .brand-logo {
    border-radius: 0;
  }
  
  .brand-name {
    font-size: 1.3rem;
  }
}

@media (max-width: 575.98px) {
  .brand-logo {
    padding: 0.8rem 1rem;
  }
  
  .brand-name {
    font-size: 1.1rem;
  }
  
  .login-icon {
    width: 34px;
    height: 34px;
  }
  
  .login-icon i {
    font-size: 1rem;
  }
  
  .close-btn {
    width: 32px;
    height: 32px;
  }
  
  .close-btn i {
    font-size: 0.9rem;
  }
}
</style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" 
       data-layout="vertical" 
       data-navbarbg="skin6" 
       data-sidebartype="full"
       data-sidebar-position="fixed" 
       data-header-position="fixed">
       
    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main wrapper -->
    <div class="body-wrapper">
      <!-- Navbar -->
      @include('partials.adminNavbar')

      <!-- Content -->
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>