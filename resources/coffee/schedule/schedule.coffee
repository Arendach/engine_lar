$(document).on 'keyup', '.time', ->
    $this = $(this)
    array = []
    for i in [0 ..23]
        array.push(i)

    if $.inArray(+$this.val(), array) is -1 then $($this.val(0))

$(document).on 'change', '[name=type]', ->
    if $(@).attr('data-code') isnt 'working'
        $('#turn_up, #went_away, #dinner_break').val('').attr('disabled', yes)
    else
        $('#turn_up, #went_away, #dinner_break').attr('disabled', no)

$(document).on 'keyup', '#payout-sum', ->
    if +$(@).val() > +$('.max_payout').text()
        $(@).val(+$('.max_payout').text())
