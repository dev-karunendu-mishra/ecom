<form class="" method="POST" action="{{ $edit ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if($edit)
    @method('put')
    @endif
    <div class="mb-3">
        <label for="pageTitle" class="form-label text-capitalize">Page title</label>
        <input name="title" type="text" value="{{$edit ? old('title', !empty($page) ? $page->title : '') : ''}}"
            class="form-control @error('title') is-invalid @enderror" id="pageTitle" placeholder="Page Title">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="pageDescription" class="form-label text-capitalize">Page description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
            id="categoryDescription" rows="3"
            placeholder="Page description">{{$edit ? old('description', !empty($page) ? $page->description : '') : ''}}</textarea>
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
        <label for="pageURL" class="form-label text-capitalize">Page URL</label>
        <input name="url" type="text" value="{{$edit ? old('url', !empty($page) ? $page->url : '') : ''}}"
            class="form-control @error('url') is-invalid @enderror" id="pageURL" placeholder="Page URL">
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
    <!-- <div class="mb-3">
            <label for="formFileMultiple" class="form-label text-capitalize">Multiple files input example</label>
            <input name="image" class="form-control @error('image') is-invalid @enderror" type="file"
                id="formFileMultiple" />
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->

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
        <a href="{{route('admin.pages')}}" class="btn btn-primary">Back</a>
        @endif
        <button type="submit" class="btn btn-success">{{$edit ? 'Update Page' :
            'Create Page'}}</button>
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