/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

// import './modules/smartAttributes';
// import './modules/rte';
// import './modules/files';
// import './modules/select';
// import './modules/hide';
// import './modules/tabs';
// import './modules/files/upload';
window.mcm = {
  imageViewer: function imageViewer() {
    return {
      url: '',
      dragOver: false,
      fileChosen: function fileChosen(event) {
        this.url = event.target.files.length ? URL.createObjectURL(event.target.files[0]) : null;
      },
      drop: function drop(event) {
        this.dragOver = false;

        if (!event.dataTransfer.files.length || !event.dataTransfer.files[0].type.match('image/*')) {
          return;
        }

        this.$refs.cover.files = event.dataTransfer.files;
        this.url = event.dataTransfer.files.length ? URL.createObjectURL(event.dataTransfer.files[0]) : null;
      }
    };
  }
}; // window.mcm = (function() {
// 	function MCM() {
// 	}
// 	var mcm = {
//         click: (selector) => {
//             var el = document.querySelector(selector);
//             if (!el) {
//                 return;
//             }
//             el.click();
//         },
// 		check: (selector) => {
//             var el = document.querySelector(selector);
//             if (!el) {
//                 return;
//             }
//             if (el.getAttribute('type').toLowerCase() === 'radio') {
//                 el.click();
//             } else if (el.getAttribute('type').toLowerCase() === 'checkbox') {
//                 el.checked = true;
//             }
//         }
// 	};
// 	return mcm;
// }());
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

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					result = fn();
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;