<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void(0);" class="app-brand-link d-flex align-items-center justify-content-center p-0">
            <span class="app-brand-logo demo w-100 text-center">
                <img src="{{ asset('admin/assets/img/avatars/logopetcare2.png') }}" alt="Logo Petshop"
                    style="width: 100%; height: 50px; object-fit: contain;" />
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>


    <div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a href="/dashboard" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('produk') ? 'active' : '' }}">
        <a href="/produk" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div data-i18n="Basic">Product</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('kategori') ? 'active' : '' }}">
        <a href="/kategori" class="menu-link">
            <i class="menu-icon tf-icons bx bx-category"></i>
            <div data-i18n="Basic">Kategori</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('stock-produk') ? 'active' : '' }}">
        <a href="/stock-produk" class="menu-link">
            <i class="menu-icon tf-icons bx bx-box"></i>
            <div data-i18n="Basic">Stock Produk</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('data-pesanan') ? 'active' : '' }}">
    <a href="/data-pesanan" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cart-alt"></i>
        <div data-i18n="Basic">Data Pesanan</div>
    </a>
</li>


    <li class="menu-item {{ Request::is('data-pethotel') ? 'active' : '' }}">
        <a href="/data-pethotel" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-heart"></i>
            <div data-i18n="Basic">Data Pet Hotel</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('data-grooming') ? 'active' : '' }}">
        <a href="/data-grooming" class="menu-link">
            <i class="menu-icon tf-icons bi bi-scissors"></i>
            <div data-i18n="Basic">Data Grooming</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('data-klinik') ? 'active' : '' }}">
        <a href="/data-klinik" class="menu-link">
            <i class="menu-icon tf-icons bx bx-first-aid"></i>
            <div data-i18n="Basic">Data Pet Klinik</div>
        </a>
    </li>

    <li class="menu-item {{ Request::is('setting-user') ? 'active' : '' }}">
        <a href="/setting-user" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Basic">User</div>
        </a>
    </li>
</ul>

</aside>
