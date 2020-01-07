class Modal
    open: (html) ->
        $('#pjax-container').append(html)
        $('.modal').modal()
        @.handlers()
    
    handlers: ->
        $(document).on 'click', '#modal_close', @close
        $(document).on 'click', '.poster', @close
        $(document).on 'keydown', -> (event) ->
            if event.which is 27
                @close()
    
    close: ->
        $('.modal').modal('hide')
        setTimeout(->
            $('.modal').remove()
        , 400)



module.exports = Modal