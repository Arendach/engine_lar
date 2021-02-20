
window.delay = (fn, ms) ->
    timer = 0
    (...args) ->
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)

timeout = null
$(document).on 'keyup', '.contentEditable', ->
    if (timeout != null)
        clearTimeout(timeout)

    timeout = setTimeout =>
        timeout = null
        element = $ this
        id = element.data('id')
        model = element.data('model')
        field = element.data('field')
        value = element.html()

        $.ajax({
            type: 'post'
            url: '/universal/update'
            data:
                field: field
                value: value
                model: model
                id: id
            success: (response) -> toastr.success('Збережено')
            error: (response) -> toastr.error('Помилка')
        })
    , 2000


window.switchField = (context) ->
    element = $ context
    id = element.data('id')
    model = element.data('model')
    field = element.data('field')
    value = element.is(':checked')

    $.ajax({
        type: 'post'
        url: '/universal/update'
        data:
            field: field
            value: value
            model: model
            id: id
        success: (response) -> toastr.success('Збережено')
        error: (response) -> toastr.error('Помилка')
    })

window.changeField = (context) ->
    element = $ context
    id = element.data('id')
    model = element.data('model')
    field = element.data('field')
    value = element.val()
    html = element.find('option:selected').html()

    url = new URL(window.location.href)
    shop = url.searchParams.get("shop")

    $.ajax({
        type: 'post'
        url: '/universal/update'
        data:
            field: field
            value: value
            model: model
            id: id
            shop: shop
        success: (response) =>
            toastr.success('Збережено')
            element.parent().hide()
            element.parent().siblings('.content-editable-text').html(html).show()
        error: (response) -> toastr.error(response.responseJSON.message)
    })

$(document).on 'click', '.content-editable-text', ->
    $(this).hide()
    $(this).siblings('.content-editable-element').show()

$(document).on 'submit', '[data-type="editableForm"]', (event) ->
    event.preventDefault()
    data = new FormData(this)
    element = this
    value = data.get('value')

    $.ajax({
        type: 'post'
        url: '/universal/update'
        data: data
        processData: false
        contentType: false
        success: (response) ->
            $(element).parents('.content-editable-popup').hide().siblings('.content-editable-text').html(value).show()
        error: (response) -> console.log(response)
    })