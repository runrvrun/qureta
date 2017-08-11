 <!-- sidebar nav -->
 <nav id="sidebar-nav" class="admin-nav">
        <ul class="nav nav-pills nav-stacked">
            <li class="{{ Request::is('admin/pendingposts') ? 'active' : '' }}"><a href="{{ url('/admin/pendingposts') }}">Naskah Masuk</a></li>
            <li class="{{ Request::is('admin/competitions') ? 'active' : '' }}"><a href="{{ url('/admin/competitions') }}">Lomba</a></li>
            <li class="{{ Request::is('admin/workshop') ? 'active' : '' }}"><a href="{{ url('/admin/workshops') }}">Workshop</a></li>
            @if(Auth::user()->role === 'admin')
            <li class="{{ Request::is('admin/banners') ? 'active' : '' }}"><a href="{{ url('/admin/banners') }}">Banner</a></li>      
            <li class="{{ Request::is('admin/categories') ? 'active' : '' }}"><a href="{{ url('/admin/categories') }}">Topik</a></li>
            <li class="{{ Request::is('admin/featured_categories') ? 'active' : '' }}"><a href="{{ url('/admin/featured_categories') }}">Topik Redaksi</a></li>
            <li class="{{ Request::is('admin/pages') ? 'active' : '' }}"><a href="{{ url('/admin/pages') }}">Halaman</a></li>
            <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a href="{{ url('/admin/users') }}">User Management</a></li>
            <li class="{{ Request::is('admin/statistics') ? 'active' : '' }}"><a href="{{ url('/admin/statistics') }}">Statistik</a></li>
            @endif
        </ul>
    </nav>