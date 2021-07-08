<script>
    function deleteForm() {
        let deleteForm = document.getElementById('deleteForm');

        deleteForm.addEventListener('submit', function(event) {
            event.preventDefault();

            if(confirm('Você confirma apagar esse conteúdo? OBS: Essa ação é irreversível')) {
                return deleteForm.submit();
            }

            return false;
        });
    }

    deleteForm();
</script>