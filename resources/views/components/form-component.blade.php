<div>
    <form method="POST" action="{{ $isEditing ? $editRoute : $actionRoute }}" enctype="multipart/form-data">
        @csrf
        @if($isEditing)
        @method('put')
        @endif
        @foreach($fields as $index=>$field)


        @php
        $fieldName = $field['name'];
        $value = '';
        @endphp

        @if($model)
        @if (is_array($model->$fieldName))
        @php
        // Replace 'specific_key' with the actual key you need
        $value = $model->$fieldName['specific_key'] ?? 'Default Value';
        @endphp
        @else
        @php
        $value = $model->$fieldName;
        @endphp
        @endif
        @endif


        <div class="mb-3">
            <label for="{{$field['id']}}" class="form-label text-capitalize">{{$field['label']}}</label>
            @switch($field['type'])
            @case('textarea')
            <textarea id="{{$field['id']}}" name="{{$field['name']}}"
                class="form-control @error('description') is-invalid @enderror editor-area" rows="3"
                placeholder="{{$field['placeholder']}}">{{$isEditing ? old($field['name'], !empty($model) ? $value : '') : ''}}</textarea>
            @break


            @case('file')
            <input id="{{$field['id']}}" name="{{$field['name']}}"
                class="form-control @error($field['name']) is-invalid @enderror" type="file" />
            @break

            @case('select')
            <select id="{{$field['id']}}" name="{{$field['name']}}"
                class="form-select @error($field['name']) is-invalid @enderror" aria-label="{{$field['name']}}">
                <option value="{{null}}">{{$field['placeholder']}}</option>
                @foreach($field['options'] as $option)
                @if(!empty($model) && $model->id === $option->id)
                <option selected value="{{$option->id}}">{{$option->name}}</option>
                @else
                <option value="{{$option->id}}">{{$option->name}}</option>
                @endif

                @endforeach
            </select>
            @break

            @case('switch')
            <div class="form-check form-switch">
                @if($value)
                <input id="{{$field['id']}}" name="{{$field['name']}}"
                    class="form-check-input @error($field['name']) is-invalid @enderror" type="checkbox" role="switch"
                    checked aria-checked="true" />
                @else
                <input id=" {{$field['id']}}" name="{{$field['name']}}"
                    class="form-check-input @error($field['name']) is-invalid @enderror" type="checkbox" role="switch"
                    aria-checked="false">
                @endif

                <label class="form-check-label" for="{{$field['id']}}">{{$field['label']}}</label>
            </div>
            @break

            @case('radio')
            @break

            @case('radio-group')
            @break

            @case('checkbox')
            @break

            @case('checkbox-group')
            @break



            @default
            <input id="{{$field['id']}}" name="{{$field['name']}}" type="text"
                value="{{$isEditing ? old($field['name'], !empty($model) ? $value : '') : ''}}"
                class="form-control @error($field['name']) is-invalid @enderror"
                placeholder="{{$field['placeholder']}}">
            @endswitch
            @error($field['name'])
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endforeach


        @if($isSEOEnabled)
        <!-- SEO Section -->
        <div class="mb-3">
            <label for="seo_title" class="form-label text-capitalize">SEO Title</label>
            <input name="seo_title" type="text"
                value="{{$isEditing ? old('seo_title', !empty($category) ? $category->seo_title : '') : ''}}"
                class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" placeholder="SEO Title">
            @error('seo_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="seo_keywords" class="form-label text-capitalize">SEO Keyword</label>
            <input name="seo_keywords" type="text"
                value="{{$isEditing ? old('seo_keywords', !empty($category) ? $category->seo_keywords : '') : ''}}"
                class="form-control @error('seo_keywords') is-invalid @enderror" id="seo_keywords"
                placeholder="SEO Keyword">
            @error('seo_keywords')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="seo_description" class="form-label text-capitalize">SEO Description</label>
            <textarea name="seo_description"
                class="form-control editor-area @error('seo_description') is-invalid @enderror" id="seo_description"
                rows="3"
                placeholder="">{{$isEditing ? old('seo_description', !empty($category) ? $category->seo_description : '') : ''}}</textarea>
            @error('seo_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endif
        <div class="mb-3  d-flex justify-content-end gap-2">
            @if($isEditing)
            <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
            @endif
            <button type="submit" class="btn btn-success">{{$isEditing ? $updateBtnText : $submitBtnText}}</button>
        </div>

    </form>
</div>