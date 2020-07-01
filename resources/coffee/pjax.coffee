if (window.isUsePjax)
    $(document).pjax 'a', '#pjax-container', {fragment: '#pjax-container', timeout: false}

    $(document).on 'pjax:beforeSend', () -> resetEventStorage()


window.PjaxReload = ->
    new Modal().close()
    $.pjax.reload
        container: '#pjax-container',
        fragment: '#pjax-container'

window.PjaxLoad = (url) ->
    $.pjax {url: url, container: '#pjax-container', fragment: '#pjax-container'}


window.eventStorage = []

window.eventRegister = (type, element, handler) ->
    $('#pjax-container').on(type, element, handler);

    window.eventStorage.push({type, element, handler})

window.resetEventStorage = () ->
    for hand in window.eventStorage
        $('#pjax-container').off(hand.type, '**')

    window.eventStorage = []