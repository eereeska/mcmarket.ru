$(function() {
    // $('[data-type="rich"]').each(function(i) {
    //     $(this).replaceWith($(`<div class="rich-editor" data-id="' + i + '">
    //         <div class="rich-editor__toolbar">
    //             <div class="bold" data-action="bold"></div>
    //             <div class="italic" data-action="italic"></div>
    //             <div class="strikethrough" data-action="strikethrough"></div>
    //             <div class="underline" data-action="underline"></div>
    //         </div>
    //         <div class="rich-editor__content" contenteditable="true"></div>
    //     </div>`));
    // });

    // $('div.rich-editor').each(function(i) {
    //     $(this).on('mouseup', function() {
    //         var selection = getSelection();

    //         console.log(selection);
    
    //         if (selection !== '' && selection.toString().length > 0) {
                
    //             var range = selection.getRangeAt(0);
    //             var rect = range.getBoundingClientRect();

    //             $(this).after($('<div class="rich-editor__toolbar" data-editor-id="' + $(this).data('id') + '" style="top: ' + rect.top +'px; left: ' + rect.left + 'px;"><div class="bold" data-action="bold"></div></div>'));
    //         } else {
    //             $(this).closest('div.rich-editor__toolbar[data-editor-id="' + $(this).data('id') + '"]').remove();
    //         }
    //     });

    //     $(this).on('click', function() {
    //         var selection = getSelection();

    //         if (selection == '') {
    //             $(this).closest('div.rich-editor__toolbar[data-editor-id="' + $(this).data('id') + '"]').remove();
    //         }
    //     })
    // });

    // document.onmouseup = function() {
    //     var selection = false;

    //     if (window.getSelection) {
    //         selection = window.getSelection();
    //     } else if (document.getSelection) {
    //         selection = document.getSelection();
    //     }

    //     if (selection && !selection.isCollapsed) {
    //         let range = selection.getRangeAt(0);
    //         let rect = range.getBoundingClientRect();

    //         let $editor = $(range.startContainer.parentElement);
    //         let $toolBar = $editor.next('div.rich-editor__toolbar');

    //         if (!$editor.hasClass('rich-editor')) {
    //             return;
    //         }

    //         // if ($toolBar.length == 0 && typeof $target.data('selectionTooltip') !== "undefined") {
    //         //     $toolBar = $($(document).find('.selectionTooltip').get().filter((v) => {
    //         //         let _self = $(v).data('self')
    //         //         if (_self.uniqueId == $target.data('selectionTooltip')) {
    //         //             return v
    //         //         }
    //         //     })[0])
    //         // }

    //         console.log($toolBar.length)

    //         if ($toolBar.length > 0) {
    //             return;
    //         }

    //         $editor.after($('<div class="rich-editor__toolbar" data-editor-id="' + $(this).data('id') + '" style="top: ' + (rect.top - 70) +'px; left: ' + (rect.left - 90) + 'px;"><div class="bold" data-action="bold"></div><div class="italic" data-action="italic"></div><div class="strikethrough" data-action="strikethrough"></div><div class="underline" data-action="underline"></div></div>'));

    //         console.log('create')
    //     } else {
    //         $(document).find('div.rich-editor__toolbar').remove();
    //         console.log('delete')
    //     }
    // }
});

function getSelection() {
    if (window.getSelection) {
        return window.getSelection();
    } else if (document.selection) {
        return document.selection.createRange().text;
    }

    return '';
}