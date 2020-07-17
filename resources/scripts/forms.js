window.SuccessToastr = require('../coffee/handlers/SuccessHandler.coffee')

$(document).on('submit', '[data-type="ajax"]', function (event) {
    event.preventDefault()

    let url = $(this).attr('action')
    let type = $(this).attr('method')
    let redirectTo = $(this).data('redirect-to')
    let success = $(this).data('success')
    let error = $(this).data('error')
    let after = $(this).data('after')

    let data = new FormData(this)

    if (url === undefined || url === null) {
        url = window.location
    }

    if (type === undefined || type === null) {
        type = 'post'
    }

    if (success === undefined || success === null) {
        success = 'toastr'
    }

    if (error === undefined || error === null) {
        error = 'toastr'
    }

    if (after === undefined || after === null) {
        after = 'close'
    }

    if (redirectTo === undefined || redirectTo === null) {
        redirectTo = window.location
    }

    $(this).find('[name]').attr('disabled', true)
    $(this).find('button').attr('disabled', true).prepend('<i class="fa fa-circle-o-notch fa-spin"></i> ')

    function send() {
        $.ajax({
            type, url, data,
            processData: false,
            contentType: false,
            success(response, status, jQueryXHR) {
                let handler = new SuccessHandler(response, jQueryXHR)

                handler.setDriver(success)
                handler.setFormElement(event.currentTarget)
                handler.setAfter(after)

                if (typeof response === 'object' && response.hasOwnProperty('url')) {
                    handler.setRedirectTo(response.url)
                } else {
                    handler.setRedirectTo(redirectTo)
                }

                handler.apply()

                $(event.currentTarget).find('[name]').attr('disabled', false)
                $(event.currentTarget).find('button').attr('disabled', false).find('i.fa-spin').remove()
            },
            error(response) {
                let handler = new ErrorHandler(response)

                handler.setFormElement(event.currentTarget)
                handler.setDriver(error)

                handler.apply()

                $(event.currentTarget).find('[name]').attr('disabled', false)
                $(event.currentTarget).find('button').attr('disabled', false).find('i.fa-spin').remove()
            }
        })
    }

    if (typeof $(this).data('pin_code') != "undefined") {
        pin_code(send())
    } else {
        send()
    }
})

$(document).on('keyup', '[data-max]', function () {
    let max = $(this).data('max')
    let val = $(this).val()

    if (val > max) {
        $(this).val(max)
    }
})

