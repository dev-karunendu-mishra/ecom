<x-admin-app-layout>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
    <hr />



    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link {{!$errors->any() ? 'active' : ''}}" id="nav-home-tab" data-bs-toggle="tab"
                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All
                Categories</button>
            <button class="nav-link {{$errors->any() ? 'active' : ''}}" id="nav-profile-tab" data-bs-toggle="tab"
                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                aria-selected="false">Add New Category</button>
        </div>
    </nav>
    <div class="tab-content border border-top-0 rounded-bottom-1" id="nav-tabContent">
        <div class="tab-pane fade p-2 {{!$errors->any() ? 'active show' : ''}}" id="nav-home" role="tabpanel"
            aria-labelledby="nav-home-tab" tabindex="0">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Description</th>
                        <th>Category Image</th>
                        <th>URL</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->parent_category_id}}</td>
                        <td>{{$category->description}}</td>
                        <td>{{$category->images[0]->path}}</td>
                        <td>{{$category->url}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>


                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/categories/'.$category->id.'/edit')}}"
                                        class="btn btn-warning btn-sm"><span class="ti ti-edit fs-4"></span></a>
                                    <button class="btn btn-danger btn-sm" type="submit"><span
                                            class="ti ti-trash fs-4"></span></button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Parent</th>
                        <th>Description</th>
                        <th>Category Image</th>
                        <th>URL</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="tab-pane fade p-2 {{$errors->any() ? ' active show' : '' }}" id="nav-profile" role="tabpanel"
            aria-labelledby="nav-profile-tab" tabindex="0">
            @include('admin.category.create')
        </div>
    </div>

    <script src="/template-resources/admin/assets/js/dt-table.js"></script>
</x-admin-app-layout>