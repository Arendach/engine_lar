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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/coffee/product/create.coffee":
/*!************************************************!*\
  !*** ./resources/coffee/product/create.coffee ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).on('change', '[name=category]', function() {
  var $this;
  $this = $(this);
  return $.ajax({
    type: 'post',
    url: '/product',
    data: {
      id: $this.val(),
      action: 'get_service_code'
    },
    success: function(answer) {
      var response;
      response = JSON.parse(answer);
      $('[name=services_code]').val(response.message);
      $('#fake-service-code').html(response.message);
      return $('.service_code_container').show();
    },
    error: function(answer) {
      return errorHandler(answer);
    }
  });
});


/***/ }),

/***/ "./resources/coffee/product/product.coffee":
/*!*************************************************!*\
  !*** ./resources/coffee/product/product.coffee ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var add_margin, change_sum, filter_products;

__webpack_require__(/*! ./create.coffee */ "./resources/coffee/product/create.coffee");

__webpack_require__(/*! ./update.coffee */ "./resources/coffee/product/update.coffee");

add_margin = function() {
  if ($('.search_combine_result').length > 0) {
    return $('.search_combine_result').css('margin-bottom', '15px');
  } else {
    return $('.search_combine_result').css('margin-bottom', '0px');
  }
};

change_sum = function() {
  var sum;
  sum = 0;
  $('.combine_products_item').each(function() {
    var amount, costs;
    amount = $(this).find('.amount').val();
    costs = $(this).find('.price').val();
    return sum += +costs * +amount;
  });
  $('[name="costs"]').val(sum);
  return add_margin();
};

$(document).on('input', '.combine_products_item input', change_sum);

$(document).on('click', '.delete_combine_product', function() {
  $(this).parents('.combine_products_item').remove();
  return change_sum();
});

$(document).on('click', '#close_search_combine_result', function() {
  $('.search_combine_result').html('');
  return $('#search_products_to_combine').val('');
});

$(document).on('change', '[name="combine"]', function() {
  if ($(this).val()($('.combine_wrapper').show())) {

  } else {
    return $('.combine_wrapper').hide();
  }
});

$(document).on('keyup', '#search_products_to_combine', function() {
  var notIn, value;
  value = $(this).val();
  notIn = [];
  $('.combine_products_item').each(function() {
    return notIn.push($(this).data('id'));
  });
  return $.ajax({
    type: 'post',
    url: '/product',
    data: {
      value: value,
      action: 'search_products_to_combine',
      not: notIn
    },
    success: function(answer) {
      return $('.search_combine_result').html(answer);
    }
  });
});

$(document).on('click', '.get_product_to_combine', function(event) {
  var id;
  event.preventDefault();
  id = $this.data('id');
  return $.ajax({
    type: 'post',
    url: '/product',
    data: {
      id: id,
      action: 'get_product_to_combine'
    },
    success: (answer) => {
      $('.combine_products_list').prepend(answer);
      $(this).remove();
      return change_sum();
    }
  });
});

filter_products = function() {
  var data;
  data = {};
  $('[data-action=search]').each(function() {
    return data[$(this).data('column')] = $(this).val();
  });
  return GET.setObject(data).unset('page').unsetEmpty().go();
};

$(document).on('click', '#search', filter_products);

$(document).on('keyup', '[data-action=search]', function(event) {
  if (event.which === 13) {
    return filter_products();
  }
});

$(document).on('change', 'select[data-action=search]', filter_products);

$(document).on('click', '.sort', function(event) {
  event.preventDefault();
  return GET.set('order_field', $(this).data('field')).set('order_by', $(this).data('by')).go();
});

$(document).on('click', '.copy', function(event) {
  var amount;
  event.preventDefault();
  amount = prompt('Ведіть кількість копій!', '1');
  return $.ajax({
    type: 'post',
    url: '/product',
    data: {
      id: id,
      amount: amount,
      action: 'copy'
    },
    success: function(answer) {
      return successHandler(answer, function() {
        return window.location.href = '/product';
      });
    },
    error: function(answer) {
      return errorHandler(answer);
    }
  });
});

$(document).on('keyup', '#search_attribute', function() {
  var $this;
  $this = $(this);
  if ($this.val().length === 0 || $this.val() === '') {
    return $('.attribute_search_result').html('');
  }
  return $.ajax({
    type: 'post',
    url: '/product',
    data: {
      value: $this.val(),
      action: 'search_attribute'
    },
    success: function(answer) {
      return $('.attribute_search_result').html(answer);
    }
  });
});

$(document).on('click', '.get_searched_attribute', function(event) {
  var $this;
  event.preventDefault();
  $this = $(this);
  return $.ajax({
    type: 'post',
    url: '/product',
    data: {
      id: $this.data('id'),
      action: 'get_searched_attribute'
    },
    success: function(answer) {
      $('#attribute_list').prepend(answer);
      return $this.remove();
    },
    error: function(answer) {
      return errorHandler(answer);
    }
  });
});

$(document).on('click', '.delete_attribute_variant', function() {
  if ($(this).parents('.row').parent().find('.row').length > 2) {
    return $(this).parents('.row').remove();
  }
});

$(document).on('click', '.add_attribute_value', function(event) {
  var $clone, $input;
  event.preventDefault();
  $input = $(this).parents('.panel-body').find('.row').last();
  $clone = $input.clone(true, true);
  return $input.after($clone);
});

