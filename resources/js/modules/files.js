import mcm from "../mcm";

// $(document).on('dragenter focus click', '.file > .file__original', function() {
//     $(this).parent().addClass('is-dragenter');
// });

// $(document).on('dragleave blur drop', '.file > .file__original', function(e) {
//     $(this).parent().removeClass('is-dragenter');

//     if ($(this).hasClass('is-uploading')) {
//         e.preventDefault();
//         e.stopImmediatePropagation();
//     }
// });

mcm.qsa('.file > .file__original').forEach(function(input) {
    // mcm.on('dragenter', input, function() {

    // });

    mcm.on('change', input, function(e) {
        var $label = this.parentNode.querySelector('span.file__label');

        if (!$label.hasAttribute('data-original')) {
            $label.setAttribute('data-original', $label.textContent.trim());
        }

        var files = this.files;

        if (this.hasAttribute('multiple') && files.length > 0) {
            $label.textContent = 'Выбрано ' + files.length + ' файл(-а, -ов)';
        } else if (files.length > 0) {
            $label.textContent = files[0].name;
        } else {
            $label.textContent = $label.getAttribute('data-original');
            $label.removeAttribute('data-original');
            return;
        }

        // if ($input.data('auto-upload')) {
        //     e.preventDefault();
    
        //     var data = new FormData();
    
        //     for (file of files) {
        //         data.append($input.attr('name'), file);
        //     }
    
        //     $container.addClass('is-uploading');
            
        //     axios.post($input.data('auto-upload'), data).then(function(response) {
        //         if (response.data.success) {
        //             if (response.data.preview.length) {
        //                 $preview = $container.prev('.media');
    
        //                 if ($preview.length) {
        //                     $preview.replaceWith(response.data.preview);
        //                 } else {
        //                     $container.before(response.data.preview);
        //                 }
        //             }
        //         } else {
        //             alert(response.data.message || messages.requestError);
        //         }
        //     }).catch(function(error) {
        //         console.log(error)
        //     }).finally(function() {
        //         $container.removeClass('is-uploading');
        //         $input.val('');
        //         $label.text($label.data('original-label'));
        //     });
        // }
    });
});