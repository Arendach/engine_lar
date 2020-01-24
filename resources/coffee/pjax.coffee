$(document).pjax 'a', '#pjax-container', fragment: '#pjax-container'

window.PjaxReload = ->
    new Modal().close()
    $.pjax.reload
        container: '#pjax-container',
        fragment: '#pjax-container',

$(document).on 'pjax:click', (options) ->
    console.log($(options.currentTarget))
    window.resetEventStorage()

window.eventStorage = []

window.event = (type, element, handler) ->
    $(document).on(type, element, handler);

    window.eventStorage.push({type, element, handler})

window.resetEventStorage = () ->
    for hand in window.eventStorage
        $(document).off(hand.type, hand.element, hand.handler)

    window.eventStorage = []