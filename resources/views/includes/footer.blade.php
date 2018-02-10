<div class="container">
    <div class="footermn row">
        <div class="col-xs-12 col-sm-12 visible-xs visible-sm round-footer">
            <div class="footer-Dm text-center"></div>
            <div class="footer-Dm text-center"></div>
            <div class="footer-Dm text-center"></div>
            <div class="footer-Mn text-center">
                <a href="{{ url('/page/tentang-qureta') }}">Tentang Qureta</a>
                &nbsp;|&nbsp;
                <a href="{{ url('/page/tips-menulis') }}">Tips Menulis</a>
                &nbsp;|&nbsp;
                <a href="{{ url('/page/faq') }}">FAQ</a>
                &nbsp;|&nbsp;
                <a href="{{ url('/page/kontak') }}">Kontak</a>
            </div>

        </div>

        <div class="row col-lg-10 col-lg-offset-1 hidden-xs hidden-sm">
            <div class="col-lg-15 col-lg-3">
                <div class="foot-header">Media Sosial</div>
                <ul class="foot-links">
                    <li><a href="http://twitter.com/qureta"><i class="fa fa-twitter-square"></i> Twitter</a></li>
                    <li><a href="http://facebook.com/qureta"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                    <li><a href="http://instagram.com/quretacom"><i class="fa fa-instagram"></i> Instagram</a></li>
                    <li><a href="https://www.youtube.com/channel/UCeeoms4PqJ0E331r82NzT9w"><i class="fa fa-youtube"></i> Youtube</a></li>
                </ul>
            </div>
            <div class="col-lg-15 col-lg-3">
                <div class="foot-header">Qureta</div>
                <ul class="foot-links">
                    <li><a href="{{ url('/page/tentang-qureta') }}">Tentang Qureta</a></li>
                    <li><a href="{{ url('/page/lomba-esai') }}">Lomba Esai</a></li>
                    <li><a href="{{ url('/page/buqu') }}">Buqu</a></li>
                    <li><a href="{{ url('/page/kerjasama') }}">Kerjasama</a></li>
                    <li><a href="{{ url('/page/iklan') }}">Iklan</a></li>
                    <li><a href="{{ url('/shop') }}">Shop</a></li>
                </ul>
            </div>
            <div class="col-lg-15 col-lg-3">
                <div class="foot-header">Naskah</div>
                <ul class="foot-links">
                    <li><a href="/page/tips-menulis">Tips Menulis</a></li>
                    <li><a href="/page/penyuntingan">Penyuntingan</a></li>
                    <li><a href="/page/kategori-tulisan">Kategori Tulisan</a></li>
                    <li><a href="/page/foto-gambar">Foto/Gambar</a></li>
                    <li><a href="/page/penolakan">Penolakan</a></li>
                </ul>
            </div>
            <div class="col-lg-15 col-lg-3">
                <div class="foot-header">Keanggotaan</div>
                <ul class="foot-links">
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Daftar</a></li>
                    <li><a href="{{ url('/password/reset') }}">Lupa Password</a></li>
                    <li><a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form></li>
                </ul>
            </div>
            <div class="col-lg-15 col-lg-3">
                <div class="foot-header">Bantuan</div>
                <ul class="foot-links">
                    <li><a href="{{ url('/page/aturan-penggunaan') }}">Aturan Penggunaan</a></li>
                    <li><a href="{{ url('/page/kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                    <li><a href="{{ url('/page/faq') }}">FAQ</a></li>
                    <li><a href="{{ url('/page/kontak') }}">Kontak</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

</footer>
<footer class="footer" id="footerbottom">
    <div class="container">
        <p>&copy; <span id="copy-name"><a href="http://www.qureta.com">Qureta.com</a></span> {{ Carbon::now()->year }}</p>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script data-cfasync="false" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="{{ URL::asset('bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('jquery-cookie/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Datatable App scripts -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    @stack('scripts')
    <script data-cfasync="false" type="text/javascript" src="{{ URL::asset('js/qureta.js') }}"></script>
