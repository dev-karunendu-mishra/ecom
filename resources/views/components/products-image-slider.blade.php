<div id="product-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner border">
        @foreach($images as $image)
        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
            <img class="w-100 h-100" src="{{ asset('storage/' . $image->path) }}" alt="Image">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
        <i class="fa fa-2x fa-angle-left text-dark"></i>
    </a>
    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
        <i class="fa fa-2x fa-angle-right text-dark"></i>
    </a>
</div>