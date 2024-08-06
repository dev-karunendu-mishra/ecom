<div class="mb-3">
    <label for="seo_title" class="form-label">SEO Title</label>
    <input name="seo_title" type="text"
        value="{{$edit ? old('seo_title', !empty($category) ? $category->seo_title : '') : ''}}"
        class="form-control @error('seo_title') is-invalid @enderror" id="seo_title" placeholder="SEO Title">
    @error('seo_title')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="seo_keyword" class="form-label">SEO Keyword</label>
    <input name="seo_keyword" type="text"
        value="{{$edit ? old('seo_keyword', !empty($category) ? $category->seo_keyword : '') : ''}}"
        class="form-control @error('seo_keyword') is-invalid @enderror" id="seo_keyword" placeholder="SEO Keyword">
    @error('seo_keyword')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="seo_description" class="form-label">SEO Description</label>
    <textarea name="seo_description" class="form-control @error('seo_description') is-invalid @enderror"
        id="seo_description" rows="3"
        placeholder="Sample description">{{$edit ? old('seo_description', !empty($category) ? $category->seo_description : '') : ''}}</textarea>
    @error('seo_description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>