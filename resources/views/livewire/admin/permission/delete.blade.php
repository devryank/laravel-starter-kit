<div class="modal fade show"
    id="exampleModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    style="padding-right: 17px; display: block;">
    <div class="modal-dialog"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">Are you sure to delete permission {{ $name }}?</h5>
                <a class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                    wire:click="$emit('modalClose')">
                    <span aria-hidden="true">×</span>
                </a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <a wire:click="$emit('modalClose')"
                            class="btn btn-primary btn-block text-white">No</a>
                    </div>
                    <div class="col">
                        <a wire:click="destroyPermission()"
                            class="btn btn-danger btn-block text-white">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>