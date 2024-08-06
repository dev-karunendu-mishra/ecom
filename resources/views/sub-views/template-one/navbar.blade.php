<div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        @forelse($categories as $category)
                         <a href="/categories/{{$category->url}}" class="nav-item nav-link">{{$category->name}}</a>
                        @empty
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">Dresses <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="" class="dropdown-item">Men's Dresses</a>
                                <a href="" class="dropdown-item">Women's Dresses</a>
                                <a href="" class="dropdown-item">Baby's Dresses</a>
                            </div>
                        </div>
                        <a href="" class="nav-item nav-link">Shirts</a>
                        <a href="" class="nav-item nav-link">Jeans</a>
                        <a href="" class="nav-item nav-link">Swimwear</a>
                        <a href="" class="nav-item nav-link">Sleepwear</a>
                        <a href="" class="nav-item nav-link">Sportswear</a>
                        <a href="" class="nav-item nav-link">Jumpsuits</a>
                        <a href="" class="nav-item nav-link">Blazers</a>
                        <a href="" class="nav-item nav-link">Jackets</a>
                        <a href="" class="nav-item nav-link">Shoes</a>
                        @endforelse
                        
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="/" class="text-decoration-none d-block d-lg-none">
                        @if($siteData)
                        <img src="{{ asset('storage/' . $siteData->logo) }}" height="100"/>
                        @else
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                        @endif
                        
                        
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            @foreach($pages as $page)
                             <a href="/{{$page->url}}" class="nav-item nav-link">{{$page->title}}</a>
                            @endforeach
                            <a href="/shop" class="nav-item nav-link">Shop</a>
                            <a href="/product-details" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="/cart" class="dropdown-item">Shopping Cart</a>
                                    <a href="/checkout" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="/contact" class="nav-item nav-link">Contact</a>
                        </div>
                        @if (Route::has('login'))
                        <div class="navbar-nav ml-auto py-0">
                             @auth
                             <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Dashboard</a>
                             @else
                                <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                                @endif
                             @endauth 
                        </div>
                        @endif
                    </div>
                </nav>
               <x-slider :sliders='$sliders'/>
            </div>
        </div>
    </div>