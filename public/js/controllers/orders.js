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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/coffee/orders/common.coffee":
/*!***********************************************!*\
  !*** ./resources/coffee/orders/common.coffee ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var checkPrice, search_warehouses;

checkPrice = function() {
  var delivery_cost, discount, sum;
  sum = 0;
  discount = +$('#discount').val();
  delivery_cost = +$('#delivery_cost').val();
  $('.product').each(function() {
    return sum += +$(this).find('.sum').val();
  });
  $('#sum').val(sum);
  return $('#full_sum').val(sum - discount + delivery_cost);
};

search_warehouses = function(city_id) {
  return $.ajax({
    type: 'post',
    url: '/api/search_warehouses',
    data: {
      city: city_id
    },
    success: function(answer) {
      return $('#warehouse').html(answer).removeAttr('disabled');
    }
  });
};

$(document).on('keyup', '.amount, .price', function() {
  var $product, amount, price;
  $product = $(this).parents('.product');
  amount = $product.find('.amount').val();
  price = $product.find('.price').val();
  $product.find('.sum').val(amount * price);
  return checkPrice();
});

$(document).on('keyup', '#delivery_cost, #discount', checkPrice);

$(document).on('change keyup', '#search_field, #search_category', function() {
  var $this, data;
  $this = $(this);
  data = {
    search: $this.val(),
    type: $this.data('search')
  };
  return $.post('/orders/search_products', data, function(res) {
    return $('.products').html(res);
  });
});

$(document).on('change', '#city_select', function() {
  var $selected, text, value;
  $selected = $(this);
  text = $selected.find('option:selected').text;
  value = $selected.val;
  $('#city_input').val(text);
  search_warehouses(value[0])();
  return $('#city').attr('value', value);
});

$(document).on('focus', '#city_input', function() {
  return $('#city_select').parents('.form-group').css('display', 'block');
});

$(document).on('keyup', '#city_input', function() {
  if ($('#city_input').val().length > 2) {
    return 0;
  }
  return $.ajax({
    type: 'post',
    url: '/api/get_city',
    data: {
      key: '123',
      str: $('#city_input').val()
    },
    success: function(answer) {
      return $('#city_select').html(answer);
    },
    error: function(answer) {
      return errorHandler(answer);
    }
  });
});

$(document).on('click', '#street-reset', function() {
  return $('#street').val('');
});

$(document).ready(function() {
  if ($('#comment').length) {
    CKEDITOR.replace('comment');
  }
  if ($('#client_id').length) {
    $('#client_id').select2({
      tags: "true",
      placeholder: "Виберіть клієнта"
    });
  }
  return $(document).on('change', '#client_id', function(event) {
    var selected;
    selected = $(event.currentTarget).find(':selected');
    $('#fio').val(selected.data('fio'));
    $('#phone').val(selected.data('phone'));
    return $('#email').val(selected.data('email'));
  });
});


/***/ }),

/***/ "./resources/coffee/orders/orders.coffee":
/*!***********************************************!*\
  !*** ./resources/coffee/orders/orders.coffee ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./common.coffee */ "./resources/coffee/orders/common.coffee");

__webpack_require__(/*! ./update.coffee */ "./resources/coffee/orders/update.coffee");

__webpack_require__(/*! ./view.coffee */ "./resources/coffee/orders/view.coffee");


/***/ }),

