<div class="modal fade show"
    id="myModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myModalLabel"
    style="padding-right: 17px; display: block;">
    <div class="modal-dialog modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">Update Role</h5>
                <a class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                    wire:click="$emit('modalClose')">
                    <span aria-hidden="true">×</span>
                </a>
            </div>
            <form wire:submit.prevent="update"
                method="post">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input wire:model.defer="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Display name</label>
                        <input wire:model.defer="displayName"
                            type="text"
                            class="form-control @error('displayName') is-invalid @enderror">
                        @error('displayName')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input wire:model.defer="description"
                            type="text"
                            class="form-control @error('description') is-invalid @enderror">
                        @error('description')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="">Permissions</label>
                        <div style="overflow-y: auto; height: 200px;">
                            @foreach ($permissions as $key => $permission)
                            <input type="checkbox"
                                wire:model="permissionId"
                                class="my-2 check-role"
                                value="{{ $permission->id }}"> {{$permission->display_name}}
                            <br>
                            @endforeach
                        </div>

                        @error('permissionId')
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
                        value="Update Role">
                </div>
            </form>
        </div>
    </div>
</div>