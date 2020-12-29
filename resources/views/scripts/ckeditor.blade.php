<script>
    ClassicEditor.create(document.querySelector('#{{ $target ?? 'rich-editor' }}')).catch(error => {console.error(error);});
</script>