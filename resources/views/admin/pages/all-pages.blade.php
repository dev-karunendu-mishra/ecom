<x-admin-app-layout>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pages</li>
        </ol>
    </nav>
    <hr />

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link {{!$errors->any() ? 'active' : ''}}" id="nav-home-tab" data-bs-toggle="tab"
                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All
                Pages</button>
            <button class="nav-link {{$errors->any() ? 'active' : ''}}" id="nav-profile-tab" data-bs-toggle="tab"
                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                aria-selected="false">Add New Page</button>
        </div>
    </nav>
    <div class="tab-content border border-top-0 rounded-bottom-1" id="nav-tabContent">
        <div class="tab-pane fade p-2 {{!$errors->any() ? 'active show' : ''}}" id="nav-home" role="tabpanel"
            aria-labelledby="nav-home-tab" tabindex="0">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Page URL</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->description}}</td>
                        <td>{{$page->url}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>


                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('/admin/pages/'.$page->id.'/edit')}}"
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>Page URL</th>
                        <th>Created At</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="tab-pane fade p-2 {{$errors->any() ? ' active show' : '' }}" id="nav-profile" role="tabpanel"
            aria-labelledby="nav-profile-tab" tabindex="0">
            @include('admin.pages.create')
        </div>

    </div>







    <script src="/template-resources/admin/assets/js/dt-table.js"></script>
</x-admin-app-layout>