/***/ "./resources/coffee/orders/update.coffee":
/*!***********************************************!*\
  !*** ./resources/coffee/orders/update.coffee ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var appendFiles;

appendFiles = function(element, data) {
  return $(element).each(function(index, element) {
    return data.append(element.attr(''));
  });
};

$(document).on('submit', '#upload_file', function(event) {
  var data;
  event.preventDefault();
  data = new FormData();
  $(this).find('[name]').each(function(key, value) {
    console.log($(this).attr('type'));
    if ($(this).attr('type') === 'file') {
      data.append($(this).attr('name'), $(this).prop('files')[0]);
      return console.log($(this).prop('files')[0]);
    } else {
      data.append($(this).attr('name'), value);
      return console.log(value);
    }
  });
  //return console.log(data)

  //data.append 'action', 'load_photo'
  //data.append 'id', window.JData.id
  return $.ajax({
    type: 'post',
    url: '/orders/upload_file',
    data: data,
    cache: false,
    dataType: 'json',
    // отключаем обработку передаваемых данных, пусть передаются как есть
    processData: false,
    // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
    contentType: false,
    success: function(answer, status, jqXHR) {
      return new SuccessHandler(answer, jqXHR).setAfter('reload').apply();
    },
    error: function(answer) {
      return new ErrorHandler(answer).apply();
    }
  });
});

$(document).on('change', '#file', function(event) {
  var filename;
  filename = $(this).val().replace(/.*\\/, "");
  return $(".file-name").html(filename);
});

$(document).on('change', '#atype', function() {
  if ($(this).val() === '0') {
    $('#liable').attr('disabled', true);
    $('#liable option:selected').attr('selected', false);
    return $('#liable option[value="0"]').attr('selected', true);
  } else {
    return $('#liable').attr('disabled', false);
  }
});


/***/ }),

/***/ "./resources/coffee/orders/view.coffee":
/*!*********************************************!*\
  !*** ./resources/coffee/orders/view.coffee ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var filterOrders;

filterOrders = function() {
  var data;
  data = {};
  $('.search').each(function() {
    return data[$(this).attr('id')] = $(this).val();
  });
  return new UrlGenerator().appends(data).unsetEmpty().go();
};

$(document).on('change', 'select.search', filterOrders);

$(document).on('click', '#search', filterOrders);

$(document).on('keyup', '.search', function(e) {
  if (e.which === 13) {
    return filterOrders();
  }
});

$(document).on('click', '#export_xml', function() {
  var ids;
  ids = [];
  $('.order_check:checked').each((index, element) => {
    return ids.push($(element).data('id'));
  });
  if (!ids.length) {
    return alert('Ви не позначили жодного замовлення для експотування!');
  }
  return $.ajax({
    type: 'post',
    url: '/orders/export',
    data: {ids},
    success: answer(function() {
      return successHandler(answer);
    })
  });
});

$(document).on('hover', '.print_button', function() {
  var $print, $this;
  $this = $(this);
  $print = $($this.data('id'));
  $(`.buttons:not(.buttons${$this.data('id')})`).hide();
  if (($print.css('display') === 'none')($print.show())) {

  } else {
    return $print.hide();
  }
});

$(document).on('change', '.courier', function() {
  var courier_id, id;
  id = $(this).parents('tr').attr('id');
  courier_id = $(this).find(':selected').val();
  return $.ajax({
    type: 'post',
    url: '/orders/update_courier',
    data: {id, courier_id},
    success: function(answer, status, jqXHR) {
      return new SuccessHandler(answer, jqXHR).apply();
    },
    error: (answer) => {
      return new ErrorHandler(answer).apply();
    }
  });
});

$(document).on('click', '.preview', function() {
  var $parent, $preview_container, id;
  $parent = $(this).parents('tr');
  $preview_container = $parent.find('.preview_container');
  id = $parent.attr('id');
  if ($preview_container.html() !== '') {
    return $preview_container.html('');
  }
  $('.preview_container').each(function(index, element) {
    return $(element).html('');
  });
  return $.ajax({
    type: 'post',
    url: '/orders/preview',
    data: {id},
    success: function(answer) {
      return $preview_container.html(answer);
    },
    error: function(answer) {
      return errorHandler(answer);
    }
  });
});

$(document).on('click', '#route_list', function() {
  var url;
  url = '';
  $('.order-row').each(function(i, e) {
    return url += ':' + $(e).attr('id');
  });
  return window.open(`/orders/route_list?ids=${url}`, '_blank');
});

$(document).on('click', '#more_filters', function() {
  return $('.filter_more').toggleClass('none');
});

$(document).ready(function() {
  Inputmask('999-999-99-99').mask('#phone');
  return Inputmask('999-999-99-99').mask('#phone2');
});


/***/ }),

/***/ 4:
/*!*****************************************************!*\
  !*** multi ./resources/coffee/orders/orders.coffee ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OSPanel\domains\engine\resources\coffee\orders\orders.coffee */"./resources/coffee/orders/orders.coffee");


/***/ })

/******/ });