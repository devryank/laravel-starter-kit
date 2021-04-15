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
                    id="exampleModalLabel">Create User</h5>
                <a class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                    wire:click="$emit('modalClose')">
                    <span aria-hidden="true">×</span>
                </a>
            </div>
            <form wire:submit.prevent="store"
                method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input wire:model="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input wire:model="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <div class="input-group">
                            <input wire:model="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password">
                            <div class="input-group-append">
                                <span class="input-group-text"
                                    id="show-password"
                                    onclick="showPassword()"><i id="icon-pw"
                                        class="fa fa-eye-slash"></i></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <div class="input-group">
                            <select wire:model="roleId"
                                class="form-control @error('roleId') is-invalid @enderror">
                                <option>-- Choose One --</option>
                                @if (count($roles))
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        @error('roleId')
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
                        value="Create">
                </div>
            </form>
        </div>
    </div>
</div>