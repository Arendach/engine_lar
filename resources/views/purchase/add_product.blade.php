<div class="new_product_block form-group">
    <div class="search_product">
        <div class="mini-block row" style="margin-bottom: 10px">
            <div class="col-md-8">
                <input name="name" placeholder="Почніть вводити..." class="form-control input-md purchase-search-products">
            </div>

            <div class="col-md-4">
                <select name="category_id" class="form-control purchase-search-products">
                    <option value="">Вибрати категорію</option>
                    {!! $categories !!}
                </select>
            </div>
        </div>

        <div id="place_for_search">
            <table class="table-bordered table"></table>
        </div>
    </div>
</div>