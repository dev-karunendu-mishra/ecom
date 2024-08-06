<x-admin-app-layout>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="d-flex justify-content-end">
        <x-offcanvas-open-button buttonText="Add Slider" />
    </div>
    <hr />

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>SubTitle</th>
                <th>ShopLink</th>
                <th>Slider Image</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td>{{$slider->id}}</td>
                <td>{{$slider->title}}</td>
                <td>{{$slider->sub_title}}</td>
                <td>{{$slider->shop_link}}</td>
                <td>{{$slider->image}}</td>
                <td>{{$slider->created_at}}</td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>SubTitle</th>
                <th>ShopLink</th>
                <th>Slider Image</th>
                <th>Created At</th>
            </tr>
        </tfoot>
    </table>

    @include('admin.sliders.create')

    <script src="/template-resources/admin/assets/js/dt-table.js"></script>
</x-admin-app-layout>