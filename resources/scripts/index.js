let ErrorHandler = require('../coffee/handlers/ErrorHandler.coffee')

eventRegister('click', '.closeNotification', function () {
    let id = $(this).data('id')
    $.ajax({
        type: 'post',
        url: '/notification/close_notification',
        data: {id},
        success: () => {
            window.location.reload()
        },
        error: (answer) => {
            new ErrorHandler(answer).apply()
        }
    })
})


/*
$(document).on 'click', '.close_task', ->
id = $(@).data 'id'
type = $(@).data 'type'

data =
    id: id
type: type
action: 'close_form'

$.ajax
type: 'post'
url: '/task'
data: data,
    success: (answer) -> myModalOpen answer
error: (answer) -> errorHandler answer

$(document).on 'submit', '#close_task', (event) ->
    event.preventDefault()

data = $(@).serializeJSON()
data.action = 'close'

$.ajax
type: 'post'
url: '/task'
data: data,
    success: (answer) -> successHandler answer
error: (answer) -> errorHandler answer
*/
