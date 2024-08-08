<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            @foreach($columns as $key=>$column)
            <th>{{$column}}</th>
            @endforeach
            @if($enableActionColumn)
            <th></th>
            @endif

        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)

        <tr>
            @foreach($columns as $key=>$column)
            @switch($key)
            @case('email')
            <td><a href="mailto:{{$record->$key}}">{{$record->$key}}</a></td>
            @break
            @case('images')
            <td><img src="{{asset('storage/' . $record->$key[0]->path)}}" class="img-thumbnail" alt="{{$record->$key[0]->path}}" height="75" width="75"/></td>
            @break
            @case('parent')
            <td>{{!empty($record->$key) ? $record->$key->name : 'NA'}}</td>
            @break
            @case('category_id')
            <td>{{!empty($record->category) ? $record->category->name : 'NA'}}</td>
            @break
            @case('brand_id')
            <td>{{!empty($record->brand) ? $record->brand->name : 'NA'}}</td>
            @break
            @default
             <td>{{$record->$key}}</td>
            @endswitch
            
            @endforeach


            @if($enableActionColumn)
            <td class="text-center">
                <form action='{{ route("admin.$model.destroy", $record->id) }}' method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group" role="group">
                        <a href='{{url("/admin/$model/".$record->id."/edit")}}' class="btn btn-warning btn-sm"><span
                                class="ti ti-edit fs-4"></span></a>
                        <button class="btn btn-danger btn-sm" type="submit"><span
                                class="ti ti-trash fs-4"></span></button>
                    </div>
                </form>
            </td>
            @endif

            
        </tr>
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            @foreach($columns as $column)
            <th>{{$column}}</th>
            @endforeach
            @if($enableActionColumn)
            <th></th>
            @endif
        </tr>
    </tfoot>
</table>

<script src="/template-resources/admin/assets/js/dt-table.js"></script>