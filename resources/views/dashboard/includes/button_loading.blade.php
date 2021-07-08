<script>
    function buttonLoading() {
        $('form').on('submit', function() {
            let button = $(this).find('button[type="submit"]');

            if(!button) return;

            button.attr('disabled', true)
                .html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Carregando...')
        });
    }

    buttonLoading();
</script>