var allowedCommands = [
    'bold',
    'italic',
    'strikethrough',
    'underline',
    'insertOrderedList',
    'insertUnorderedList',
    'justifyLeft',
    'justifyCenter',
    'justifyRight',
    'removeFormat',
];

$(document).on('focusout cut', '.editor__content[contenteditable]', function() {
    if (!$(this).text().trim().length) {
        $(this).empty();
    }
});

$(document).on('paste', '.editor__content[contenteditable]', function(e) {
    e.preventDefault();
    document.execCommand('inserttext', false, e.originalEvent.clipboardData.getData('text/plain'));
});

$(document).on('click', '.editor__toolbar > button', function(e) {
    e.preventDefault();

    var command = $(this).data('command');

    if (!allowedCommands.includes(command)) {
        return;
    }

    document.execCommand(command);
});

// $('.editor__content').on('click', function() {  
//     if ($(this).is(':empty')) {
//         $(this).html($('p').trigger('focus'));
//     }
// })

// $('.editor > .editor__content').on('click', setTimeout(format, 50));

// $('.editor > .editor__content').on('mouseup keydown keyup', function(e) {
//     if (e.ctrlKey || e.metaKey) {
//         return;
//     }

//     setTimeout(format, 50);
// });

// function format(e) {
//     console.clear();
//     console.log('format...');
//     var currentNode = getCurrentNode();

//     console.log('currentNode', currentNode)

//     // $('.editor > .editor__toolbar > button[data-action]')

//     $('.editor > .editor__toolbar > button').each(function (i, el) {
//         var action = $(this).data('action');
//         var tagName = currentNode.tagName.toLowerCase();

//         // $(this).removeClass('active');

//         // if (action === 'bold' && (tagName === 'strong' || tagName === 'b')) {
//         //     $(this).addClass('active');
//         // } else if (action === 'italic' && tagName === 'i') {
//         //     $(this).addClass('active');
//         // } else if (action === 'strikethrough' && tagName === 's') {
//         //     $(this).addClass('active');
//         // } else if (action === 'underline' && tagName === 'u') {
//         //     $(this).addClass('active');
//         // }

//         console.log(document.queryCommandState(getSelectedNode()))
//         if (document.queryCommandState(currentNode)) {
//             $(this).addClass('active')
//         } else {
//             $(this).removeClass('active');
//         }
//     });
// }

// function observeFormattingl(e) {
//     if (this.skipFormatObserveOnce)
//         return void (this.skipFormatObserveOnce = !1);
//     var t = this.getCurrentNode()
//       , o = r(t)
//       , a = this.$editor.get(0);
//     if (this.inactiveAllButtons(),
//     r.each(this.opts.activeButtonsStates, r.proxy(function(e, t) {
//         0 != o.closest(e, a).length && this.setBtnActive(t)
//     }, this)),
//     e && (13 == e || 8 == e)) {
//         var d = this;
//         r.each(this.opts.activeButtonStateMap, function(e, t) {
//             try {
//                 d.document.queryCommandState(t) ? d.setBtnActive(e) : d.setBtnInactive(e)
//             } catch (t) {}
//         })
//     }
//     var n = o.closest(["p", "div", "h1", "h2", "h3", "h4", "h5", "h6", "blockquote", "td"]);
//     if ("undefined" != typeof n[0] && "undefined" != typeof n[0].elem && 0 != r(n[0].elem).size()) {
//         var l = r(n[0].elem).css("text-align");
//         "right" === l ? this.setBtnActive("alignright") : "center" === l ? this.setBtnActive("aligncenter") : "justify" === l ? this.setBtnActive("justify") : this.setBtnActive("alignleft")
//     }
// },

// function getCurrentNode() {
//     if (typeof window.getSelection != 'undefined') {
//         var selectedNode = getSelectedNode();
//         return !!selectedNode && selectedNode.parentNode;
//     }

//     return typeof document.selection == 'undefined' ? void 0 : getSelection().parentElement();
// }

// function getSelectedNode() {
//     if (typeof window.getSelection != 'undefined') {
//         var selection = window.getSelection();
//         return !!(selection && 0 < selection.rangeCount) && selection.getRangeAt(0).commonAncestorContainer;
//     }

//     return typeof document.selection == 'undefined' ? void 0 : getSelection();
// };

// function getSelection() {
//     return this.window.getSelection ? this.window.getSelection() : document.getSelection ? document.getSelection() : document.selection.createRange();
// }