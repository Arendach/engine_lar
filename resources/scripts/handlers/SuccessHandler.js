class SuccessHandler {
    redirectTo = window.location.href
    response = {}
    driver = 'toastr'
    after = 'close'
    message = 'Дані успішно збережені'
    title = 'Виконано'

    constructor(response) {
        if (typeof response === 'object') {
            this.response = response
        }
    }

    handler() {
        if (this.response.hasOwnProperty('message')) {
            this.message = this.response.message
        }

        if (this.response.hasOwnProperty('url')) {
            this.redirectTo = this.response.url
            this.after = 'redirect'
        }

        if (this.response.hasOwnProperty('redirectTo')) {
            this.redirectTo = this.response.redirectTo
            this.after = 'redirect'
        }
    }

    setDriver(driver) {
        this.driver = driver

        return this
    }

    setAfter(after) {
        this.after = after

        return this
    }

    setRedirectTo(url) {
        this.redirectTo = url

        return this
    }

    setAfterCallable(callable) {
        this.afterCallable = callable

        return this
    }

    setFormElement(form) {
        this.form = form

        return this
    }

    reload() {
        $.cookie('success', 'true')

        if (isUsePjax) {
            PjaxReload()
        } else {
            window.location.reload()
        }
    }

    redirect() {
        $.cookie('success', 'true')

        window.location.href = this.redirectTo
    }

    reset() {
        $(':input', this.form)
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .prop('checked', false)
            .prop('selected', false)
    }


    apply() {
        this.handler()

        if (this.driver === 'toastr') {
            this.applyToastr()
        }

        if (this.driver === 'sweetalert') {
            this.applySweetAlert()
        }
    }

    applyToastr() {
        if (this.after === 'reload') {
            return this.reload()
        }

        if (this.after === 'reset') {
            return this.reset()
        }

        if (this.after === 'redirect') {
            return this.redirect()
        }

        toastr.success(this.message, this.title)
    }

    applySweetAlert() {
        alert(this.message)
    }
}

module.exports = SuccessHandler