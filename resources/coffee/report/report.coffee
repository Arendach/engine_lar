$(document).on 'click', '.preview', ->
    id = $(@).parents('tr').data('id')

    ajax = ->
        $.ajax
            type: 'post'
            url: url('reports')
            data: {id: id, action: 'preview'}
            success: (answer) -> $('#preview_' + id).html(answer)
            error: (answer) -> new ErrorHandler(answer).apply()

    is_set = false

    $('.preview_container').each ->
        if ($(this).html() != '')
            is_set = true

    if (!is_set)
        do ajax()
    else
        if $('#preview_' + id).html() != ''
            $('.preview_container').html('')
        else
            $('.preview_container').html('')
            ajax()
