<!-- froala WYSIWYG editor -->
        <!--script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
        <script type="text/javascript" src="{{ URL::asset('froala/js/froala_editor.min.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/align.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/code_beautifier.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/code_view.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/entities.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/file.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/font_size.min.js?v=1') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/fullscreen.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/image.min.js') }}"></script>
        <!--script type="text/javascript" src="{{ URL::asset('froala/js/plugins/image_manager.min.js') }}"></script-->
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/inline_style.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/line_breaker.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/link.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/lists.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/paragraph_format.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/paragraph_style.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/quick_insert.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/quote.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/table.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/save.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('froala/js/plugins/url.min.js') }}"></script>


        <script>
            $(function () {
                $('.wysiwygeditor').froalaEditor({
                    height: 400,
                    placeholderText: 'Isi tulisan ...',
                    toolbarButtons: [ 'fullscreen', 'bold', 'italic', 'underline', 'fontSize', 'align', 'formatOL', 'formatUL', 'quote',
                          'insertLink', 'insertImage', 'insertTable', 'clearFormatting', 'html'],
			    imageUploadParam: 'file',
			    imageUploadMethod: 'post',
	            imageUploadURL: '/froala/upload_image',
				imageUploadParams: {
        _token: "{{ csrf_token() }}" // This passes the laravel token with the ajax request.
      }
                })
            });


            //show header on scroll up
            var didScroll;
            var lastScrollTop = 0;
            var delta = 5;
            var navbarHeight = $('#main-menu').outerHeight();

            $(window).scroll(function (event) {
                didScroll = true;
            });

            setInterval(function () {
                if (didScroll) {
                    hasScrolled();
                    didScroll = false;
                }
            }, 250);

            function hasScrolled() {
                var st = $(this).scrollTop();

                // Make sure they scroll more than delta
                if (Math.abs(lastScrollTop - st) <= delta)
                    return;

                // If they scrolled down and are past the navbar, add class .nav-up.
                // This is necessary so you never see what is "behind" the navbar.
                if (st > lastScrollTop && st > navbarHeight) {
                    // Scroll Down
                    $('#main-menu').removeClass('nav-down').addClass('nav-up');
                } else {
                    // Scroll Up
                    if (st + $(window).height() < $(document).height()) {
                        $('#main-menu').removeClass('nav-up').addClass('nav-down');
                    }
                }

                lastScrollTop = st;
            }
        </script>
