@push('styles')
<style>
    #show-password {
        cursor: pointer;
    }
</style>
@endpush
@section('title')
{{$title}}
@endsection
<div class="dashboard-wrapper">
    <div class="container-fluid dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">{{$title}}</h2>

                    @if (session('message'))
                    <x-alert :type="session('type')"
                        :message="session('message')"></x-alert>
                    @endif

                    <div class="page-breadcrumb"
                        wire:ignore
                        wire:key="breadcrumbs">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <x-tabuna-breadcrumbs class="breadcrumb-item"
                                    active="active" />
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- basic table  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                @if (Auth::user()->isAbleTo('users-create'))
                <button wire:click="$emit('createUser')"
                    class="btn btn-primary btn-sm mb-3">Create User</button>
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="row form-inline">
                            <div class="col">
                                <div class="mr-0 ml-auto">
                                    <select wire:model="paginate"
                                        class="form-control form-control-sm mr-1"
                                        style="width: 50px;">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                    </select>
                                    <input wire:model="search"
                                        type="text"
                                        class="form-control form-control-sm"
                                        placeholder="Search"
                                        style="width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-3">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Created at</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users)
                                    @foreach ($users as $user)
                                    <tr class="{{Auth::user()->id == $user->id ? 'table-info' : ''}}">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ date_format($user->created_at, 'd F Y H:i:s') }}</td>
                                        <td>
                                            @if (Auth::user()->hasRole('superadmin') &&
                                            Auth::user()->isAbleTo('users-update'))
                                            <div class="btn-group">
                                                <a class="btn btn-warning btn-sm text-dark"
                                                    wire:click="editUser({{$user->id}})"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm text-white"
                                                    wire:click="deleteUser({{$user->id}})"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                            @elseif (!Auth::user()->hasRole('superadmin') &&
                                            Auth::user()->isAbleTo('users-update') && Auth::user()->id == $user->id)
                                            <div class="btn-group">
                                                <a class="btn btn-warning btn-sm text-dark"
                                                    wire:click="editUser({{$user->id}})"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm text-white"
                                                    wire:click="deleteUser({{$user->id}})"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4"
                                            class="text-center">You don’t have permission to access!</td>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>E-mail</th>
                                        <th>Dibuat tgl</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end basic table  -->
            <!-- ============================================================== -->
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    Copyright © 2018 Concept. All rights reserved. Dashboard by <a
                        href="https://colorlib.com/wp/">Colorlib</a>.
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="text-md-right footer-links d-none d-sm-block">
                        <a href="javascript: void(0);">About</a>
                        <a href="javascript: void(0);">Support</a>
                        <a href="javascript: void(0);">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($modalCreate)
    @livewire('admin.user.create')
    @endif

    @if($modalUpdate)
    @livewire('admin.user.update')
    @endif

    @if($modalDelete)
    @livewire('admin.user.delete')
    @endif
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