$(document).on 'click', '[data-type="delete"]', (event) ->
  event.preventDefault()

  id = $(@).data 'id'
  url = $(@).data 'uri'
  data = $(@).data 'post'

  data = if data isnt undefined then data + "&id=" + id else {id}

  DeleteOnClick =>
    $.ajax
      type: 'post'
      url: url,
      data: data
      success: (answer, status, jqXHR) =>
        new SuccessHandler(answer, jqXHR).apply()
        $(@).parents('tr').remove()
        $(@).parents('.item-row').remove()
      error: (answer) ->
        new ErrorHandler(answer).apply()


DeleteOnClick = (handler) ->
  swal.fire({
    title: "Видалити?",
    text: "Дану дію відмінити буде неможливо!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Так, я хочу видалити!",
  }).then (value) -> if (value) then  handler()

module.exports = DeleteOnClick
