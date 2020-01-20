$(document).on('pjax:beforeSend', -> $(document).off())

$(document).pjax 'a', '#pjax-container', fragment: '#pjax-container'

reload = ->
    new Modal().close()
    $(document).off()
    $.pjax.reload(container: '#pjax-container', fragment: '#pjax-container')
#window.location.reload()
#  $.pjax.defaults.timeout = false
#  $.pjax.reload({container: '#pjax-container', fragment: '#pjax-container'})

module.exports = reload