 <!-- sidebar nav -->
 <nav id="sidebar-nav" class="admin-nav">
        <ul class="nav nav-pills nav-stacked">
          @if(Auth::user()->role === 'editor')
            <li class="{{ Request::is('admin/pendingposts') ? 'active' : '' }}"><a href="{{ url('/admin/pendingposts') }}">Naskah Masuk</a></li>
            <li class="{{ Request::is('admin/publishposts') ? 'active' : '' }}"><a href="{{ url('/admin/publishposts') }}">Naskah Terbit</a></li>
            <li class="{{ Request::is('admin/competitions') ? 'active' : '' }}"><a href="{{ url('/admin/competitions') }}">Lomba</a></li>
            <li class="{{ Request::is('admin/workshop') ? 'active' : '' }}"><a href="{{ url('/admin/workshops') }}">Workshop</a></li>
            <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a href="{{ url('/admin/users') }}">User Management</a></li>
            @endif
            @if(Auth::user()->role === 'admin')
            <li class="{{ Request::is('admin/pendingposts') ? 'active' : '' }}"><a href="{{ url('/admin/pendingposts') }}">Naskah Masuk</a></li>
            <li class="{{ Request::is('admin/publishposts') ? 'active' : '' }}"><a href="{{ url('/admin/publishposts') }}">Naskah Terbit</a></li>
            <li class="{{ Request::is('admin/hiddenposts') ? 'active' : '' }}"><a href="{{ url('/admin/hiddenposts') }}">Naskah Disembunyikan</a></li>
            <li class="{{ Request::is('admin/lockedposts') ? 'active' : '' }}"><a href="{{ url('/admin/lockedposts') }}">Naskah Dikunci</a></li>
            <li class="{{ Request::is('admin/buqus') ? 'active' : '' }}"><a href="{{ url('/admin/buqus') }}">Buqu</a></li>
            <li class="{{ Request::is('admin/competitions') ? 'active' : '' }}"><a href="{{ url('/admin/competitions') }}">Lomba</a></li>
            <li class="{{ Request::is('admin/workshop') ? 'active' : '' }}"><a href="{{ url('/admin/workshops') }}">Workshop</a></li>
            <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a href="{{ url('/admin/users') }}">User Management</a></li>
            <li class="{{ Request::is('admin/pages') ? 'active' : '' }}"><a href="{{ url('/admin/pages') }}">Halaman</a></li>
            <li class="{{ Request::is('admin/banners') ? 'active' : '' }}"><a href="{{ url('/admin/banners') }}">Banner</a></li>
            <li class="{{ Request::is('admin/categories') ? 'active' : '' }}"><a href="{{ url('/admin/categories') }}">Topik</a></li>
            <li class="{{ Request::is('admin/featured_categories') ? 'active' : '' }}"><a href="{{ url('/admin/featured_categories') }}">Topik Redaksi</a></li>
            <li class="{{ Request::is('admin/statistics') ? 'active' : '' }}"><a href="{{ url('/admin/statistics') }}">Statistik</a></li>
            <li class="{{ Request::is('admin/newsflash') ? 'active' : '' }}"><a href="{{ url('/admin/newsflash') }}">Newsflash</a></li>
            <li class="{{ Request::is('admin/shops') ? 'active' : '' }}"><a href="{{ url('/admin/shops') }}">Shop</a></li>
            @endif
            @if(Auth::user()->role === 'partner')
             <li class="{{ Request::is('admin/competitions') ? 'active' : '' }}"><a href="{{ url('/admin/competitions') }}">Lomba</a></li>
             <li class="{{ Request::is('admin/workshop') ? 'active' : '' }}"><a href="{{ url('/admin/workshops') }}">Workshop</a></li>
             @endif
        </ul>
    </nav>
