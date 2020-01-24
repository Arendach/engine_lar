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


$(document).on 'keyup', '.count', ->
    sum = 0
    name_operation = ''
    $('.count').each ->
        if $(@).val() isnt ''
            text = $(@).siblings('label').text()
            name_operation += (if name_operation is '' then text else " + #{text}")

        val = $(@).val()
        val = val.replace(/,/, '.')
        val = val.replace(/\s/g, '')
        sum += +val

    $('[name="sum"]').val(sum)
    $('[name="name_operation"]').val("#{name_operation } = #{sum} грн")

$(document).on 'keyup', '.benzine', ->
    sum = 1
    $('.benzine').each ->
        sum *= $(@).val()

    $('[name="gasoline"]').val(sum)

    $('.count').trigger('keyup')

$(document).on 'change', '[name="user_id"]', ->
    $('[name="name_operation"]').val "Передача коштів #{$(@).find(':selected').text()}"
