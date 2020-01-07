class SuccessHandler
    constructor: (@answer, @res) ->
        @driver = 'toastr'
        @after = 'close'

        @message = @answer.message
        @title = @answer.title

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
        @title ?= 'Виконано'
        @message ?= 'Дані успішно збережені'

    setDriver: (@driver) -> @

    setAfter: (@after) -> @

    setRedirectTo: (@redirectTo) -> @

    setAfterCallable: (@callable) -> @

    apply: () ->
        @setMessages()

        if @driver is 'toastr' then @applyToastr()
        else if @driver is 'sweetalert' then @applySweetalert()

    applyToastr: () ->
        if @after is 'reload'
            new Modal().close()
            PjaxReload()
        else
            SuccessToastr(@title, @message)

    applySweetalert: () ->
        swal.fire
            title: @answer.title
            text: @answer.text
            icon: 'success'

module.exports = SuccessHandler
