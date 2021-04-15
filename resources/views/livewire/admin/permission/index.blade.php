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

                <button wire:click="$emit('createPermission')"
                    class="btn btn-primary btn-sm mb-3">Create Permission</button>

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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Display Name</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($permissions)
                                    @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->display_name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-warning btn-sm text-dark"
                                                    wire:click="editPermission({{$permission->id}})"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm text-white"
                                                    wire:click="deletePermission({{$permission->id}})"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
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
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Nama Tampilan</th>
                                        <th width="10%"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        {{ $permissions->links() }}
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
    @livewire('admin.permission.create')
    @endif

    @if($modalUpdate)
    @livewire('admin.permission.update')
    @endif

    @if($modalDelete)
    @livewire('admin.permission.delete')
    @endif

    <!-- ============================================================== -->
    <!-- end footer -->
    <!-- ============================================================== -->
</div>