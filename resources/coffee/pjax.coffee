$(document).pjax 'a', '#pjax-container', fragment: '#pjax-container'

$(document).on 'pjax:beforeSend', () -> resetEventStorage()

window.PjaxReload = ->
    new Modal().close()
    $.pjax.reload
        container: '#pjax-container',
        fragment: '#pjax-container'

window.PjaxLoad = (url) ->
    $.pjax {url: url, container: '#pjax-container', fragment: '#pjax-container'}


window.eventStorage = []

window.event = (type, element, handler) ->
    $('.content-page').on(type, element, handler);

    window.eventStorage.push({type, element, handler})

window.resetEventStorage = () ->
    for hand in window.eventStorage
        $('.content-page').off(hand.type, '**')

    window.eventStorage = []