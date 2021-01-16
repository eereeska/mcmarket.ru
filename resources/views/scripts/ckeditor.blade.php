<script>
    ClassicEditor.create(document.querySelector('#{{ $target ?? 'editor' }}'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'underline', 'strike', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
        removePlugins: [ 'Heading', 'Link' ],
    }).catch(error => {console.error(error);});
</script>