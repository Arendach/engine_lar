#$.pjax.reload {container: '#pjax-container', timeout: false}

$(document).pjax 'a', '#pjax-container', fragment: '#pjax-container'
