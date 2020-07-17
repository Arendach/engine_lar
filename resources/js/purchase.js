function checkSum() {
    let allSum = 0

    $('.product').each(function () {
        let amount = $(this).find('.amount').val()
        let price = $(this).find('.price').val()
        let sum = (+amount * +price)

        $(this).find('.sum').val(sum)
        allSum += +sum
    })

    $('#sum').val(allSum)
}

eventRegister('input', '.purchase-search-products', function () {
    let data = {}
    let except = []

    $('.product').each(function () {
        except.push($(this).data('id'))
    })

    $('.purchase-search-products').each(function () {
        data[$(this).attr('name')] = $(this).val()
    })

    data.storage_id = Purchase.storage_id
    data.manufacturer_id = Purchase.manufacturer_id
    data.except = except

    $.ajax({
        type: 'post',
        url: url('purchase/search_products'),
        data,
        success: answer => $('#place_for_search').html(answer),
        error: (answer) => new ErrorHandler(answer).apply()
    })
})

eventRegister('input', '.filter', () => {
    let data = {}

    $('.filter').each(function () {
        data[$(this).data('column')] = $(this).val()
    })

    new UrlGenerator().appends(data).unsetEmpty().unset('page').filter()
})

eventRegister('click', '.product-item', function () {
    let id = $(this).data('id')
    let $node = $(this)

    fetch('/purchase/get_product', {
        method: 'post',
        body: JSON.stringify({
            id,
            storage_id: Purchase.storage_id
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        response.text().then(function (text) {
            $('table tbody').prepend(text)
            $node.remove()
            checkSum()
        })
    }).catch(function (response) {
        new ErrorHandler(response).apply()
    })
})

eventRegister('keyup', '.price, .amount, .course', checkSum)



// $body.on('click', '#update', function () {
//     var data = {};
//     data.products = [];
//     data.sum = $('#sum').val();
//     data.comment = $('#comment').val();
//
//     $('.product').each(function () {
//         var object = {};
//         object.id = $(this).data('id');
//         object.amount = $(this).find('.amount').val();
//         object.price = $(this).find('.price').val();
//         object.course = $(this).find('.course').val();
//         data.products.push(object);
//     });
//
//     data.id = purchase.id;
//     data.action = 'update';
//
//     $.ajax({
//         type: 'post',
//         url: url('purchases'),
//         data: data,
//         success: function (answer) {
//             successHandler(answer);
//         },
//         error: function (answer) {
//             errorHandler(answer);
//         }
//     });
// });
//
// $body.on('click', '#create', function () {
//     var data = {};
//     data.products = [];
//     data.manufacturer_id = purchase.manufacturer;
//     data.storage_id = purchase.storage;
//     data.sum = $('#sum').val();
//     data.comment = $('#comment').val();
//     data.action = 'create';
//
//     $('.product').each(function () {
//         var object = {};
//         object.id = $(this).data('id');
//         object.price = $(this).find('.price').val();
//         object.amount = $(this).find('.amount').val();
//         object.course = $(this).find('.course').val();
//         data.products.push(object);
//     });
//
//     $.ajax({
//         type: 'post',
//         url: url('purchases'),
//         data: data,
//         success: function (answer) {
//             successHandler(answer, function () {
//                 redirect('/purchases');
//             });
//         },
//         error: function (answer) {
//             errorHandler(answer);
//         }
//     });
// });
////
// $body.on('click', '.delete', function () {
//     $(this).parents('tr').remove();
//     check_sum();
// });
