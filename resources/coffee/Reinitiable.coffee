$(document).ready ->
    # Tooltip
    $('[data-toggle="tooltip"]').tooltip()
    $('[data-toggle="popover"]').popover()

    # CKEDITOR Initiable
    $('[data-type="ckeditor"]').each ->
        CKEDITOR.replace($(@).attr('name'))

    # Tabs switcher
    url = document.location.toString()
    if url.match '#'
        $('.nav-pills a[href="#' + url.split('#')[1] + '"]').tab('show')

    $('.nav-pills a').on 'shown.bs.tab', (event) ->
        window.location.hash = event.target.hash

    if $.cookie('success') is 'true'
        toastr.success('Дані успішно збережені', 'Виконано')
        $.cookie('success', null)

    Inputmask('999-999-99-99').mask('[data-type="phone"]')
