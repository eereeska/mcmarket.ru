/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/rte.js":
/*!*****************************!*\
  !*** ./resources/js/rte.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {// $('[data-type="rich"]').each(function(i) {
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

/***/ }),

/***/ 1:
/*!***********************************!*\
  !*** multi ./resources/js/rte.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\OpenServer\domains\mcmarket.loc\resources\js\rte.js */"./resources/js/rte.js");


/***/ })

/******/ });