$(document).on('click', '.close_attribute_search_result', function() {
  $('.attribute_search_result').html('');
  return $('#search_attribute').val('');
});

$(document).on('click', '.delete_attribute', function() {
  return $(this).parents('.attribute_item').remove();
});

$(document).on('keyup', '[name="volume[]"]', function() {
  var sum;
  sum = 1;
  $('[name="volume[]"]').each(function() {
    return sum *= +$(this).val();
  });
  return $('#volume').val(sum / 1000000);
});

$(document).on('click', '.print_products', function() {
  var url;
  url = {};
  $('[data-action=search]').each(function() {
    return url[$(this).data('column')] = $(this).val();
  });
  url.section = 'print';
  GET.setObject(url).unsetEmpty().setDomain('/product').redirect();
  return $(this).blur();
});

$(document).on('click', '.pts_more', function() {
  var id;
  id = $(this).data('id');
  return $.ajax({
    type: 'post',
    url: 'product',
    data: {
      action: 'pts_more',
      id: id
    },
    success: function(answer) {
      return $('.pts_more_' + id).html(answer).show();
    }
  });
});

$(document).on('click', ':not(.pts_more_item)', function() {
  return $('.pts_more_item').hide();
});

$(document).on('click', '.more', function() {
  return $('.filters').toggleClass('none');
});

$(document).on('click', '.filters_ok', function() {
  return GET.set('items', $('[name=items]').val()).go();
});

$(document).on('click', '.print_tick', function() {
  var selected;
  selected = Elements.getCheckedValues('table', '.product_item');
  return GET.setObject({
    section: 'print_tick',
    ids: selected.toString()
  }).redirect();
});

$(document).on('click', '.print_stickers', function() {
  var selected;
  selected = Elements.getCheckedValues('table', '.product_item');
  return GET.setObject({
    section: 'print_stickers',
    ids: selected.toString()
  }).redirect();
});

$(document).ready(function() {
  if ($('[name="descripton"]').length) {
    CKEDITOR.replace('description');
  }
  if ($('[name="descripton_ru"]').length) {
    return CKEDITOR.replace('description_ru');
  }
});

$(document).on('change', '[name=level1]', function() {
  var k, result;
  k = $(this).val();
  result = '';
  ids[k].forEach(function(i) {
    return result += `<option value='${i}'>${i}</option>`;
  });
  return $('[name=level2]').html(result);
});


/***/ }),

/***/ "./resources/coffee/product/update.coffee":
/*!************************************************!*\
  !*** ./resources/coffee/product/update.coffee ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).on('click', '.delete_image', function() {
  var src;
  src = $(this).attr('data-src');
  return swal({
    title: "Дійсно видалити?",
    text: "Відмінити дію буде неможливо!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Видалити!",
    closeOnConfirm: false,
    html: false
  }, function() {
    return $.ajax({
      type: 'post',
      url: '/delete_temp_file',
      data: {
        path: src
      },
      success: function(answer) {
        return successHandler(answer);
      },
      error: function(answer) {
        return errorHandler(answer);
      }
    });
  });
});

$(document).on('click', '#update-attribute', function(event) {
  var attribute;
  event.preventDefault();
  attribute = {};
  $('input.attribute').each(function() {
    var name;
    name = $(this).attr('data-name');
    if (Array.isArray(attribute[name])) {
      return attribute[name].push($(this).val());
    } else {
      attribute[name] = [];
      return attribute[name].push($(this).val());
    }
  });
  return $.ajax({
    type: 'post',
    url: url('/products/update'),
    data: {
      id: id,
      method: 'attribute',
      data: attribute
    },
    success: function(answer) {
      return successHandler(answer);
    },
    error: function(answer) {
      return errorHandler(answer);
    }
  });
});

$(document).on('keyup', '#search_characteristic', function() {
  var notIn, value;
  value = $(this).val();
  if (value === '') {
    return $('.characteristic_search_result').html('');
  }
  notIn = [];
  $('.characteristic').each(function() {
    return notIn.push($(this).data('id'));
  });
  return $.ajax({
    type: 'post',
    url: url('product'),
    data: {
      action: 'search_characteristics',
      name: value,
      not: notIn
    },
    success: function(answer) {
      return $('.characteristic_search_result').html(answer);
    }
  });
});

$(document).on('click', '.get_searched_characteristic', function() {
  return $.ajax({
    type: 'post',
    url: '/product',
    data: {
      action: 'get_searched_characteristic',
      id: $(this).data('id')
    },
    success: (answer) => {
      $('.characteristics').prepend(answer);
      return $(this).remove();
    },
    error: function(answer) {
      return errorHandler(answer);
    }
  });
});

$(document).on('click', '.delete_characteristic', function() {
  return $(this).parents('.characteristic').fadeOut().remove();
});

$(document).on('click', '.close_characteristic_search_result', function() {
  $('#search_characteristic').val('');
  return $('.characteristic_search_result').html('');
});


/***/ }),

/***/ 3:
/*!*******************************************************!*\
  !*** multi ./resources/coffee/product/product.coffee ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OSPanel\domains\engine\resources\coffee\product\product.coffee */"./resources/coffee/product/product.coffee");


/***/ })

/******/ });