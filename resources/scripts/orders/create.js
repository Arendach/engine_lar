const ErrorHandler = require('../../coffee/handlers/ErrorHandler.coffee')

FormData.prototype.toObject = function () {
    let temp = {}
    this.forEach(function (value, key) {
        temp[key] = value
    })
    return temp
}

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
            window.location.href = response.url
        },
        error(response) {
            (new ErrorHandler(response))
                .setFormElement(event.currentTarget)
                .setDriver('toastr')
                .apply()
        }
    })
})