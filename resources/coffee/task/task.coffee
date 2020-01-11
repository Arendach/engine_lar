$(document).on 'change', '#status', ->
    $this = $(this)
    if ($this.val() == '') then new UrlGenerator().unset('status').go()
    else new UrlGenerator().append('status', $this.val()).go()


$(document).on 'click', '.approve_task', ->
    id = $(this).parents('tr').data('id')
    swal.fire
        title: 'Затвердити?'
        text: 'Дану дію відмінити буде неможливо'
        icon: 'info'
        showCancelButton: true
        confirmButtonColor: '#DD6B55'
        confirmButtonText: 'Підтвердити'
        cancelButtonText: 'Відмінити'
        closeOnConfirm: false
    .then (result) =>
        return if not result.value
        $.ajax
            type: "post"
            url: '/task/approve'
            data: {id: id}
            success: (response, status, xhr) -> new SuccessHandler(response, xhr).apply()
            error: (response) -> new ErrorHandler(response).apply()
