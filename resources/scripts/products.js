class Product {
    init() {
        eventRegister('click', '#search', this.filterList)

        eventRegister('change', 'select[data-action=search]', this.filterList)

        eventRegister('keyup', '[data-action=search]', (event) => {
            if (event.which === 13) {
                this.filterList()
            }
        })
    }

    filterList() {
        let data = {}

        $('[data-action=search]').each(function () {
            data[$(this).data('column')] = $(this).val()
        })

        new UrlGenerator().appends(data).unset('page').unsetEmpty().go()
    }
}

new Product().init()