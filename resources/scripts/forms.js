class Forms {
    init() {
        eventRegister('submit', '[data-type="ajax"]', this.sendAjaxForm)
        eventRegister('keyup', '[data-max]', this.maxFieldChecker)
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
}

new Forms().init()