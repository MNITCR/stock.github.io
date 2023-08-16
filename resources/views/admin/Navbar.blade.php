<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.links')
</head>

<body class="bg-dark">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Management</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span >Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('usermanage')}}">
                <i class="fa-solid fa-user-group"></i>
                <span>User Manage</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('product')}}">
                <i class="fas fa-shopping-cart"></i>
                <span>Products</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category')}}">
                <i class="fas fa-tags"></i>
                <span>Category</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('purchase')}}">
                <i class="fa-solid fa-basket-shopping"></i>
                <span>Purchase</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('report')}}">
                <i class="fas fa-file-alt"></i>
                <span>Report</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

    {{-- hide and show sibebar --}}
    <script>
        // JavaScript to handle sidebar toggle
        $(document).ready(function() {
            $("#sidebarToggle").click(function() {
                $("body").toggleClass("sidebar-toggled");
                $(".sidebar").toggleClass("toggled");
            });
        });

        // clcik on button menu toggle
        $(document).ready(function() {
            $("#sidebarToggleTop").click(function() {
                $("#accordionSidebar").toggleClass("toggled");
            });

            // Show the sidebar on medium-sized screens
            if (window.matchMedia('(min-width: 768px)').matches) {
                $("#accordionSidebar").removeClass("toggled");
            }
        });
    </script>

    {{-- change calss active --}}
    <script>
        $(document).ready(function() {
            // Get the current page URL
            var currentUrl = window.location.href;

            // Loop through each navigation item
            $(".navbar-nav .nav-item").each(function() {
                var link = $(this).find(".nav-link").attr("href");

                // Check if the link matches the current URL
                if (currentUrl.includes(link)) {
                    $(this).addClass("active"); // Add the active class
                }
            });

            // Apply the active class to the "Dashboard" link by default
            var dashboardLink = $(".navbar-nav .nav-item:first-child");
            dashboardLink.addClass("active");
        });
    </script>


</body>

</html>
