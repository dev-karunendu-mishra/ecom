<form class="" method="POST"
    action="{{ $edit ? route('admin.brands.update', $brand->id) : route('admin.brands.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if($edit)
    @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label text-capitalize">Brand Name</label>
        <input name="name" type="text" value="{{$edit ? old('name', !empty($brand) ? $brand->name : '') : ''}}"
            class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Brand Name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="brandDescription" class="form-label text-capitalize">Brand Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
            id="brandDescription" rows="3"
            placeholder="Brand Description">{{$edit ? old('description', !empty($brand) ? $brand->description : '') : ''}}</textarea>
        <!-- <div id="editor">
            <p>Hello World!</p>
            <p>Some initial <strong>bold</strong> text</p>
            <p><br /></p>
        </div> -->
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="url" class="form-label text-capitalize">Brand URL</label>
        <input name="url" type="text" value="{{$edit ? old('url', !empty($brand) ? $brand->url : '') : ''}}"
            class="form-control @error('url') is-invalid @enderror" id="url" placeholder="Brand URL">
        @error('url')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- <div class="mb-3">
            <label for="parentCategory" class="form-label text-capitalize">Parent Category</label>
            <select name="parent_category_id" id="parentCategory" class="form-select"
                aria-label="Select parent category">
                <option selected value="{{null}}">Select Parent Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div> -->
    <div class="mb-3">
        <label for="formFileMultiple" class="form-label text-capitalize">Brand Image</label>
        <input name="image" class="form-control @error('image') is-invalid @enderror" type="file"
            id="formFileMultiple" />
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- SEO Section -->
    <div class="mb-3">
        <label for="seo_title" class="form-label text-capitalize">SEO Title</label>
        <input name="seo_title" type="text"
            value="{{$edit ? old('seo_title', !empty($category) ? $category->seo_title : '') : ''}}"
            class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" placeholder="SEO Title">
        @error('seo_title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="seo_keywords" class="form-label text-capitalize">SEO Keyword</label>
        <input name="seo_keywords" type="text"
            value="{{$edit ? old('seo_keywords', !empty($category) ? $category->seo_keywords : '') : ''}}"
            class="form-control @error('seo_keywords') is-invalid @enderror" id="seo_keywords" placeholder="SEO Keyword">
        @error('seo_keywords')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="seo_description" class="form-label text-capitalize">SEO Description</label>
        <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror"
            id="seo_description" rows="3"
            placeholder="">{{$edit ? old('seo_description', !empty($category) ? $category->seo_description : '') : ''}}</textarea>
        @error('seo_description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3 d-flex justify-content-end gap-2">
        @if($edit)
        <a href="{{route('admin.brands')}}" class="btn btn-primary">Back</a>
        @endif
        <button type="submit" class="btn btn-success">{{$edit ? 'Update Brand' :
            'Create Brand'}}</button>
    </div>
</form>
<!-- Initialize Quill editor -->
<!-- <script>
    $(document).ready(function () {
        const quill = new Quill('#editor', {
            theme: 'snow'
        });
    })
</script> -->