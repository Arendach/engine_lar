class SuccessHandler
    constructor: (@answer, @res) ->
        @driver = 'toastr'
        @after = 'close'

        @message = @answer.message
        @title = @answer.title

        if @answer.redirectTo isnt undefined
            @redirectTo = @answer.redirectTo

    setMessages: ->
        if @res.status is 200
            @status200Handler()
        else if @res.status is 301
            @status301Handler()
        else
            @title ?= 'Виконано'
            @message ?= 'Дані успішно збережені'

    status200Handler: ->
        @title ?= 'Виконано'
        @message ?= 'Дані успішно збережені'

    status301Handler: ->
        window.location.href = @answer.redirectTo
        @title ?= 'Виконано'
        @message ?= 'Дані успішно збережені'

    setDriver: (@driver) -> @

    setAfter: (@after) -> @

    setRedirectTo: (@redirectTo) -> @

    setAfterCallable: (@callable) -> @

    setFormElement: (@form) -> @

    reload: ->
        $.cookie('success', yes)
        if (isUsePjax) then PjaxReload() else window.location.reload()


    reset: ->
        $ ':input', @form
            .not ':button, :submit, :reset, :hidden'
            .val ''
            .prop 'checked', off
            .prop 'selected', off

    apply: () ->
        @setMessages()

        if @driver is 'toastr' then @applyToastr()
        else if @driver is 'sweetalert' then @applySweetalert()

    applyToastr: () ->
        if @after is 'reload'
            return @reload()

        if @after is 'reset'
            @reset()

        if (@after is 'redirect')
            window.location.href = @redirectTo

        SuccessToastr(@title, @message)

    applySweetalert: () ->
        swal.fire
            title: @answer.title
            text: @answer.text
            icon: 'success'

module.exports = SuccessHandler
