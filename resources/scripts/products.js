class Product {
    init() {
        eventRegister('click', '#search', this.filterList)

        eventRegister('change', 'select[data-action=search]', this.filterList)

        eventRegister('keyup', '[data-action=search]', (event) => {
            if (event.which === 13) {
                this.filterList()
            }
        })

        eventRegister('change', '[name=level1]', this.storageIdsChangeHandler)

        eventRegister('change', '#category', this.generateServiceCode)

    }

    filterList() {
        let data = {}

        $('[data-action=search]').each(function () {
            data[$(this).data('column')] = $(this).val()
        })

        new UrlGenerator().appends(data).unset('page').unsetEmpty().go()
    }

    storageIdsChangeHandler(event) {
        let k = $(event.currentTarget).val()

        if (k === '') {
            return $('[name=level2]').attr('disabled', 'disabled').html('')
        }

        let result = ''
        let ids = window.storageIds

        ids[k].forEach(function (i) {
            result = result + `<option value="${i}">${i}</option>`
        })

        $('[name=level2]').html(result).removeAttr('disabled')
    }

    generateServiceCode(event) {
        let $this = $(event.currentTarget)
        let id = $this.val()

        $.post('/product/generate_service_code', {id}).then(function (response) {
            $('#service_code').html(response.data)
            $('[name="service_code"]').val(response.data)
            $('.service_code').show()
        })
    }

}

new Product().init()