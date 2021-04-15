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
                    id="exampleModalLabel">Update Permissions</h5>
                <a class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                    wire:click="$emit('modalClose')">
                    <span aria-hidden="true">×</span>
                </a>
            </div>
            <form wire:submit.prevent="update"
                method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input wire:model="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            required>
                        @error('name')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Display name</label>
                        <input wire:model="displayName"
                            type="text"
                            class="form-control @error('display_name') is-invalid @enderror"
                            required>
                        @error('display_name')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input wire:model="description"
                            type="text"
                            class="form-control @error('description') is-invalid @enderror"
                            required>
                        @error('description')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                        wire:click="$emit('modalClose')">Close</button>
                    <input type="submit"
                        class="btn btn-primary"
                        value="Ubah">
                </div>
            </form>
        </div>
    </div>
</div>