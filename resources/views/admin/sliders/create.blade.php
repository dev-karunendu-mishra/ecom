<x-slot:offtitle>Add New Slider</x-slot>
<x-slot:offcontent>
    @if ($errors->any())
    <!-- <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> -->
    @endif
    <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label text-capitalize">Slider title</label>
            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="sliderTitle"
                placeholder="Slider Title">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sliderSubtitle" class="form-label text-capitalize">Slider SubTitle</label>
            <input name="sub_title" type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sliderSubtitle"
                placeholder="Slider SubTitle">
            @error('sub_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="sliderShopLink" class="form-label text-capitalize">Slider Shop Link</label>
            <input name="shop_link" type="text" class="form-control @error('shop_link') is-invalid @enderror" id="sliderShopLink"
                placeholder="Shop Link">
            @error('shop_link')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label text-capitalize">Slider Image</label>
            <input name="image" class="form-control @error('image') is-invalid @enderror" type="file"
                id="formFileMultiple" />
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3"><button type="submit" class="btn btn-primary">Create Slider</button></div>
    </form>

    </x-slot>