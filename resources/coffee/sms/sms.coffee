eventRegister 'click', '.edit', ->
    data =
        id: $(@).parents('tr').data('id')
    
    $(@).parents('tr').find('.field').each ->
        data[$(@).attr 'name'] = $(@).val()
    
    $.ajax
        type: 'post'
        url: '/sms/update'
        data: data
        success: (answer, status, xhr) -> new SuccessHandler(answer, xhr).setAfter('').apply()
        error: (answer) -> new ErrorHandler(answer).apply()