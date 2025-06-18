@extends('base')

@section('turn_description')
    
@if(session()->has('success'))
        <div class="flash-message" id="flashMessage">
            <span class="check-icon">✔</span> {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95" style="padding-top: 95px; padding-bottom: 95px;">
        <div class="breadcrumb__thumb" data-background="assets/imgs/bg/breadcrumb-bg.jpg"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-12">
                        <div class="breadcrumb__wrapper text-center">
                            <h2 class="breadcrumb__title">Описание</h2>
                            <div class="breadcrumb__menu">
                                <nav>
                                    <ul>
                                        <li><span>@include('includes.breadcrumbs')</span></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
        <!-- Breadcrumb area start  -->
   
   <!-- Product details area start -->
   <div class="product__details-area section-space-medium">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-lg-6">
                    <div class="product__details-thumb-wrapper d-sm-flex align-items-start mr-50">
                        <div class="product__details-thumb-tab mr-20">
                            <nav>
                                <div class="nav nav-tabs flex-nowrap flex-sm-column" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                        data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                        aria-selected="true">
                                        @if($turniket->image)
                                            <img src="{{ asset('storage/' . $turniket->image) }}" class="img-fluid" alt="{{ $turniket->name_turniket }}">
                                        @else
                                            <span>Нет фото</span>
                                        @endif
                                    </button>
                                    <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                        data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                        aria-selected="true">
                                        @if($turniket->image)
                                            <img src="{{ asset('storage/' . $turniket->image) }}" class="img-fluid" alt="{{ $turniket->name_turniket }}">
                                        @else
                                            <span>Нет фото</span>
                                        @endif
                                    </button>
                                    <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                        data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                        aria-selected="true">
                                        @if($turniket->image)
                                            <img src="{{ asset('storage/' . $turniket->image) }}" class="img-fluid" alt="{{ $turniket->name_turniket }}">
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
                                            <img src="{{ asset('storage/' . $turniket->image) }}" class="img-fluid" alt="{{ $turniket->name_turniket }}">
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
                    <div class="product__details-content pr-80">
                        <h3 class="product__details-title text-capitalize">{{ $turniket->name_turniket }}</h3>
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

                    <div class="tag">
                        @if($turniket->quantity <= 0)
                            <p class="text-danger">Нет в наличии</p>
                        @endif   
                    </div>
                </div>
            </div>
             <!-- Вкладки -->
            <div class="product__details-additional-info section-space-medium-top">
                        <div class="row">
                            <div class="col-xxl-3 col-xl-4 col-lg-4">
                                <div class="product__details-more-tab mr-15">
                                    <nav>
                                    <div class="nav nav-tabs flex-column " id="productmoretab" role="tablist">
                                        @if(isset($turniket->description))
                                            <button class="nav-link" id="nav-description-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-description" type="button" role="tab"
                                                aria-controls="nav-description" aria-selected="false">Описание
                                            </button>
                                        @endif    
                                        <button class="nav-link active" id="nav-additional-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-additional" type="button" role="tab"
                                            aria-controls="nav-additional" aria-selected="true">Технические характеристики 
                                        </button>
                                        <button class="nav-link" id="nav-accessories-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-accessories" type="button" role="tab"
                                            aria-controls="nav-accessories" aria-selected="false">Аксессуары
                                        </button>
                                        <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review"
                                            aria-selected="false">Отзывы ({{ $reviews->count() }})
                                        </button>
                                    </div>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xxl-9 col-xl-8 col-lg-8">
                                <div class="product__details-more-tab-content">
                                    <div class="tab-content" id="productmorecontent">
                                        @if(isset($turniket->description))
                                            <div class="tab-pane fade" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                                                <div class="product__details-des">
                                                    @if(isset($turniket->description))
                                                        <p>{{ $turniket->description }}</p>
                                                    @else
                                                        <p class="text-danger">Нет описания</p>   
                                                    @endif     
                                                </div>
                                            </div>
                                        @endif            
                                    <div class="tab-pane fade show active" id="nav-additional" role="tabpanel"
                                        aria-labelledby="nav-additional-tab">
                                        <div class="product__details-info">
                                            <ul>
                                                @if($turniket->specifications->isNotEmpty())
                                                    @foreach ($turniket->specifications as $specification)
                                                        <li>
                                                            <h4>{{ $specification->key }}</h4>
                                                            <span>
                                                                @if(is_array($specification->value))
                                                                    {{ implode(', ', $specification->value) }}
                                                                @else
                                                                    {{ str_replace('; ', ', ', $specification->value) }}
                                                                @endif
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li><span>Нет данных о характеристиках.</span></li>
                                                @endif
                                            
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-accessories" role="tabpanel" aria-labelledby="nav-accessories-tab">
                                        <div class="product__details-accessories">
                                                    <!-- Add cart modal area end -->
                                                    <section class="bd-product__area section-space" style="padding-top: 0px;">
                                                                <div class="container">
                                                                    <div class="row">
                                                                    <div class="col-xxl-12">
                                                                        <div class="product__filter-tab">
                                                                            <div class="tab-content" id="nav-tabContent">
                                                                                <div class="tab-pane fade active show" id="nav-grid" role="tabpanel"
                                                                                aria-labelledby="nav-grid-tab">
                                                                                <div class="row g-5">
                                                                                    @if($turniket->accessories->isNotEmpty())
                                                                                        @foreach ($turniket->accessories as $accessorie)
                                                                                            <div class="product-modal-sm modal fade" id="producQuickViewModal" tabindex="-1">
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
                                                                                                                                                <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="{{ $accessorie->name }}">
                                                                                                                                            @else
                                                                                                                                                <span>Нет фото</span>
                                                                                                                                            @endif
                                                                                                                                    </button>
                                                                                                                                    <button class="nav-link" id="img-2-tab" data-bs-toggle="tab"
                                                                                                                                        data-bs-target="#img-2" type="button" role="tab" aria-controls="img-3"
                                                                                                                                        aria-selected="false">
                                                                                                                                            @if($accessorie->image)
                                                                                                                                                <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="{{ $accessorie->name }}">
                                                                                                                                            @else
                                                                                                                                                <span>Нет фото</span>
                                                                                                                                            @endif
                                                                                                                                    </button>
                                                                                                                                    <button class="nav-link" id="img-3-tab" data-bs-toggle="tab"
                                                                                                                                        data-bs-target="#img-3" type="button" role="tab" aria-controls="img-3"
                                                                                                                                        aria-selected="false">
                                                                                                                                            @if($accessorie->image)
                                                                                                                                                <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="{{ $accessorie->name }}">
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
                                                                                                                                            <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="{{ $accessorie->name }}">
                                                                                                                                        @else
                                                                                                                                            <span>Нет фото</span>
                                                                                                                                        @endif
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="tab-pane fade" id="img-2" role="tabpanel"
                                                                                                                                    aria-labelledby="img-2-tab">
                                                                                                                                    <div class="product__details-thumb-big w-img">
                                                                                                                                        @if($accessorie->image)
                                                                                                                                            <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="{{ $accessorie->name }}">
                                                                                                                                        @else
                                                                                                                                            <span>Нет фото</span>
                                                                                                                                        @endif
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                                <div class="tab-pane fade" id="img-3" role="tabpanel"
                                                                                                                                    aria-labelledby="img-3-tab">
                                                                                                                                    <div class="product__details-thumb-big w-img">
                                                                                                                                        @if($accessorie->image)
                                                                                                                                            <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="{{ $accessorie->name }}">
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
                                                                                                                            <p>{{ $accessorie->description }}</p>

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
                                                                                                                                <form action="{{ route('wishlist.add') }}" method="POST">
                                                                                                                                    @csrf
                                                                                                                                    <input type="hidden" name="accessory_id" value="{{ $accessorie->id }}">
                                                                                                                                    <button type="submit" class="product__add-wish-btn"><i class="fa-solid fa-heart"></i>
                                                                                                                                        <span class="product-tooltip">Добавить в избранное</span>
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
                                                                                            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                                                                                <div class="product-item">
                                                                                                    <div class="product-thumb">
                                                                                                        @if($accessorie->image)
                                                                                                            <img src="{{ asset('storage/' . $accessorie->image) }}" width="50" height="50" alt="{{ $accessorie->name }}">
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
                                                                                                    
                                                                                                    <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                                                                                        data-bs-target="#producQuickViewModal">

                                                                                                        <svg width="26" height="18" viewBox="0 0 26 18" fill="none"
                                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                                            <path
                                                                                                                d="M13.092 4.55026C10.5878 4.55026 8.55683 6.58125 8.55683 9.08541C8.55683 11.5896 10.5878 13.6206 13.092 13.6206C15.5961 13.6206 17.6271 11.5903 17.6271 9.08541C17.6271 6.5805 15.5969 4.55026 13.092 4.55026ZM13.092 12.1089C11.4246 12.1089 10.0338 10.7196 10.0338 9.05216C10.0338 7.38473 11.3898 6.02872 13.0572 6.02872C14.7246 6.02872 16.0807 7.38473 16.0807 9.05216C16.0807 10.7196 14.7594 12.1089 13.092 12.1089ZM25.0965 8.8768C25.0875 8.839 25.092 8.79819 25.0807 8.76115C25.0761 8.74528 25.0655 8.73621 25.0603 8.7226C25.0519 8.70144 25.0542 8.67574 25.0429 8.65533C22.8441 3.62131 18.1064 0.724854 13.0572 0.724854C8.00807 0.724854 3.17511 3.61677 0.975559 8.65079C0.966488 8.67196 0.968 8.69388 0.959686 8.71806C0.954395 8.73318 0.943812 8.74074 0.938521 8.7551C0.927184 8.7929 0.931719 8.83296 0.92416 8.8715C0.910555 8.93953 0.897705 9.00605 0.897705 9.07483C0.897705 9.14361 0.910555 9.20862 0.92416 9.2774C0.931719 9.31519 0.926428 9.35677 0.938521 9.39229C0.943057 9.40968 0.954395 9.41648 0.959686 9.4316C0.967244 9.45201 0.965732 9.4777 0.975559 9.49887C3.17511 14.5314 7.96121 17.381 13.0104 17.381C18.0595 17.381 22.8448 14.5374 25.0436 9.5034C25.055 9.48148 25.0527 9.45956 25.061 9.43538C25.0663 9.42253 25.0761 9.4127 25.0807 9.39758C25.092 9.36055 25.089 9.32049 25.0965 9.28118C25.1101 9.21315 25.1222 9.14739 25.1222 9.0771C25.1222 9.01058 25.1094 8.94482 25.0958 8.87604L25.0965 8.8768ZM13.0104 15.8692C8.72841 15.8692 4.51298 13.6123 2.44193 9.07407C4.49333 4.55177 8.76469 2.23582 13.0572 2.23582C17.349 2.23582 21.5251 4.55404 23.5773 9.07861C21.5266 13.6002 17.3036 15.8692 13.0104 15.8692Z"
                                                                                                                fill="white" />
                                                                                                        </svg>
                                                                                                        <span class="product-tooltip">Быстрый просмотр</span>
                                                                                                    </button>
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
                                                                                                        <span>ACCESSORIES</span>
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
                                                                                    @else
                                                                                        <span>Нет аксессуаров</span>
                                                                                    @endif     
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            
                                                            
                                                    </section>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                                            <div class="product__details-review">
                                                <h3 class="comments-title">{{ $turniket->name_turniket }}</h3>
                                                <div class="latest-comments mb-50">
                                                    <ul id="review-list">
                                                        @foreach ($reviews as $review)
                                                            <li class="review-item" style="display: none;">
                                                                <div class="comments-box d-flex">
                                                                    <div class="comments-avatar mr-10" style="margin-right: 10px; ">
                                                                        @if($review->user->avatar)
                                                                            <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="" style="width: 60px; height: 60px; object-fit: cover;">
                                                                        @else
                                                                            <img src="{{ asset('storage/banners/аватарка.jpg') }}" alt="" style="width: 60px; height: 60px; object-fit: cover;"> 
                                                                        @endif        
                                                                    </div>
                                                                    
                                                                    <div class="comments-text">
                                                                        <div class="comments-top d-sm-flex align-items-start justify-content-between mb-1">
                                                                            <div class="avatar-name">
                                                                                <h5>{{ $review->user->name }}</h5>
                                                                                <div class="comments-date">
                                                                                    <span>{{ $review->created_at }}</span>
                                                                                </div>
                                                                            </div>
                                                                        <div class="user-rating">
                                                                            <ul>
                                                                                @for($i = 1; $i <= 5; $i++)
                                                                                    <li>
                                                                                        <a href="#">
                                                                                            <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                                                                        </a>
                                                                                    </li>
                                                                                @endfor
                                                                            </ul>
                                                                        </div>
                                                                        </div>
                                                                        <p>{{ $review->content }}
                                                                        </p>
                                                                        @if(auth()->id() === $review->user_id)
                                                                            <a href="#" class="btn btn-warning btn-sm edit-review"
                                                                                data-id="{{ $review->id }}"
                                                                                data-content="{{ $review->content }}"
                                                                                data-rating="{{ $review->rating }}">Редактировать
                                                                            </a>
                                                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                                                                                    @csrf @method('DELETE')
                                                                                    <button type="submit" class="btn btn-danger btn-sm delete-review">Удалить</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach    
                                                    </ul>
                                                    <div class="review-buttons">
                                                        <a href="#" id="show-more" class="show-link">Показать ещё</a>
                                                        <a href="#" id="show-less" class="hide-link" style="display: none;"> | Скрыть | </a>
                                                        <a href="#" id="show-lessall" class="hide-link" style="display: none;">Скрыть все</a>
                                                    </div>
                                                </div>
                                                <div class="product__details-comment section-space-medium-bottom">
                                                    <div class="comment-title mb-20">
                                                    <h3>Добавить отзыв</h3>
                                                    <p>Ваш email не будет показан. Обязательные поля обозначены значком *</p>
                                                    </div>
                                                    <form id="review-form" action="{{ route('reviews.store', $turniket->id) }}" method="POST">
                                                        @csrf 
                                                        <input type="hidden" id="review-id" name="review_id">
                                                        <input type="hidden" name="turniket_id" value="{{ $turniket->id }}">
                                                        <div class="comment-rating mb-20">
                                                            <span>Поставьте оценку</span>
                                                            <ul class="star-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <li>
                                                                        <i class="far fa-star star-icon" data-value="{{ $i }}"></i>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                            <input type="hidden" id="rating-input" name="rating">
                                                        </div>
                                                        <div class="comment-input-box">
                                                            <div class="row">
                                                                <div class="col-xxl-12">
                                                                    <div class="comment-input">
                                                                    <textarea id="review-content" name="content" placeholder="Your review"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <div class="comment-input">
                                                                    <input type="text" placeholder="Your Name*" value="{{ old('name', auth()->check() ? auth()->user()->name : '-') }}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6">
                                                                    <div class="comment-input">
                                                                    <input type="email" placeholder="Your Email*" value="{{ old('email', auth()->check() ? auth()->user()->email : '-') }}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-12">
                                                                    <div class="comment-submit">
                                                                        <button type="submit" class="fill-btn" id="submit-button">
                                                                            <span class="fill-btn-inner">
                                                                                <span class="fill-btn-normal">Отправить</span>
                                                                                <span class="fill-btn-hover">Отправить</span>
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </div>
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
    </div>

   
    <!-- Product details area end -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const minusBtn = document.querySelector(".cart-minus");
            const plusBtn = document.querySelector(".cart-plus");
            const quantityInput = document.querySelector(".cart-input");
            const hiddenQuantityInput = document.querySelector(".cart-hidden-input");

            // Уменьшение количества
            minusBtn.addEventListener("click", function () {
                let value = parseInt(quantityInput.value);
                if (value > 1) {
                    quantityInput.value = value - 1;
                    hiddenQuantityInput.value = quantityInput.value;
                }
            });

            // Увеличение количества
            plusBtn.addEventListener("click", function () {
                let value = parseInt(quantityInput.value);
                quantityInput.value = value + 1;
                hiddenQuantityInput.value = quantityInput.value;
            });

            // Обновление скрытого поля при ручном вводе
            quantityInput.addEventListener("input", function () {
                hiddenQuantityInput.value = quantityInput.value;
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".product-modal-sm").forEach(modal => {
                modal.addEventListener("shown.bs.modal", function () {
                    const minusBtn = modal.querySelector(".cart-minus");
                    const plusBtn = modal.querySelector(".cart-plus");
                    const quantityInput = modal.querySelector(".cart-input");
                    const hiddenQuantityInput = modal.querySelector(".cart-hidden-input");

                    // Уменьшение количества
                    minusBtn.addEventListener("click", function () {
                        let value = parseInt(quantityInput.value);
                        if (value > 1) {
                            quantityInput.value = value - 1;
                            hiddenQuantityInput.value = quantityInput.value;
                        }
                    });

                    // Увеличение количества
                    plusBtn.addEventListener("click", function () {
                        let value = parseInt(quantityInput.value);
                        quantityInput.value = value + 1;
                        hiddenQuantityInput.value = quantityInput.value;
                    });

                    // Обновление скрытого поля при ручном вводе
                    quantityInput.addEventListener("input", function () {
                        hiddenQuantityInput.value = quantityInput.value;
                    });
                });
            });
        });
    </script>   
    <script>
        setTimeout(() => {
            let flashMessage = document.getElementById('flashMessage');
            if (flashMessage) {
                flashMessage.style.animation = 'fadeOut 1s ease-in-out';
                setTimeout(() => flashMessage.remove(), 1000);
            }
        }, 3000);
    </script> 
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("Скрипт загружен");

            document.querySelectorAll(".edit-review").forEach(button => {
                button.addEventListener("click", function (event) {
                    event.preventDefault();
                    console.log("Клик по редактированию");

                    let reviewId = this.getAttribute("data-id");
                    let content = this.getAttribute("data-content");
                    let rating = this.getAttribute("data-rating");

                    console.log("ID:", reviewId, "Контент:", content, "Рейтинг:", rating);

                    document.getElementById("review-id").value = reviewId;
                    document.getElementById("review-content").value = content;

                    document.querySelectorAll("input[name='rating']").forEach(input => {
                        input.checked = input.value === rating;
                    });

                    let reviewForm = document.getElementById("review-form");
                    reviewForm.action = `/reviews/${reviewId}`;
                    reviewForm.method = "POST"; 

                    // Удаляем старое hidden поле PUT, если оно есть
                    let oldMethodInput = document.getElementById("method-put");
                    if (oldMethodInput) oldMethodInput.remove();

                    // Добавляем скрытое поле `_method=PUT`
                    let methodInput = document.createElement("input");
                    methodInput.type = "hidden";
                    methodInput.name = "_method";
                    methodInput.value = "PUT";
                    methodInput.id = "method-put";
                    reviewForm.appendChild(methodInput);

                    // Меняем текст кнопки "Отправить" на "Изменить"
                    let submitButton = document.getElementById("submit-button");
                    submitButton.innerText = "Изменить";

                    // 📌 Прокрутка к форме добавления отзыва
                    reviewForm.scrollIntoView({ behavior: "smooth", block: "start" });
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let reviews = document.querySelectorAll(".review-item");
            let showMoreLink = document.getElementById("show-more");
            let showLessLink = document.getElementById("show-less");
            let showLessAllLink = document.getElementById("show-lessall"); // Исправляем имя переменной

            let visibleCount = 3; // Показываем 3 отзыва

            function updateVisibility() {
                reviews.forEach((review, index) => {
                    review.style.display = index < visibleCount ? "block" : "none";
                });

                showLessAllLink.style.display = visibleCount > 3 ? "inline" : "none";
                showLessLink.style.display = visibleCount > 3 ? "inline" : "none";
                showMoreLink.style.display = visibleCount >= reviews.length ? "none" : "inline";
            }

            // Показываем первые 3 отзыва
            updateVisibility();

            showMoreLink.addEventListener("click", function (event) {
                event.preventDefault();
                visibleCount += 3;
                updateVisibility();
            });

            showLessLink.addEventListener("click", function (event) {
                event.preventDefault();
                visibleCount -= 3;
                updateVisibility();
            });

            showLessAllLink.addEventListener("click", function (event) {
                event.preventDefault();
                visibleCount = 3; // Возвращаемся к начальному количеству
                updateVisibility();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let stars = document.querySelectorAll(".star-icon");
            let ratingInput = document.getElementById("rating-input");
            let starContainer = document.querySelector(".star-rating");

            stars.forEach(star => {
                star.addEventListener("mouseover", function () {
                    stars.forEach(icon => {
                        icon.classList.remove("fas");
                        icon.classList.add("far");
                    });

                    this.classList.remove("far");
                    this.classList.add("fas");

                    let previousStars = this.parentNode.previousElementSibling;
                    while (previousStars) {
                        previousStars.querySelector(".star-icon").classList.remove("far");
                        previousStars.querySelector(".star-icon").classList.add("fas");
                        previousStars = previousStars.previousElementSibling;
                    }
                });

                star.addEventListener("click", function () {
                    let ratingValue = this.getAttribute("data-value");
                    ratingInput.value = ratingValue;

                    // Закрепляем выбранные звёзды
                    stars.forEach(icon => {
                        icon.classList.remove("selected");
                    });

                    this.classList.add("selected");

                    let previousStars = this.parentNode.previousElementSibling;
                    while (previousStars) {
                        previousStars.querySelector(".star-icon").classList.add("selected");
                        previousStars = previousStars.previousElementSibling;
                    }
                });
            });

            // Сбрасываем звёзды при уходе с контейнера, если рейтинг не выбран
            starContainer.addEventListener("mouseleave", function () {
                if (!document.querySelector(".star-icon.selected")) {
                    stars.forEach(icon => {
                        icon.classList.remove("fas");
                        icon.classList.add("far");
                    });
                }
            });
        });
    </script>
@endsection