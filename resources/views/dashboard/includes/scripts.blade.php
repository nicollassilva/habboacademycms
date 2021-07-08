<script src="https://cdn.tiny.cloud/1/et5b6yxzcgtyjs7byjph9vhgl0uemwyli2mu3rm0atqjb0tl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#tiny',
            height: 400,
            branding: false,
            relative_urls: true,
            valid_children: "+body[style]",
            extended_valid_elements: "script[language|type|src]",
            document_base_url: '///dashboard/',
            plugins: [
                'table advlist autolink lists link image charmap preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table',
            toolbar2: 'preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
                {
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>