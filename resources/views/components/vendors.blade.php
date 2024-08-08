<div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach($vendors as $vendor)
                    <div class="vendor-item border p-4">
                        <img src="{{asset('storage/' . $vendor->images[0]->path)}}" alt="{{$vendor->name}}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>