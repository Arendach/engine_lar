search_warehouses = (city_id) ->
    $.ajax
        type: 'post'
        url: '/api/search_warehouses'
        data:
            city: city_id
        success: (answer) ->
            $('#warehouse').html(answer).removeAttr 'disabled'

$(document).on 'keyup', '.amount, .price', ->
    $product = $(@).parents('.product')
    amount = $product.find('.amount').val()
    price = $product.find('.price').val()
    $product.find('.sum').val(amount * price)
    checkPrice()

$(document).on 'change keyup', '#search_field, #search_category', ->
    $this = $(@)
    data =
        search: $this.val()
        type: $this.data 'search'
    $.post '/orders/search_products', data, (res) -> $('.products').html(res)


$(document).on 'change', '#city_select', ->
    $selected = $(@)
    text = $selected.find('option:selected').text
    value = $selected.val
    $('#city_input').val(text)
    do search_warehouses value[0]
    $('#city').attr 'value', value

$(document).on 'focus', '#city_input', -> $('#city_select').parents('.form-group').css('display', 'block')

$(document).on 'keyup', '#city_input', ->
    if $('#city_input').val().length > 2
        return 0
    $.ajax
        type: 'post'
        url: '/api/get_city'
        data:
            key: '123'
            str: $('#city_input').val()
        success: (answer) -> $('#city_select').html(answer)
        error: (answer) -> errorHandler(answer)


$(document).on 'click', '#street-reset', -> $('#street').val('')

$(document).ready ->
    if $('#comment').length
        CKEDITOR.replace 'comment'

    if $('#client_id').length
        $('#client_id').select2({tags: "true", placeholder: "Виберіть клієнта"})

    $(document).on 'change', '#client_id', (event) ->
        selected = $(event.currentTarget).find(':selected')
        $('#fio').val(selected.data('fio'))
        $('#phone').val(selected.data('phone'))
        $('#email').val(selected.data('email'))
