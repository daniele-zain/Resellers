<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="overflow: scroll">
    <div class="app-brand demo">
        <a href="/index" class="app-brand-link">
            <span class="ml-3 mr-0">
                <span class="app-brand-text menu-text fw-bold d-flex text-primary justify-between"
                    style="font-size: 18px; color: #7c72f1">Re-Sellers</span>
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1" >

        <li class="menu-item open {{ $title == 'index' ? 'active' : '' }}">
            <a href="{{ route('index') }}" class="menu-link">
                <i class="fa-solid fa-house px-2"></i>
                <div data-i18n="Home">Home</div>
            </a>
        </li>
        <li class="menu-item open {{ $title == 'orders' ? 'active' : '' }}">
            <a href="{{ route('orders') }}" class="menu-link">
                <i class="fa-solid fa-book px-2"></i>
                <div data-i18n="Orders">Orders</div>
            </a>
        </li>

        <li class="menu-item open {{ $title == 'all_users' ? 'active' : '' }}">
            <a href="{{ route('all_users') }}" class="menu-link">
                <i class="fa-solid fa-user px-2"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
        <li class="menu-item open {{ $title == 'app-user-list' ? 'active' : '' }}">
            <a href="{{ route('app-user-list') }}" class="menu-link">
                <i class="fa-solid fa-list px-2"></i>
                <div data-i18n="App User List">App User List</div>
            </a>
        </li>
        <li class="menu-item open {{ $title == 'products' ? 'active' : '' }}">
            <a href="{{ route('products') }}" class="menu-link">
                <i class="fa-solid fa-list px-2"></i>
                <div data-i18n="Products">Products</div>
            </a>
        </li>
    </ul>

    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-setting px-2"></i>
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li class="text-center">
                <form action="{{ route('logout') }}" method="post" id="logOutForm">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</aside>
