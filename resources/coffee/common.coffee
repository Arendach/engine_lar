window.Modal = require './Modal.coffee'
window.SuccessToastr = require './handlers/SuccessToastr.coffee'
window.SuccessHandler = require '../scripts/handlers/SuccessHandler.js'
window.ErrorHandler = require '../scripts/handlers/ErrorHandler.js'
window.DeleteOnClick = require './handlers/DeleteOnClick.coffee'

patterns =
    comma: /\,/
    space: /\s/
    letter: /[a-zA-Zа-яА-Я]/
    anySym: /[\!\@\#\$\%\^\&\*\(\)\=\_\`\~\'\\\|\/\+\:\;\>\<\?]/
    point: /\./g
    hyphen: /\-/
    number: /\D/

window.ElementsExists = false
window.inputCache = ''

window.str_to_int = (str) -> str.replace(/\D+/g, "")

window.pin_code = (sendFunc) ->
    sendFunc()


window.getParameters = ->
    Pattern = /[\?][\w\W]+/
    params = document.location.href.match(Pattern)
    params = '' if params?

window.redirect = (url) -> window.location.href = url

window.url = (path) ->
    path = path.replace(/^\//, '')
    "#{my_url}/#{path}"

String::replaceAll = (search, replace) -> @.split(search).join(replace)

$(document).on 'hide.bs.modal', '.modal', -> $(this).remove()

#Валідація поля типу decimal
$(document).on 'focus', '[data-inspect]', -> document.inputCache = $(@).val()

$(document).on 'focusout', '[data-inspect]', -> document.inputCache = ''

$(document).on 'change', '.input-file-input', (event) ->
    input_file_input = $ event.currentTarget
    input_file_container = input_file_input.parents '.input-file-container'
    input_file_names = input_file_container.find '.input-file-names'

    input_file_names.html ''

    files = input_file_input.prop 'files'
    for file in files
        input_file_names.append file.name + '<br>'


$(document).on 'keyup', '[data-inspect="decimal"]', ->
    value = $(@).val()

    return if value is ''

    value = value.replaceAll(patterns.comma, '.')
    value = value.replaceAll(patterns.space, '')
    value = value.replaceAll(patterns.letter, '')
    value = value.replaceAll(patterns.anySym, '.')

    pointCounter = if value.match(patterns.point) is null then 0 else value.match(patterns.point).length

    if pointCounter is 1
        split = value.split('.', 2)
        if split[1].length > 2 then value = document.inputCache
    else if pointCounter > 1
        value = document.inputCache

    document.inputCache = value

    $(@).val(value)


eventRegister 'keyup', '[data-inspect="integer"]', ->
    value = $(@).val()
    return if value is ''
    minus = value.match patterns.hyphen
    value = value.replaceAll patterns.number, ''
    value = "-#{value}" if minus
    $(@).val value


$(document).on 'click', '[data-type="get_form"]', (event) ->
    event.preventDefault()

    url = $(@).data 'uri'
    data = $(@).data 'post'
    id = $(@).data('id')

    if data is undefined then data = {id}

    $(@).attr('disabled', on)

    $.ajax
        type: 'post'
        url: url
        data: data
        success: (answer) =>
            $(@).attr('disabled', no)
            new Modal().open(answer)
            $(document).trigger('formLoaded')
        error: (answer) =>
            $(@).attr('disabled', no)
            new ErrorHandler(answer).apply()

eventRegister 'click', '.map-signs', (event) ->
    current = $(event.currentTarget)
    content_left = $ '.content-left'
    content_right = $ '.content-right'
    navbar = $ '.content-right > .navbar'

    if current.data('state') is 'open'
        content_left.css 'left', '-220px'
        content_right.css 'margin-left', '0'
        navbar.css 'left', '0'
        current.data 'state', 'close'
        $.cookie 'left-content-state', 'close', expires: 5
    else
        content_left.css 'left', '0'
        content_right.css 'margin-left', '220px'
        navbar.css 'left', '220px'
        current.data 'state', 'open'
        $.cookie 'left-content-state', 'open', expires: 5


eventRegister 'hide.bs.modal', '.modal', -> $(@).remove()


$('a[data-type="pin_code"]').on 'click', ->
    href = $(@).data('href')
    pin_code -> window.location.href = href

$(document).on 'click', '.change-theme', (event) ->
    event.preventDefault()

    name = $(@).data('name')
    href = $(@).data('href')
    theme = $(@).data('theme')

    $('#baze-theme').attr('href', href)
    $('#theme-name').text(name)

    $.post '/main/change_theme', {theme: theme}

$(document).on 'formLoaded', ->
# CKEDITOR Initiable
    $('[data-type="ckeditor"]').each ->
        CKEDITOR.replace($(@).attr('name'))

    Inputmask('999-999-99-99').mask('[data-type="phone"]')


require('./editable.coffee')