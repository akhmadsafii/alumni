<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
    m-menu-scrollable="0" m-menu-dropdown-timeout="500">
    <ul class="m-menu__nav ">
        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('admin.dashboard') }}" class="m-menu__link "><span
                    class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-line-graph"></i><span
                    class="m-menu__link-text">Dashboard</span></a></li>
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ route('admin.discussion.page') }}" class="m-menu__link "><span class="m-menu__item-here"></span><i
                    class="m-menu__link-icon flaticon-chat-1"></i><span class="m-menu__link-text">Diskusi</span></a>
        </li>
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ route('admin.survey.page') }}" class="m-menu__link "><span class="m-menu__item-here"></span><i
                    class="m-menu__link-icon flaticon-computer"></i><span class="m-menu__link-text">Survey</span></a>
        </li>
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ route('admin.agenda.page') }}" class="m-menu__link "><span class="m-menu__item-here"></span><i
                    class="m-menu__link-icon flaticon-calendar-1"></i><span class="m-menu__link-text">Agenda</span></a>
        </li>
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ route('admin.blog.page') }}" class="m-menu__link "><span class="m-menu__item-here"></span><i
                    class="m-menu__link-icon flaticon-notes"></i><span class="m-menu__link-text">Blog</span></a>
        </li>
        <li class="m-menu__item " aria-haspopup="true">
            <a href="{{ route('admin.gallery.page') }}" class="m-menu__link "><span class="m-menu__item-here"></span><i
                    class="m-menu__link-icon flaticon-responsive"></i><span class="m-menu__link-text">Galeri</span></a>
        </li>
        <li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true"
            m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span
                    class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-layers"></i><span
                    class="m-menu__link-text">Master</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span
                                class="m-menu__item-here"></span><span class="m-menu__link-text">Resources</span></span>
                    </li>
                    <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="{{ route('admin.cluster.type', 'job') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">Jenis Pekerjaan</span></a></li>
                    <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                            href="{{ route('admin.cluster.type', 'blog') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">Kategori Blog</span></a></li>
                    <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                            href="{{ route('admin.cluster.type', 'gallery') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">Kategori Galeri</span></a></li>
                    <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                            href="{{ route('admin.manage.page') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">Tracking Pekerjaan</span></a></li>
                </ul>
            </div>
        </li>
        <li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true"
            m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span
                    class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-layers"></i><span
                    class="m-menu__link-text">User</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span
                                class="m-menu__item-here"></span><span class="m-menu__link-text">Resources</span></span>
                    </li>
                    <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="inner.html"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">Siswa</span></a></li>
                    <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                            href="{{ route('admin.manage.page') }}" class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">Admin</span></a></li>
                </ul>
            </div>
        </li>
        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('admin.setting.page') }}"
                class="m-menu__link "><span class="m-menu__item-here"></span><i
                    class="m-menu__link-icon flaticon-settings-1"></i><span class="m-menu__link-text">Setting
                </span></a></li>
    </ul>
</div>
