$(document).pjax 'a', '#pjax-container', fragment: '#pjax-container'

reload = ->
  window.location.reload()
#  $.pjax.defaults.timeout = false
#  $.pjax.reload({container: '#pjax-container', fragment: '#pjax-container'})

module.exports = reload