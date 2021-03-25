$(document).on('click', 'div.pull-right', (event) => {
    event.preventDefault()
        // alert('1');
})

$('[data-src="import_order"]').click((event) => {
    const id = $(event.currentTarget).data('id')
    let url = new URL(window.location.href)
    let shop = url.searchParams.get("shop")
    $.ajax({
        type: 'post',
        url: '/shop/orders/Import?shop=' + shop,
        data:
            JSON.stringify({
                id: id,
                shop: shop
            }),
        dataType: 'json',
        contentType:'application/json'
    }).done((response)=>{
        if (response != 0)
            toastr.success('Замовлення успішно імпортовано.  №  Нового замовлення: ' + response ,'Імпорт')
        else
            toastr.warning('Замовлення Не імпортовано, по причині наявності данного замовлення в системі CRM' ,'Імпорт')
    })
})
