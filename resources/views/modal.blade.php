<div class="modal fade" data-backdrop="static" data-on-success="@yield('onClose', 'none')">
    <div class="modal-dialog modal-@yield('modal_size', 'lg')">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">@yield('title', '')</h4>
            </div>
            <div class="modal-body">

                @yield('content')

            </div>
        </div>
    </div>
</div>
