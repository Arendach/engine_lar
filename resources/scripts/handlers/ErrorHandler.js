class ErrorHandler {
    driver = 'toastr'
    after = 'close'
    form = 'form'
    responseData = {}
    response = {}

    constructor(response) {
        this.response = response

        if (typeof response !== 'object' || !response.hasOwnProperty('responseJSON')) {
            return
        }

        let responseData = response.responseJSON
        this.responseData = responseData
        this.title = responseData.title ?? 'Помилка'
        this.message = responseData.message ?? ''
        this.errors = responseData.errors ?? {}
    }

    setMessages() {
        let methodName = `handler${this.response.status}`

        if (typeof this[methodName] === 'function') {
            this[methodName]()
        }

        this.handlerDefault()
    }

    setMessage(message) {
        this.message = message
        return this
    }

    setTitle(title) {
        this.title = title
        return this
    }

    setDriver(driver) {
        this.driver = driver
        return this
    }

    setAfter(after) {
        this.after = after
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

    handlerDefault() {
        this.message = this.message ?? 'Невідома помилка'
    }

    handler0() {
        this.message = this.message ?? 'Немає зєднання з інтернетом'
    }

    handler400() {
        this.message = this.message ?? 'Дані невірно заповнені'
        this.validateErrorAppends()
        this.eventListeners()
    }

    handler422() {
        this.handler400()
    }

    handler401() {
        this.message = this.message ?? 'Для продовження необхідно авторизуватись'
        window.open('/login?after=close')
    }

    handler403() {
        this.message = this.message ?? 'У вас немає доступу до даної дії'
    }

    handler404() {
        this.message = this.message ?? 'Не знайдено елемент або невірна адреса'
    }

    handler500() {
        this.message = this.message ?? 'Помилка сервера: 500. Визивай екзорциста.'
    }

    handler504() {
        this.message = this.message ?? 'Час очікування минув. Сервер підвис кароче :)'
    }

    validateErrorAppends() {
        for (let field in this.errors) {
            let error = this.errors[field]

            if (Array.isArray(error)) {
                error = error.join('<br>')
            }

            let name = this.getValidName(field)
            let nameWithBrackets = this.getNameWithBrackets(name)

            let isLangField = field.match(/(ru|uk)$/)

            $(this.form)
                .find(`[name="${nameWithBrackets}"]`)
                .parents(isLangField ? '.input-group' : '.form-group')
                .addClass('has-error')

            $(`#${name}-error-block`).remove()

            let afterInsertElement = $(this.form).find(`[name="${name}"]`)

            if (isLangField) {
                afterInsertElement = afterInsertElement.parent()
            }

            $(`<span id='${name}-error-block' style="color: red" class='help-block'>${error}</span>`)
                .insertAfter(afterInsertElement)
        }
    }

    eventListeners() {
        $(this.form).find('[name]').on('keyup change', (event) => {
            if (event.key === 'Enter') {
                return
            }

            let name = $(event.currentTarget).attr('name')
            name = this.getNameWithBrackets(name)

            $(`#${name}-error-block`).remove()

            let isLangField = name.search(/(ru|uk)$/)

            $(`[name="${name}"]`)
                .parents((isLangField > 0) ? '.input-group' : '.form-group')
                .removeClass('has-error')
        })
    }

    getValidName(name) {
        if (name.match(/\./)) {
            let components = name.split('.')
            let result = components[0] + '['
            components.shift()
            result += components.join('][')
            return (result += ']')
        }

        return name
    }

    getNameWithBrackets(name) {
        name = name.replaceAll(/\[/, '\\[')
        name = name.replaceAll(/]/, '\\]')

        return name
    }

    apply() {
        this.setMessages()

        if (this.driver === 'toastr') {
            this.applyToastr()
        }

        if (this.driver === 'sweetalert') {
            this.applySweetAlert()
        }
    }

    applyToastr() {
        toastr.error(this.message, this.title)
    }

    applySweetAlert() {
        swal.fire({
            title: this.title,
            message: this.message,
            icon: "error"
        })
    }
}

module.exports = ErrorHandler
