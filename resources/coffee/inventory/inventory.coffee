$(document).on 'click', "#find_products", ->
    manufacturer_id = $('#manufacturer_id').val()
    storage_id = $('#storage_id').val()
    category_id = $('#category_id').val()

    return alert('Виберіть виробника!') if manufacturer_id is ''
    return alert('Виберіть склад!') if storage_id is ''

    $.ajax
        type: 'post'
        url: '/inventory/form'
        data:
            manufacturer_id: manufacturer_id,
            storage_id: storage_id,
            category_id: category_id
        success:  (answer) -> $('#place_for_products').html answer
        error: (answer) ->
            new ErrorHandler(answer)
                .apply()