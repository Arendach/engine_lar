<div class="modal fade" data-backdrop="static">
    <div class="modal-dialog modal-@yield('modal_size', 'lg')">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">@yield('title', '')</h3>
            </div>
            <div class="modal-body">

                @yield('content')

            </div>
        </div>
    </div>
</div>

@yield('scripts')