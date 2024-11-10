<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="#" class="app-brand-link">
        <img src="{{asset('assets/myimg/logo.png')}}" class="app-brand-logo w-px-30 h-auto me-2 " alt="logo" />
            <span class="app-brand-text menu-text fw-bold">BUGS
              <br />
              <span class="fs-tiny fw-medium">Honorarium Monitoring System</span>
            </span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <li class="menu-item">
            <div style="margin-left: 5%; margin-top: 5%; color: #b4b0c4;">Thesis Transaction</div>
        </li>
        <li class="menu-item {{ request()->is('') ? 'active' : '' }}">
            <a href="" class="menu-link">
                <i class='menu-icon tf-icons bx bx-archive-in'></i>
              <div class="text-truncate" data-i18n="Page 2">Lorem Ipsum</div>
            </a>
        </li>

      </ul>
  </aside>
