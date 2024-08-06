@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<form method="POST"
    action="{{ $edit ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
    enctype="multipart/form-data">
    @csrf
    @if($edit)
    @method('put')
    @endif


    <div class="row">
        <div class="col-md-3 text-center">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                    <img data-src="" src="{{ asset('storage/' . $category->images[0]->path) }}" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists img-thumbnail"
                    style="max-width: 200px; max-height: 150px;">
                </div>
                <div>
                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                            image</span><span class="fileinput-exists">Change</span><input type="file"
                            name="..."></span>
                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="mb-3">
                <label for="categoryName" class="form-label text-capitalize">Category name</label>
                <input name="name" type="text"
                    value="{{$edit ? old('name', !empty($category) ? $category->name : '') : ''}}"
                    class="form-control @error('name') is-invalid @enderror" id="categoryName"
                    placeholder="Sample category">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="form-label text-capitalize">Category description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                    id="categoryDescription" rows="3"
                    placeholder="Sample description">{{$edit ? old('description', !empty($category) ? $category->description : '') : ''}}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="parentCategory" class="form-label text-capitalize">Parent Category</label>
                        <select name="parent_id" id="parentCategory" class="form-select"
                            aria-label="Select parent category">
                            <option selected value="{{null}}">Select Parent Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="url" class="form-label text-capitalize">Category URL</label>
                        <input name="url" type="text"
                            value="{{$edit ? old('url', !empty($category) ? $category->url : '') : ''}}"
                            class="form-control @error('url') is-invalid @enderror" id="url" placeholder="Category URL">
                        @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>




            <div class="mb-3">
                <label for="formFileMultiple" class="form-label text-capitalize">Category Image</label>
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
                    class="form-control @error('seo_title') is-invalid @enderror" id="seo_title"
                    placeholder="SEO Title">
                @error('seo_title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="seo_keywords" class="form-label text-capitalize">SEO Keyword</label>
                <input name="seo_keywords" type="text"
                    value="{{$edit ? old('seo_keywords', !empty($category) ? $category->seo_keywords : '') : ''}}"
                    class="form-control @error('seo_keywords') is-invalid @enderror" id="seo_keywords"
                    placeholder="SEO Keyword">
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
        </div>
    </div>






    <div class="mb-3  d-flex justify-content-end gap-2">
        @if($edit)
        <a href="{{route('admin.categories')}}" class="btn btn-primary">Back</a>
        @endif
        <button type="submit" class="btn btn-success">{{$edit ? 'Update
            Category' :
            'Create Category'}}</button>
    </div>
</form>