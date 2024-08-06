<form class="" method="POST"
    action="{{ $edit ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if($edit)
    @method('put')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label text-capitalize">Product Name</label>
        <input name="name" type="text" value="{{$edit ? old('name', !empty($product) ? $product->name : '') : ''}}"
            class="form-control @error('name') is-invalid @enderror" id="pageTitle" placeholder="Product Name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="pageDescription" class="form-label text-capitalize">Product description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
            id="categoryDescription" rows="3"
            placeholder="Product description">
            {{$edit ? old('description', !empty($product) ? $product->description : '') : ''}}
        </textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <!-- <div class="mb-3">
        <label for="pageURL" class="form-label text-capitalize">Page URL</label>
        <input name="url" type="text" value="{{$edit ? old('url', !empty($product) ? $product->url : '') : ''}}"
            class="form-control @error('url') is-invalid @enderror" id="pageURL" placeholder="Page URL">
        @error('url')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div> -->
    <div class="mb-3">
        <label for="parentCategory" class="form-label text-capitalize">Product Category</label>
        <select name="category_id" id="parentCategory" class="form-select @error('category_id') is-invalid @enderror"
            aria-label="Select Product category">
            <option selected value="{{null}}">Select Product Category</option>
            @foreach($categories as $category)
            <option selected="{{!empty($product) && $product->category_id === $category->id ? true : false}}"
                value="{{$category->id}}">
                {{$category->name}}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="brand" class="form-label text-capitalize">Product Brand</label>
        <select name="brand_id" id="brand" class="form-select @error('brand_id') is-invalid @enderror"
            aria-label="Select Product Brand">
            <option selected value="{{null}}">Select Product Brand</option>
            @foreach($brands as $brand)
            <option selected="{{!empty($product) && $product->brand_id === $brand->id ? true : false}}"
                value="{{$brand->id}}">
                {{$brand->name}}</option>
            @endforeach
        </select>
        @error('brand_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label text-capitalize">Product Price</label>
        <input name="price" type="text" value="{{$edit ? old('price', !empty($product) ? $product->price : '') : ''}}"
            class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Product Price">
        @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="formFileMultiple" class="form-label text-capitalize">Product Image</label>
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
        <a href="{{route('admin.products')}}" class="btn btn-primary">Back</a>
        @endif
        <button type="submit" class="btn btn-success">{{$edit ? 'Update Product' :
            'Create Product'}}</button>
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