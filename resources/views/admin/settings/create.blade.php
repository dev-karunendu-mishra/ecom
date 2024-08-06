<x-admin-app-layout>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form class="" method="POST"
        action="{{ !empty($settings) ? route('admin.settings.update', $settings->id) : route('admin.settings.store') }}"
        enctype="multipart/form-data">
        @csrf
        @if($settings)
        @method('put')
        @endif

        <div class="row mb-3">
            <div class="col">
                <div>
                    <label for="logo" class="form-label text-capitalize">Website Logo</label>
                    <input name="logo" class="form-control @error('logo') is-invalid @enderror" type="file"
                        id="formFileMultiple" />
                    @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="icon" class="form-label text-capitalize">Website Icon</label>
                    <input name="icon" class="form-control @error('icon') is-invalid @enderror" type="file"
                        id="formFileMultiple" />
                    @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div>
                    <label for="title" class="form-label text-capitalize">Website Title</label>
                    <input name="title" type="text" value="{{old('title', !empty($settings) ? $settings->title : '')}}"
                        class="form-control @error('title') is-invalid @enderror" id="title"
                        placeholder="Website Title">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="description" class="form-label text-capitalize">Website Description</label>
                    <input name="description" type="text"
                        value="{{old('description', !empty($settings) ? $settings->description : '')}}"
                        class="form-control @error('description') is-invalid @enderror" id="description"
                        placeholder="Website Description">
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div>
                    <label for="domain" class="form-label text-capitalize">Website Domain</label>
                    <input name="domain" type="text"
                        value="{{old('domain', !empty($settings) ? $settings->domain : '')}}"
                        class="form-control @error('domain') is-invalid @enderror" id="domain" placeholder="Domain">
                    @error('domain')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="address" class="form-label text-capitalize">Address</label>
                    <input name="address" type="text"
                        value="{{old('address', !empty($settings) ? $settings->address : '')}}"
                        class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address">
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div>
                    <label for="mobile" class="form-label text-capitalize">Mobile</label>
                    <input name="mobile" type="text"
                        value="{{old('mobile', !empty($settings) ? $settings->mobile : '')}}"
                        class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Mobile">
                    @error('mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="email" class="form-label text-capitalize">Email</label>
                    <input name="email" type="text" value="{{old('email', !empty($settings) ? $settings->email : '')}}"
                        class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div>
                    <label for="facebook" class="form-label text-capitalize">Facebook</label>
                    <input name="facebook" type="text"
                        value="{{old('facebook', !empty($settings) ? $settings->facebook : '')}}"
                        class="form-control @error('facebook') is-invalid @enderror" id="facebook"
                        placeholder="Facebook">
                    @error('facebook')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="twitter" class="form-label text-capitalize">Twitter</label>
                    <input name="twitter" type="text"
                        value="{{old('twitter', !empty($settings) ? $settings->twitter : '')}}"
                        class="form-control @error('twitter') is-invalid @enderror" id="twitter" placeholder="Twitter">
                    @error('twitter')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div>
                    <label for="linkedin" class="form-label text-capitalize">LinkedIn</label>
                    <input name="linkedin" type="text"
                        value="{{old('linkedin', !empty($settings) ? $settings->linkedin : '')}}"
                        class="form-control @error('linkedin') is-invalid @enderror" id="linkedin"
                        placeholder="LinkedIn">
                    @error('linkedin')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div>
                    <label for="instagram" class="form-label text-capitalize">Instagram</label>
                    <input name="instagram" type="text"
                        value="{{old('instagram', !empty($settings) ? $settings->instagram : '')}}"
                        class="form-control @error('instagram') is-invalid @enderror" id="instagram"
                        placeholder="Instagram">
                    @error('instagram')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <div>
                    <label for="youtube" class="form-label text-capitalize">Youtube</label>
                    <input name="youtube" type="text"
                        value="{{old('youtube', !empty($settings) ? $settings->youtube : '')}}"
                        class="form-control @error('youtube') is-invalid @enderror" id="youtube" placeholder="Youtube">
                    @error('youtube')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>






        <!-- <div >
            <label for="pageDescription" class="form-label text-capitalize">Page description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                id="categoryDescription" rows="3"
                placeholder="Page description">{{old('description', !empty($settings) ? $settings->description : '')}}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div >
            <label for="pageURL" class="form-label text-capitalize">Page URL</label>
            <input name="url" type="text" value="{{old('url', !empty($settings) ? $settings->url : '')}}"
                class="form-control @error('url') is-invalid @enderror" id="pageURL" placeholder="Page URL">
            @error('url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->
        <!-- <div >
            <label for="parentCategory" class="form-label text-capitalize">Parent Category</label>
            <select name="parent_category_id" id="parentCategory" class="form-select"
                aria-label="Select parent category">
                <option selected value="{{null}}">Select Parent Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div> -->
        <!-- <div >
            <label for="formFileMultiple" class="form-label text-capitalize">Multiple files input example</label>
            <input name="image" class="form-control @error('image') is-invalid @enderror" type="file"
                id="formFileMultiple" />
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->
        <div class="mb-3 d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-success">{{$edit ? 'Update Setting' :
                'Create Setting'}}</button>
        </div>
    </form>
</x-admin-app-layout>