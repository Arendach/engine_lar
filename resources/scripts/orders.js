const ErrorHandler = require('../coffee/handlers/ErrorHandler.coffee')
const DeleteOnClick = require('../coffee/handlers/DeleteOnClick.coffee')
const SuccessHandler = require('../coffee/handlers/SuccessHandler.coffee')

FormData.prototype.toObject = function () {
    let temp = {}
    this.forEach(function (value, key) {
        temp[key] = value
    })
    return temp
}

window.checkPrice = function () {
    let sum = 0
    let discount = +$('#discount').val()
    let delivery_cost = +$('#delivery_cost').val()

    $('.product').each(function () {
        sum += +$(this).find('.sum').val()
    })

    $('#sum').val(sum)
    $('#full_sum').val(sum - discount + delivery_cost)
}

$(document).on('keyup', '#delivery_cost, #discount', checkPrice)


$(document).on('submit', 'form#createOrder', function (event) {
    event.preventDefault()

    let data = new FormData(this)

    if (!$('tr.product').length) {
        return toastr.error('Виберіть хоча б один товар')
    }

    let storageValid = true
    $(this).find('.storageId').each(function () {
        if (!$(this).val()) {
            storageValid = false
        }
    })

    if (!storageValid) {
        return toastr.error('Виберіть склад для всіх товарів')
    }

    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        data: data,
        processData: false,
        contentType: false,
        success(response) {
            if (response.url.length) {
                window.location.href = response.url
            }
        },
        error(response) {
            (new ErrorHandler(response))
                .setFormElement(event.currentTarget)
                .setDriver('toastr')
                .apply()
        }
    })
})

$(document).ready(function () {
    $('#new_post_city').select2({
        ajax: {
            type: 'post',
            url: '/api/new_post/search_cities',
            data: (params) => {
                return {name: params.term}
            },
            processResults: function (response) {
                let results = response.data.map(function (item) {
                    return {id: item.id, text: `${item.prefix} ${item.name}`}
                })

                return {results}
            }
        },
        cache: true
    })

    $('#new_post_city').on('select2:select', function () {
        let city = $(this).val()

        $.post('/api/new_post/search_warehouses', {city}).then(function (response) {
            let options = response.data.map(function (item) {
                return `<option value="${item.id}">${item.name}</option>`
            })

            $('#new_post_warehouse').attr('disabled', false).html(options.join())
        })
    })

    $('#logistic').on('change', function () {
        let isNewPost = +$(this).val() === 1

        if (isNewPost) {
            $('#new_post_warehouse').parents('.form-group').show()
            $('#new_post_city').parents('.form-group').show()
            $('#other_city').parents('.form-group').hide()
            $('#other_warehouse').parents('.form-group').hide()
        } else {
            $('#new_post_warehouse').parents('.form-group').hide()
            $('#new_post_city').parents('.form-group').hide()
            $('#other_city').parents('.form-group').show()
            $('#other_warehouse').parents('.form-group').show()
        }
    })

    $('#street').typeahead({
        source(query, result) {
            $.post('/api/streets/search', {name: query}).then((response) => {
                let data = response.data.map((item) => {
                    return `${item.street_type} ${item.name} (${item.district})`
                })

                result(data)
            })
        }
    })
})

$(document).on('click', '.searched', function () {
    let id = $(this).data('id')
    let type = window.order.type
    $.post('/orders/get_product', {type, id}, function (response) {
        $('#product-list tbody').prepend(response)
        checkPrice()
    })
})


$(document).on('change', '#sms-template', function () {
    let order_id = window.order.id
    let template_id = $(this).val()

    $.post('/sms/prepare_template', {order_id, template_id}).then(function (response) {
        $('#sms-text').val(response.text)
    })
})


$(document).on('change', '#order_professional_id', function () {
    if ($(this).val() === '') {
        $('#liable_id').attr('disabled', true)
        $('#liable_id option:selected').attr('selected', false)
        $('#liable_id option[value=""]').attr('selected', true)
    } else {
        $('#liable_id').attr('disabled', false)
    }
})

$(document).on('click', '.deleteProduct', function (event) {
    event.preventDefault()

    const $row = $(this).parents('tr.product')
    let order_id = $(this).data('order-id')
    let pivot_id = $(this).data('pivot-id')

    if (!order_id) {
        return $row.remove()
    }

    DeleteOnClick(() => {
        $.post('/orders/delete_product', {order_id, pivot_id}, (response, code, jQueryXHR) => {
            $row.remove()
            new SuccessHandler(response, jQueryXHR).apply()
            checkPrice()
        })
    })
})

$(document).on('submit', '#updateProducts', function (event) {
    event.preventDefault()

    let storageValid = true
    $(this).find('.storageId').each(function () {
        if (!$(this).val()) {
            storageValid = false
        }
    })

    if (!storageValid) {
        return toastr.error('Виберіть склад для всіх товарів')
    }

    if (!$('tr.product').length) {
        return toastr.error('Виберіть хоча б один товар')
    }

    let data = new FormData(this)

    $.ajax({
        method: 'post',
        url: $(this).attr('action'),
        data: data,
        processData: false,
        contentType: false,
        success(response, status, xhr) {
            new SuccessHandler(response, xhr).setAfter('reload').apply()
        },
        error(response) {
            new ErrorHandler(response).setFormElement(event.currentTarget).apply()
        }
    })
})
