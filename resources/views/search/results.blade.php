<div class="container">
    <h3>Результаты поиска: "{{ $query ?? '' }}"</h3>

    @if(isset($message))
        <div class="alert alert-info">{{ $message }}</div>
    @else
        <!-- Камеры -->
        @if(!empty($results['cameras']) && $results['cameras']->count())
            <h4>Камеры</h4>
            <div class="row">
                @foreach($results['cameras'] as $camera)
                <div class="product-modal-sm modal fade" id="producQuickViewModal-{{ $camera->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="product-modal">
                                                    <div class="product-modal-wrapper p-relative">
                                                        <button type="button" class="close product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fal fa-times"></i>
                                                        </button>
                                                        <div class="modal__inner">
                                                            <div class="bd__shop-details-inner">
                                                                <div class="row">
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-thumb-wrapper d-sm-flex align-items-start">
                                                                        <div class="product__details-thumb-tab mr-20">
                                                                            <nav>
                                                                            <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                                                                <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                                                                    aria-selected="true">
                                                                                        @if($camera->image)
                                                                                            <img src="{{ asset('storage/' . $camera->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-2" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($camera->image)
                                                                                            <img src="{{ asset('storage/' . $camera->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-3" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($camera->image)
                                                                                            <img src="{{ asset('storage/' . $camera->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                            </div>
                                                                            </nav>
                                                                        </div>
                                                                        <div class="product__details-thumb-tab-content">
                                                                            <div class="tab-content" id="productthumbcontent">
                                                                            <div class="tab-pane fade show active" id="img-1" role="tabpanel"
                                                                                aria-labelledby="img-1-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($camera->image)
                                                                                        <img src="{{ asset('storage/' . $camera->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-2" role="tabpanel"
                                                                                aria-labelledby="img-2-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($camera->image)
                                                                                        <img src="{{ asset('storage/' . $camera->image) }}" width="50" height="50" alt="{{ $camera->name }}">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-3" role="tabpanel"
                                                                                aria-labelledby="img-3-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($camera->image)
                                                                                        <img src="{{ asset('storage/' . $camera->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-content">
                                                                        <h3 class="product__details-title">{{ $camera->name_camera }}</h3>
                                                                        <div class="product__details-meta mb-20">
                                                                            <div class="sku">
                                                                                <p><span>Производитель:</span> {{ $camera->firm->Фирма }}</p>
                                                                            </div>
                                                                            <div class="categories">
                                                                                <p><span>Модель:</span> {{ $camera->model }}</p> 
                                                                            </div>
                                                                            <div class="tag">
                                                                                <p><span>Серийный номер:</span> {{ $camera->serial_namber }}</p> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="product__details-price">
                                                                            
                                                                            <span class="new-price">{{ $camera->price }} BYN</span>
                                                                        </div>
                                                                        

                                                                        <div class="product__details-action mb-35">
                                                                            <div class="product__quantity">
                                                                                <div class="product-quantity-wrapper">
                                                                                    <button type="button" class="cart-minus"><i class="fa-solid fa-minus"></i></button>
                                                                                    <input class="cart-input" type="text" name="quantity" value="1" min="1">
                                                                                    <button type="button" class="cart-plus"><i class="fa-solid fa-plus"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="product__add-cart">
                                                                                @if($camera-> quantity > 0)
                                                                                    <form action="{{ route('cart.cart.create') }}" method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="camera_id" value="{{ $camera->id }}">
                                                                                        <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                                                        <button type="submit" class="fill-btn cart-btn">
                                                                                            <span class="fill-btn-inner">
                                                                                                <span class="fill-btn-normal">Добавить в корзину <i class="fa-solid fa-basket-shopping"></i></span>
                                                                                            </span>
                                                                                        </button>
                                                                                    </form>
                                                                                @else
                                                                                    <button class="fill-btn cart-btn disabled" disabled>
                                                                                        <span class="fill-btn-inner">
                                                                                            <span class="fill-btn-normal">Нет в наличии</span>
                                                                                        </span>
                                                                                    </button>
                                                                                @endif
                                                                            </div>
                                                                            <div class="product__add-wish">
                                                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="camera_id" value="{{ $camera->id }}">
                                                                                    <button type="submit" class="product__add-wish-btn">
                                                                                        <i class="fa-solid fa-heart"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6" style="margin-top: 75px; margin-bottom: 75px;">
                                            
                                            <div class="product-item">
                                                <div class="product-thumb">
                                                    @if($camera->image)
                                                        <img src="{{ asset('storage/' . $camera->image) }}" width="50" height="50" alt="">
                                                    @else
                                                        <span>Нет фото</span>
                                                    @endif
                                                </div>
                                                <div class="product-action-item">
                                                    @if($camera->quantity>0)
                                                        <form action="{{ route ('cart.cart.create') }}" method="POST">
                                                            <input type="hidden" name="camera_id" value="{{ $camera->id }}">
                                                            <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                            <button type="submit" class="product-action-btn">
                                                                @csrf
                                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                                        stroke="white" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                                <span class="product-tooltip">Добавить в корзину</span>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="submit" class="product-action-btn" disabled>
                                                            @csrf
                                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                            <span class="product-tooltip">Нет в наличии</span>
                                                        </button>   
                                                    @endif    
                                                

                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="camera_id" value="{{ $camera->id }}">
                                                    <button type="submit" class="product-action-btn">

                                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                                fill="white" />
                                                        </svg>
                                                        <span class="product-tooltip">Добавить в избранное</span>
                                                    </button>
                                                </form>
                                                
                                                </div>
                                                <div class="product-content">
                                                <div class="product-tag">
                                                    <span>{{ $camera->firm->Фирма }}</span>
                                                </div>
                                                <h4 class="product-title"><a href="{{ route('video.descriptioncamera', $camera->id) }}">{{ $camera->name_camera }}</a>
                                                </h4>
                                                <div class="product-price">
                                                    
                                                    <span class="product-new-price">{{ $camera->price }} BYN</span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                @endforeach
            </div>
        @endif

        <!-- Турникеты -->
        @if(!empty($results['turnikets']) && $results['turnikets']->count())
            <h2>Турникеты</h2>
            <div class="row">
                @foreach($results['turnikets'] as $turniket)
                <div class="product-modal-sm modal fade" id="producQuickViewModal-{{ $turniket->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="product-modal">
                                                    <div class="product-modal-wrapper p-relative">
                                                        <button type="button" class="close product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fal fa-times"></i>
                                                        </button>
                                                        <div class="modal__inner">
                                                            <div class="bd__shop-details-inner">
                                                                <div class="row">
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-thumb-wrapper d-sm-flex align-items-start">
                                                                        <div class="product__details-thumb-tab mr-20">
                                                                            <nav>
                                                                            <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                                                                <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                                                                    aria-selected="true">
                                                                                        @if($turniket->image)
                                                                                            <img src="{{ asset('storage/' . $turniket->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-2" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($turniket->image)
                                                                                            <img src="{{ asset('storage/' . $turniket->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-3" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($turniket->image)
                                                                                            <img src="{{ asset('storage/' . $turniket->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                            </div>
                                                                            </nav>
                                                                        </div>
                                                                        <div class="product__details-thumb-tab-content">
                                                                            <div class="tab-content" id="productthumbcontent">
                                                                            <div class="tab-pane fade show active" id="img-1" role="tabpanel"
                                                                                aria-labelledby="img-1-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($turniket->image)
                                                                                        <img src="{{ asset('storage/' . $turniket->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-2" role="tabpanel"
                                                                                aria-labelledby="img-2-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($turniket->image)
                                                                                        <img src="{{ asset('storage/' . $turniket->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-3" role="tabpanel"
                                                                                aria-labelledby="img-3-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($turniket->image)
                                                                                        <img src="{{ asset('storage/' . $turniket->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-content">
                                                                        <h3 class="product__details-title">{{ $turniket->name_turniket }}</h3>
                                                                        <div class="product__details-meta mb-20">
                                                                            <div class="sku">
                                                                                <p><span>Производитель:</span> {{ $turniket->firm->Фирма }}</p>
                                                                            </div>
                                                                            <div class="categories">
                                                                                <p><span>Модель:</span> {{ $turniket->model }}</p> 
                                                                            </div>
                                                                            <div class="tag">
                                                                                <p><span>Серийный номер:</span> {{ $turniket->serial_namber }}</p> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="product__details-price">
                                                                            
                                                                            <span class="new-price">{{ $turniket->price }} BYN</span>
                                                                        </div>
                                                                        

                                                                        <div class="product__details-action mb-35">
                                                                            <div class="product__quantity">
                                                                                <div class="product-quantity-wrapper">
                                                                                    <button type="button" class="cart-minus"><i class="fa-solid fa-minus"></i></button>
                                                                                    <input class="cart-input" type="text" name="quantity" value="1" min="1">
                                                                                    <button type="button" class="cart-plus"><i class="fa-solid fa-plus"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="product__add-cart">
                                                                                @if($turniket-> quantity > 0)
                                                                                    <form action="{{ route('cart.cart.create') }}" method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="turniket_id" value="{{ $turniket->id }}">
                                                                                        <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                                                        <button type="submit" class="fill-btn cart-btn">
                                                                                            <span class="fill-btn-inner">
                                                                                                <span class="fill-btn-normal">Добавить в корзину <i class="fa-solid fa-basket-shopping"></i></span>
                                                                                            </span>
                                                                                        </button>
                                                                                    </form>
                                                                                @else
                                                                                    <button class="fill-btn cart-btn disabled" disabled>
                                                                                        <span class="fill-btn-inner">
                                                                                            <span class="fill-btn-normal">Нет в наличии</span>
                                                                                        </span>
                                                                                    </button>
                                                                                @endif
                                                                            </div>
                                                                            <div class="product__add-wish">
                                                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="turniket_id" value="{{ $turniket->id }}">
                                                                                    <button type="submit" class="product__add-wish-btn">
                                                                                        <i class="fa-solid fa-heart"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6" style="margin-top: 75px; margin-bottom: 75px;">
                                            <div class="product-item">
                                                <div class="product-thumb">
                                                    @if($turniket->image)
                                                        <img src="{{ asset('storage/' . $turniket->image) }}" width="50" height="50" alt="">
                                                    @else
                                                        <span>Нет фото</span>
                                                    @endif
                                                </div>
                                                <div class="product-action-item">
                                                    <form action="{{ route ('cart.cart.create') }}" method="POST">
                                                        <input type="hidden" name="turniket_id" value="{{ $turniket->id }}">
                                                        <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                        <button type="submit" class="product-action-btn">
                                                            @csrf
                                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                            <span class="product-tooltip">Добавить в корзину</span>
                                                        </button>
                                                    </form>
                                                

                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="turniket_id" value="{{ $turniket->id }}">
                                                    <button type="submit" class="product-action-btn">

                                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                                fill="white" />
                                                        </svg>
                                                        <span class="product-tooltip">Добавить в избранное</span>
                                                    </button>
                                                </form>
                                                </div>
                                                <div class="product-content">
                                                <div class="product-tag">
                                                    <span>{{ $turniket->firm->Фирма }}</span>
                                                </div>
                                                <h4 class="product-title"><a href="{{ route('turn.descriptionturn', $turniket->id) }}">{{ $turniket->name_turniket }}</a>
                                                </h4>
                                                <div class="product-price">
                                                    
                                                    <span class="product-new-price">{{ $turniket->price }} BYN</span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                @endforeach
            </div>
        @endif

        <!-- Шлагбаумы -->
        @if(!empty($results['barriers']) && $results['barriers']->count())
            <h2>Шлагбаумы</h2>
            <div class="row">
                @foreach($results['barriers'] as $barrier)
                <div class="product-modal-sm modal fade" id="producQuickViewModal-{{ $barrier->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="product-modal">
                                                    <div class="product-modal-wrapper p-relative">
                                                        <button type="button" class="close product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fal fa-times"></i>
                                                        </button>
                                                        <div class="modal__inner">
                                                            <div class="bd__shop-details-inner">
                                                                <div class="row">
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-thumb-wrapper d-sm-flex align-items-start">
                                                                        <div class="product__details-thumb-tab mr-20">
                                                                            <nav>
                                                                            <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                                                                <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                                                                    aria-selected="true">
                                                                                        @if($barrier->image)
                                                                                            <img src="{{ asset('storage/' . $barrier->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-2" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($barrier->image)
                                                                                            <img src="{{ asset('storage/' . $barrier->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-3" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($barrier->image)
                                                                                            <img src="{{ asset('storage/' . $barrier->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                            </div>
                                                                            </nav>
                                                                        </div>
                                                                        <div class="product__details-thumb-tab-content">
                                                                            <div class="tab-content" id="productthumbcontent">
                                                                            <div class="tab-pane fade show active" id="img-1" role="tabpanel"
                                                                                aria-labelledby="img-1-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($barrier->image)
                                                                                        <img src="{{ asset('storage/' . $barrier->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-2" role="tabpanel"
                                                                                aria-labelledby="img-2-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($barrier->image)
                                                                                        <img src="{{ asset('storage/' . $barrier->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-3" role="tabpanel"
                                                                                aria-labelledby="img-3-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($barrier->image)
                                                                                        <img src="{{ asset('storage/' . $barrier->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-content">
                                                                        <h3 class="product__details-title">{{ $barrier->name_barrier }}</h3>
                                                                        <div class="product__details-meta mb-20">
                                                                            <div class="sku">
                                                                                <p><span>Производитель:</span> {{ $barrier->firm->Фирма }}</p>
                                                                            </div>
                                                                            <div class="categories">
                                                                                <p><span>Модель:</span> {{ $barrier->model }}</p> 
                                                                            </div>
                                                                            <div class="tag">
                                                                                <p><span>Серийный номер:</span> {{ $barrier->serial_namber }}</p> 
                                                                            </div>
                                                                        </div>
                                                                        <div class="product__details-price">
                                                                            
                                                                            <span class="new-price">{{ $barrier->price }} BYN</span>
                                                                        </div>
                                                                        

                                                                        <div class="product__details-action mb-35">
                                                                            <div class="product__quantity">
                                                                                <div class="product-quantity-wrapper">
                                                                                    <button type="button" class="cart-minus"><i class="fa-solid fa-minus"></i></button>
                                                                                    <input class="cart-input" type="text" name="quantity" value="1" min="1">
                                                                                    <button type="button" class="cart-plus"><i class="fa-solid fa-plus"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="product__add-cart">
                                                                                @if($barrier -> quantity > 0)
                                                                                    <form action="{{ route('cart.cart.create') }}" method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="barrier_id" value="{{ $barrier->id }}">
                                                                                        <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                                                        <button type="submit" class="fill-btn cart-btn">
                                                                                            <span class="fill-btn-inner">
                                                                                                <span class="fill-btn-normal">Добавить в корзину <i class="fa-solid fa-basket-shopping"></i></span>
                                                                                            </span>
                                                                                        </button>
                                                                                    </form>
                                                                                @else
                                                                                    <button class="fill-btn cart-btn disabled" disabled>
                                                                                        <span class="fill-btn-inner">
                                                                                            <span class="fill-btn-normal">Нет в наличии</span>
                                                                                        </span>
                                                                                    </button>
                                                                                @endif
                                                                            </div>
                                                                            <div class="product__add-wish">
                                                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="barrier_id" value="{{ $barrier->id }}">
                                                                                    <button type="submit" class="product__add-wish-btn">
                                                                                        <i class="fa-solid fa-heart"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6" style="margin-top: 75px; margin-bottom: 75px;">
                                            <div class="product-item">
                                                <div class="product-thumb">
                                                    @if($barrier->image)
                                                        <img src="{{ asset('storage/' . $barrier->image) }}" width="50" height="50" alt="">
                                                    @else
                                                        <span>Нет фото</span>
                                                    @endif
                                                </div>
                                                <div class="product-action-item">
                                                    <form action="{{ route ('cart.cart.create') }}" method="POST">
                                                        <input type="hidden" name="barrier_id" value="{{ $barrier->id }}">
                                                        <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                        <button type="submit" class="product-action-btn">
                                                            @csrf
                                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                            <span class="product-tooltip">Добавить в корзину</span>
                                                        </button>
                                                    </form>
                                                
                                                
                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="barrier_id" value="{{ $barrier->id }}">
                                                    <button type="submit" class="product-action-btn">

                                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                                fill="white" />
                                                        </svg>
                                                        <span class="product-tooltip">Добавить в избранное</span>
                                                    </button>
                                                </form>
                                                </div>
                                                <div class="product-content">
                                                <div class="product-tag">
                                                    <span>{{ $barrier->firm->Фирма }}</span>
                                                </div>
                                                <h4 class="product-title"><a href="{{ route('barrier.descriptionbarrier', $barrier->id) }}">{{ $barrier->name_barrier }}</a>
                                                </h4>
                                                <div class="product-price">
                                                    
                                                    <span class="product-new-price">{{ $barrier->price }} BYN</span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                @endforeach
            </div>
        @endif

        <!-- Аксессуары -->
        @if(!empty($results['accessories']) && $results['accessories']->count())
            <h2>Аксессуары</h2>
            <div class="row">
                @foreach($results['accessories'] as $accessorie)
                <div class="product-modal-sm modal fade" id="producQuickViewModal-{{ $accessorie->id }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="product-modal">
                                                    <div class="product-modal-wrapper p-relative">
                                                        <button type="button" class="close product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fal fa-times"></i>
                                                        </button>
                                                        <div class="modal__inner">
                                                            <div class="bd__shop-details-inner">
                                                                <div class="row">
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-thumb-wrapper d-sm-flex align-items-start">
                                                                        <div class="product__details-thumb-tab mr-20">
                                                                            <nav>
                                                                            <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                                                                <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                                                                    aria-selected="true">
                                                                                        @if($accessorie->image)
                                                                                            <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-2" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($accessorie->image)
                                                                                            <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                                <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#img-3" type="button" role="tab" aria-controls="img-3"
                                                                                    aria-selected="false">
                                                                                        @if($accessorie->image)
                                                                                            <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="">
                                                                                        @else
                                                                                            <span>Нет фото</span>
                                                                                        @endif
                                                                                </button>
                                                                            </div>
                                                                            </nav>
                                                                        </div>
                                                                        <div class="product__details-thumb-tab-content">
                                                                            <div class="tab-content" id="productthumbcontent">
                                                                            <div class="tab-pane fade show active" id="img-1" role="tabpanel"
                                                                                aria-labelledby="img-1-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($accessorie->image)
                                                                                        <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-2" role="tabpanel"
                                                                                aria-labelledby="img-2-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($accessorie->image)
                                                                                        <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane fade" id="img-3" role="tabpanel"
                                                                                aria-labelledby="img-3-tab">
                                                                                <div class="product__details-thumb-big w-img">
                                                                                    @if($accessorie->image)
                                                                                        <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="">
                                                                                    @else
                                                                                        <span>Нет фото</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-lg-6">
                                                                    <div class="product__details-content">
                                                                        <h3 class="product__details-title">{{ $accessorie->name }}</h3>
                                                                        
                                                                        <div class="product__details-price">
                                                                            
                                                                            <span class="new-price">{{ $accessorie->price }}</span>
                                                                        </div>
                                                                        

                                                                        <div class="product__details-action mb-35">
                                                                            <div class="product__quantity">
                                                                                <div class="product-quantity-wrapper">
                                                                                    <button type="button" class="cart-minus"><i class="fa-solid fa-minus"></i></button>
                                                                                    <input class="cart-input" type="text" name="quantity" value="1" min="1">
                                                                                    <button type="button" class="cart-plus"><i class="fa-solid fa-plus"></i></button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="product__add-cart">
                                                                                @if($accessorie-> quantity > 0)
                                                                                    <form action="{{ route('cart.cart.create') }}" method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="accessorie_id" value="{{ $accessorie->id }}">
                                                                                        <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                                                        <button type="submit" class="fill-btn cart-btn">
                                                                                            <span class="fill-btn-inner">
                                                                                                <span class="fill-btn-normal">Добавить в корзину <i class="fa-solid fa-basket-shopping"></i></span>
                                                                                            </span>
                                                                                        </button>
                                                                                    </form>
                                                                                @else
                                                                                    <button class="fill-btn cart-btn disabled" disabled>
                                                                                        <span class="fill-btn-inner">
                                                                                            <span class="fill-btn-normal">Нет в наличии</span>
                                                                                        </span>
                                                                                    </button>
                                                                                @endif
                                                                            </div>
                                                                            <div class="product__add-wish">
                                                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="accessory_id" value="{{ $accessorie->id }}">
                                                                                    <button type="submit" class="product__add-wish-btn">
                                                                                        <i class="fa-solid fa-heart"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6" style="margin-top: 75px; margin-bottom: 75px;">
                                            <div class="product-item">
                                                <div class="product-thumb">
                                                    @if($accessorie->image)
                                                        <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="">
                                                    @else
                                                        <span>Нет фото</span>
                                                    @endif
                                                </div>
                                                <div class="product-action-item">
                                                    <form action="{{ route ('cart.cart.create') }}" method="POST">
                                                        <input type="hidden" name="accessorie_id" value="{{ $accessorie->id }}">
                                                        <input type="hidden" name="quantity" class="cart-hidden-input" value="1">
                                                        <button type="submit" class="product-action-btn">
                                                            @csrf
                                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M13.0768 10.1416C13.0768 11.9228 11.648 13.3666 9.88542 13.3666C8.1228 13.3666 6.69401 11.9228 6.69401 10.1416M1.375 5.84163H18.3958M1.375 5.84163V12.2916C1.375 19.1359 2.57494 20.3541 9.88542 20.3541C17.1959 20.3541 18.3958 19.1359 18.3958 12.2916V5.84163M1.375 5.84163L2.91454 2.73011C3.27495 2.00173 4.01165 1.54163 4.81754 1.54163H14.9533C15.7592 1.54163 16.4959 2.00173 16.8563 2.73011L18.3958 5.84163"
                                                                    stroke="white" stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                            <span class="product-tooltip">Добавить в корзину</span>
                                                        </button>
                                                    </form>
                                                
                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="accessory_id" value="{{ $accessorie->id }}">
                                                    <button type="submit" class="product-action-btn">

                                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.2041 2.63262C18.6402 1.97669 17.932 1.44916 17.1305 1.08804C16.329 0.726918 15.4541 0.54119 14.569 0.544237C13.0545 0.500151 11.58 1.01577 10.4489 1.98501C9.31782 1.01577 7.84334 0.500151 6.32883 0.544237C5.44368 0.54119 4.56885 0.726918 3.76735 1.08804C2.96585 1.44916 2.25764 1.97669 1.69374 2.63262C0.712132 3.77732 -0.314799 5.84986 0.366045 9.22751C1.45272 14.6213 9.60121 19.0476 9.94523 19.2288C10.0986 19.311 10.2713 19.3541 10.4469 19.3541C10.6224 19.3541 10.7951 19.311 10.9485 19.2288C11.2946 19.0436 19.4431 14.6173 20.5277 9.22751C21.2126 5.84986 20.1857 3.77732 19.2041 2.63262ZM18.5099 8.85122C17.7415 12.6646 12.1567 16.2116 10.4489 17.2196C8.04279 15.8234 3.09251 12.318 2.39312 8.85122C1.86472 6.23109 2.5878 4.70912 3.28821 3.89317C3.65861 3.46353 4.12333 3.11801 4.64903 2.88141C5.17473 2.64481 5.74838 2.52299 6.32883 2.52468C6.94879 2.47998 7.57022 2.59049 8.13253 2.84542C8.69484 3.10036 9.17884 3.49102 9.53734 3.97932C9.62575 4.13571 9.75616 4.26645 9.915 4.3579C10.0738 4.44936 10.2553 4.49819 10.4404 4.4993C10.6256 4.50041 10.8076 4.45377 10.9676 4.36423C11.1276 4.27469 11.2598 4.14553 11.3502 3.99022C11.708 3.49811 12.193 3.10414 12.7575 2.84715C13.3219 2.59016 13.9463 2.47902 14.569 2.52468C15.1507 2.52196 15.7257 2.64329 16.2527 2.87993C16.7798 3.11656 17.2456 3.46262 17.6168 3.89317C18.3152 4.70912 19.0383 6.23109 18.5099 8.85122Z"
                                                                fill="white" />
                                                        </svg>
                                                        <span class="product-tooltip">Добавить в избранное</span>
                                                    </button>
                                                </form>
                                                </div>
                                                <div class="product-content">
                                                <div class="product-tag">
                                                   
                                                </div>
                                                <h4 class="product-title"><a href="{{ route('accessories.descriptionaccessories', $accessorie->id) }}">{{ $accessorie->name }}</a>
                                                </h4>
                                                <div class="product-price">
                                                    
                                                    <span class="product-new-price">{{ $accessorie->price }}</span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                @endforeach
            </div>
        @endif
    @endif
</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.addEventListener("click", function (event) {
                    if (event.target.classList.contains("cart-minus") || event.target.classList.contains("cart-plus")) {
                        let modal = event.target.closest(".product-modal-sm");
                        let quantityInput = modal.querySelector(".cart-input");
                        let hiddenQuantityInput = modal.querySelector(".cart-hidden-input");

                        let value = parseInt(quantityInput.value) || 1; // Проверяем, что значение — число

                        if (event.target.classList.contains("cart-minus") && value > 1) {
                            quantityInput.value = value - 1;
                        } 
                        if (event.target.classList.contains("cart-plus")) {
                            quantityInput.value = value + 1;
                        }

                        hiddenQuantityInput.value = quantityInput.value;
                    }
                });

                document.addEventListener("input", function (event) {
                    if (event.target.classList.contains("cart-input")) {
                        let modal = event.target.closest(".product-modal-sm");
                        let hiddenQuantityInput = modal.querySelector(".cart-hidden-input");
                        hiddenQuantityInput.value = event.target.value;
                    }
                });
            });
        </script>