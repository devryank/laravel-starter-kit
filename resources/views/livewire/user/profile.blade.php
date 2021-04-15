@php
// dd($edit)
@endphp
<div class="container-fluid my-5 pt-5 px-5">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-9 col-lg-6">
            <div class="card">
                <div class="card-body">

                    @if (session('message'))
                    <x-alert :type="session('type')"
                        :message="session('message')"></x-alert>
                    @endif

                    @if ($edit)
                    <form wire:submit.prevent="store"
                        enctype="multipart/form-data"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4">
                                @if ($image)

                                <img src="{{ $image->temporaryUrl() }}"
                                    alt=""
                                    width="100%"
                                    class="rounded-circle">
                                @else
                                {{-- show old image if user NOT upload an image --}}
                                <img src="{{ $imageOld }}"
                                    alt=""
                                    width="100%"
                                    class="rounded-circle">
                                {{-- endif image --}}
                                @endif
                                <input wire:model="image"
                                    type="file"
                                    class="form-control-file mt-2">
                                {{-- show loading states while uploading image --}}
                                <div wire:loading
                                    wire:target="image">Uploading ...</div>
                                @error('image')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-8 d-flex flex-column">
                                <input type="text"
                                    placeholder="Your Name"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    wire:model="name"
                                    autocomplete="off">
                                @error('name')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @if (!$editPassword)
                                <button class="btn btn-primary btn-block my-2"
                                    wire:click="editPassword"
                                    type="button">Edit Password</button>
                                @else
                                <button class="btn btn-primary btn-block my-2 rounded-0"
                                    wire:click="cancelEditPassword"
                                    type="button">Cancel Edit Password</button>
                                <div class="input-group">
                                    <input wire:model="password"
                                        type="password"
                                        class="form-control form-control-sm @error('password') is-invalid @enderror"
                                        id="password"
                                        placeholder="Enter your password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            id="show-password"
                                            onclick="showPassword()"><i id="icon-pw"
                                                class="fa fa-eye-slash"></i></span>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endif
                                <input type="submit"
                                    class="btn btn-primary rounded-0 align-self-end position-absolute"
                                    style="bottom: 0;"
                                    value="Save">
                            </div>
                        </div>
                    </form>
                    @endif


                    @if ($edit == false)
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset($user->profile_photo_path) }}"
                                width="100%"
                                class="rounded-circle">
                        </div>
                        <div class="col-lg-8 d-flex flex-column">
                            <h3>{{$user->name}}</h3>
                            <small>{{ $user->email }}</small>
                            <a wire:click="openEdit"
                                class="btn btn-primary rounded-0 align-self-end position-absolute"
                                style="bottom: 0;">Change Profile</a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showPassword() {
    var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
            $('#icon-pw').toggleClass('fa-eye-slash fa-eye')
        } else {
            x.type = "password";
            $('#icon-pw').toggleClass('fa-eye fa-eye-slash')
        }
    }
</script>
@endpush