
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    @if($siteData && $siteData->facebook)
                        <a href="{{$siteData->facebook}}" target="__blank" class="text-dark px-2">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif


                    @if($siteData && $siteData->twitter)
                    <a href="{{$siteData->twitter}}" target="__blank" class="text-dark px-2">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif

                    @if($siteData && $siteData->linkedin)
                    <a href="{{$siteData->linkedin}}" target="__blank" class="text-dark px-2">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    @endif

                    @if($siteData && $siteData->instagram)
                    <a href="{{$siteData->instagram}}" target="__blank"  class="text-dark px-2">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif

                    @if($siteData && $siteData->youtube)
                    <a href="{{$siteData->youtube}}" target="__blank" class="text-dark pl-2">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    @if($siteData)
                    <img src="{{ asset('storage/' . $siteData->logo) }}" height="100"/>
                    @else
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1> 
                    @endif
                    
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="/cart" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>