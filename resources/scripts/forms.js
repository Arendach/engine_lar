class Forms {
    init() {
        eventRegister('submit', '[data-type="ajax"]', this.sendAjaxForm)
        eventRegister('keyup', '[data-max]', this.maxFieldChecker)
        eventRegister('click', '[data-type="ajax_request"]', this.ajaxRequest)
        eventRegister('click', '.custom-checkbox', this.customCheckBox)
    }

    sendAjaxForm(event) {
        event.preventDefault()
        let context = event.currentTarget

        let url = $(context).attr('action')
        let type = $(context).attr('method')
        let redirectTo = $(context).data('redirect-to')
        let success = $(context).data('success')
        let error = $(context).data('error')
        let after = $(context).data('after')

        let data = new FormData(context)

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

        $(context).find('[name]').attr('disabled', true)
        $(context).find('button').attr('disabled', true).prepend('<i class="fa fa-circle-o-notch fa-spin"></i> ')

        function send() {
            $.ajax({
                type, url, data,
                processData: false,
                contentType: false,
                success(response) {
                    new SuccessHandler(response)
                        .setDriver(success)
                        .setRedirectTo(redirectTo)
                        .setFormElement(event.currentTarget)
                        .setAfter(after)
                        .apply()

                    $(event.currentTarget).find('[name]').attr('disabled', false)
                    $(event.currentTarget).find('button').attr('disabled', false).find('i.fa-spin').remove()
                },
                error(response) {
                    new ErrorHandler(response)
                        .setFormElement(event.currentTarget)
                        .setDriver(error)
                        .apply()

                    $(event.currentTarget).find('[name]').attr('disabled', false)
                    $(event.currentTarget).find('button').attr('disabled', false).find('i.fa-spin').remove()
                }
            })
        }

        if (typeof $(context).data('pin_code') != "undefined") {
            pin_code(send())
        } else {
            send()
        }
    }

    maxFieldChecker(event) {
        let context = event.currentTarget

        let max = $(context).data('max')
        let val = $(context).val()

        if (val > max) {
            $(context).val(max)
        }
    }

    ajaxRequest(event) {
        event.preventDefault()

        let url = $(this).data('uri')
        let data = $(this).data('post')
        let after = $(this).data('after')

        $(this).attr('disabled', true)

        $.ajax({
            type: 'post',
            url, data,
            success(response) {
                $(event.currentTarget).attr('disabled', false)
                new SuccessHandler(response).setAfter(after).apply()
            },
            error(response) {
                $(event.currentTarget).attr('disabled', false)
                new ErrorHandler(response).apply()
            }
        })
    }

    customCheckBox(event) {
        let  input = $(event.currentTarget).find('input')

        input
            .val(input.val() === '0' ? '1' : '0')
            .siblings('.fa')
            .toggle()
    }
}

new Forms().init()