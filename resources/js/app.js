import './modules/smartAttributes';
import './modules/rte';
import './modules/files';
import './modules/select';
import './modules/hide';
import './modules/tabs';

// $(document).on('change', 'form[data-action="search"] input, form[data-action="search"] select', function(e) {
//     var $form = $(this).closest('form[data-action="search"]');

//     if (!$form.length) {
//         return;
//     }

//     var $result = $($form.data('result'));

//     if (!$result) {
//         return;
//     }

//     $result.addClass('loading');

//     axios.post($form.attr('action'), $form.serialize()).then(function(response) {
//         if (response.data.success) {
//             $result.html(response.data.html);
//             // window.history.pushState({
//             //     html: response.data.html,
//             //     pageTitle: 'title'
//             // }, "title", $form.attr('action') + '&' + $form.serialize());
//         } else {
//             alert(response.data.message);
//         }
//     }).catch(function() {
//         alert(messages.requestError);
//     }).finally(function() {
//         $result.removeClass('loading');
//     });
// });

// $('[data-action="form-submit"]').on('click', function(e) {
//     e.preventDefault();

//     var $clicked = $(this);

//     $clicked.addClass('loading');

//     var $form = $($(this).data('target'));

//     if (!$form.length) {
//         return;
//     }

//     $form.trigger('submit');
//     return;

//     axios.post($form.attr('action'), $form.serialize()).then(function(response) {
//         if (response.data.success) {
//             if ($form.data('redirect')) {
//                 window.location = response.data.redirect;
//             } else {
//                 setTimeout(function() {
//                     $clicked.removeClass('success');
//                     $clicked.text($clicked.text());
//                 }, 2000);

//                 $clicked.addClass('success');
//             }
//         } else {
//             alert(response.data.message);
//         }

//         $clicked.removeClass('loading');
//     }).catch(function(error) {
//         alert(messages.requestError);
//     });
// });

// $(document).on('click', '[data-action="request"]', function(e) {
//     e.preventDefault();

//     var $clicked = $(this);

//     if (!$clicked.data('url') && !$clicked.is('a')) {
//         return;
//     }

//     if ($clicked.data('confirm')) {
//         if (!confirm($clicked.data('confirm').trim())) {
//             return;
//         }
//     }

//     $clicked.addClass('is-loading');

//     axios({
//         method: $clicked.data('method') || 'get',
//         url: $clicked.is('a') ? $clicked.attr('href') : $clicked.data('url')
//     }).then(function(response) {
//         if (response.data.success) {
//             if (typeof response.data.redirect !== 'undefined') {
//                 window.location.href = response.data.redirect;
//             } else {
//                 setTimeout(function() {
//                     $clicked.removeClass('success');
//                     $clicked.text($clicked.text());
//                 }, 2000);
    
//                 $clicked.addClass('success');
//             }
//         } else {
//             alert(response.data.message || messages.requestError);
//         }
//     }).catch(function() {
//         alert(messages.requestError);
//     }).finally(function() {
//         $clicked.removeClass('is-loading');
//     });
// });

// $(document).on('click', 'nav.pagination .pagination__link', function(e) {
//     e.preventDefault();

//     var $clicked = $(this);

//     if (!$clicked.is('a')) {
//         return;
//     }

//     var $content = $clicked.parent().parent();

//     $content.addClass('loading');
    
//     axios.get($clicked.attr('href')).then(function(response) {
//         $clicked.parent().parent().replaceWith(response.data);
//     }).catch(function(e) {
//         console.log(e)
//     }).finally(function() {
//         $content.removeClass('loading');
//     });
// });

// $(document).on('click', '[data-action="insert-text"]', function(e) {
//     e.preventDefault();

//     $target = $($(this).data('target'));

//     if (!$target) {
//         return;
//     }

//     $target.insertAtCaret($(this).data('value').trim());
// });

// // AJAX PAGE CHANGE

// // $(document).on('click', 'a[data-ajax]', function(e) {
// //     e.preventDefault();

// //     axios.get($(this).attr('href')).then(function(response) {
// //         if (response.data.success) {
// //             $('#root').html(response.data.html);
// //         } else {
// //             alert(response.data.message);
// //         }
// //     });
// // });

// // AJAX PAGE CHANGE END

// // DROPDOWN

// $(document).on('click', '.dropdown > .dropdown__title', function(e) {
//     e.preventDefault();
//     $(this).parent().toggleClass('active');
// });

// $(document).on('mouseup', function(e){
//     var container = $('.dropdown');
 
//     if (!container.is(e.target) && container.has(e.target).length === 0) {
//         container.removeClass('active');
//     }
// });

// // DROPDOWN END