@extends('base')

@section('barrier')
    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95" style="padding-top: 95px; padding-bottom: 95px;">
            <div class="breadcrumb__thumb" data-background="assets/imgs/bg/breadcrumb-bg.jpg"></div>
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Шлагбаумы</h2>
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
        <!-- Breadcrumb area start  -->
        <!-- ./ Shop Grid -->
        <!-- Навигация -->
        <section class="bd-product__area section-space">
         <div class="container">
            <div class="row">
               <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="bd-product__result mb-30">
                        <h4>Шлагбаумов на странице: {{ $barriers->count() }}</h4>
                  </div>
               </div>
               <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-6">
                    <div class="product__filter-wrapper d-flex flex-wrap gap-3 align-items-center justify-content-md-end mb-30">
                        <div class="bd-product__filter-btn">
                            <button type="button" id="filter-toggle"><i class="fa-solid fa-list"></i> Фильтрация</button>
                        </div>

                        <div class="product__filter-count d-flex align-items-center">
                            <div class="selected-filters">
                                <div id="filter-list"></div>
                                <button id="clear-filters" class="btn btn">Очистить все</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Блок фильтрации -->
                <div class="filter-panel">
                    <h2 class="filter-header">Фильтрация оборудования</h2>
                    <form method="GET" action="{{ route('barrier') }}" class="filter-container">
                        <!-- 🔹 Фильтр по поиску -->
                        <div class="header-search d-none d-xxl-block" style="margin-bottom: 20px;">
                            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <button type="submit">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.4443 13.4445L16.9999 17" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                    d="M15.2222 8.11111C15.2222 12.0385 12.0385 15.2222 8.11111 15.2222C4.18375 15.2222 1 12.0385 1 8.11111C1 4.18375 4.18375 1 8.11111 1C12.0385 1 15.2222 4.18375 15.2222 8.11111Z"
                                    stroke="white" stroke-width="2" />
                                </svg>
                            </button>
                        </div>
                        <!-- 🔹 Фильтр по цене -->
                        <div class="filter-section price-filter">
                            <h3 class="filter-title">Цена:</h3>
                            <div class="price-inputs">
                                <input type="number" name="price_min" id="price-min" placeholder="От" class="filter-input">
                                <input type="number" name="price_max" id="price-max" placeholder="До" class="filter-input">
                            </div>
                        </div>

                        <!-- 🔹 Фильтр по брендам -->
                        <div class="filter-section">
                            <h3 class="filter-title">Бренды:</h3>
                            <select name="firm_id" class="filter-select">
                                <option value="">Все бренды</option>
                                @foreach($firms as $firm)
                                    <option value="{{ $firm->id }}">{{ $firm->Фирма }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 🔹 Кнопка отправки -->
                        <button type="submit" class="btn btn-primary">Применить фильтр</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12">
                    <div class="product__filter-tab">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-grid" role="tabpanel"
                            aria-labelledby="nav-grid-tab">
                            <div class="row g-5">
                                @if(session()->has('search_results'))
                                    <h3>Результаты поиска: "{{ session('search') }}"</h3>
                                    <ul>
                                        @foreach(session('search_results') as $item)
                                            <li>{{ $item->name_camera ?? $item->name_turniket ?? $item->name_barrier }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if ($barriers->isEmpty())
                                    <p class="text-danger">В базе данных нет шлагбаумов</p>
                                @else 
                                    @foreach ($barriers as $barrier)
                                       
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
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-6">
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
                                                
                                                <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                                    data-bs-target="#producQuickViewModal-{{ $barrier->id }}">

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
                                @endif        
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
               <div class="bd-basic__pagination mt-50 d-flex align-items-center justify-content-center" style="margin-top: 50px;">
                  <nav>
                     <ul>
                        @if ($barriers->currentPage() > 1)
                            <li>
                                <a href="{{ $barriers->previousPageUrl() }}">
                                    <i class="fa-solid fa-angle-left" style="display: inline-block; visibility: visible; font-size: 18px;"></i>
                                </a>
                            </li>
                        @endif

                        @foreach ($barriers->getUrlRange(1, $barriers->lastPage()) as $page => $url)
                            @if ($page == $barriers->currentPage())
                                <li><span class="current">{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        @if ($barriers->currentPage() < $barriers->lastPage())
                            <li>
                                <a href="{{ $barriers->nextPageUrl() }}">
                                    <i class="fa-solid fa-angle-right" style="display: inline-block; visibility: visible; font-size: 18px;"></i>
                                </a>
                            </li>
                        @endif
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </section>
      <!-- Product area end -->

        <div class="scroll-percentage">
            <span class="scroll-percentage-value"></span>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".increment").forEach(button => {
                    button.addEventListener("click", function() {
                        let input = this.previousElementSibling;
                        input.value = parseInt(input.value) + 1;
                });
            });
            document.querySelectorAll(".decrement").forEach(button => {
                button.addEventListener("click", function() {
                    let input = this.nextElementSibling;
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                    }
                });
            });
        });
        </script>
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
                const filterToggle = document.getElementById("filter-toggle");
                const filterPanel = document.querySelector(".filter-panel");

                // 🔹 Создаём затемнённый фон
                const overlay = document.createElement("div");
                overlay.classList.add("filter-overlay");
                document.body.appendChild(overlay);

                filterToggle.addEventListener("click", function () {
                    filterPanel.classList.toggle("active");
                    overlay.classList.toggle("active");
                });

                overlay.addEventListener("click", function () {
                    filterPanel.classList.remove("active");
                    overlay.classList.remove("active");
                });
            });
        </script> 
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                function scrollTopPercentage() {
                    const scrollPercentage = () => {
                        const scrollTopPos = window.scrollY || document.documentElement.scrollTop;
                        const calcHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                        const scrollValue = Math.round((scrollTopPos / calcHeight) * 100);
                        const scrollElementWrap = document.querySelector(".scroll-percentage");

                        // 🔹 Теперь обновляем `background` напрямую
                        scrollElementWrap.style.setProperty("--border-fill", `${scrollValue}%`);
                        scrollElementWrap.style.setProperty("--border-empty", `${100 - scrollValue}%`);
                        scrollElementWrap.style.setProperty("background", `conic-gradient(blue ${scrollValue}%, transparent ${scrollValue}%)`);

                        if (scrollTopPos > 100) {
                            scrollElementWrap.classList.add("active");
                        } else {
                            scrollElementWrap.classList.remove("active");
                        }

                        document.querySelector(".scroll-percentage-value").innerHTML = scrollValue < 96 ? `${scrollValue}%` : '<i class="fa-solid fa-arrow-up"></i>';
                    };

                    window.addEventListener("scroll", scrollPercentage);
                    scrollPercentage(); // Запускаем сразу

                    document.querySelector(".scroll-percentage").addEventListener("click", function () {
                        console.log("Клик зарегистрирован!"); // Проверяем, работает ли событие
                        window.scrollTo({ top: 0, behavior: "smooth" });
                        document.documentElement.scrollTop = 0;
                        document.body.scrollTop = 0;
                    });
                }

                scrollTopPercentage();
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const filterForm = document.querySelector(".filter-container");
                const filterList = document.getElementById("filter-list");
                const clearFiltersBtn = document.getElementById("clear-filters");

                function updateFilters() {
                    filterList.innerHTML = "";
                    const formData = new FormData(filterForm);
                    const selectedFilters = {};

                    // 🔹 Объединяем минимальную и максимальную цену в один фильтр "Цена"
                    const minPrice = formData.get("price_min");
                    const maxPrice = formData.get("price_max");
                    if (minPrice && maxPrice) {
                        selectedFilters["price_range"] = `${minPrice} – ${maxPrice}`;
                        const filterItem = document.createElement("div");
                        filterItem.classList.add("filter-item");
                        filterItem.innerHTML = `Цена: ${minPrice} – ${maxPrice} <button class="remove-filter" data-key="price_range">X</button>`;
                        filterList.appendChild(filterItem);
                    }

                    formData.forEach((value, key) => {
                        if (value && key !== "price_min" && key !== "price_max" && value !== "Все бренды") {
                            selectedFilters[key] = value;
                            const filterItem = document.createElement("div");
                            filterItem.classList.add("filter-item");
                            filterItem.innerHTML = `${key}: ${value} <button class="remove-filter" data-key="${key}">X</button>`;
                            filterList.appendChild(filterItem);
                        }
                    });

                    localStorage.setItem("savedFilters", JSON.stringify(selectedFilters));

                    document.querySelectorAll(".remove-filter").forEach((button) => {
                        button.addEventListener("click", function () {
                            removeFilter(this.getAttribute("data-key"));
                        });
                    });
                }

                function restoreFilters() {
                    const savedFilters = JSON.parse(localStorage.getItem("savedFilters")) || {};
                    Object.entries(savedFilters).forEach(([key, value]) => {
                        if (key === "price_range") {
                            const [minPrice, maxPrice] = value.split(" – ");
                            document.getElementById("price-min").value = minPrice;
                            document.getElementById("price-max").value = maxPrice;
                        } else {
                            const inputField = document.querySelector(`[name="${key}"]`);
                            if (inputField) {
                                if (inputField.type === "checkbox" || inputField.type === "radio") {
                                    inputField.checked = true;
                                } else {
                                    inputField.value = value;
                                }
                            }
                        }

                        const filterItem = document.createElement("div");
                        filterItem.classList.add("filter-item");
                        filterItem.innerHTML = `${key}: ${value} <button class="remove-filter" data-key="${key}">X</button>`;
                        filterList.appendChild(filterItem);
                    });

                    document.querySelectorAll(".remove-filter").forEach((button) => {
                        button.addEventListener("click", function () {
                            removeFilter(this.getAttribute("data-key"));
                        });
                    });
                }

                function removeFilter(key) {
                    const savedFilters = JSON.parse(localStorage.getItem("savedFilters")) || {};
                    delete savedFilters[key];
                    localStorage.setItem("savedFilters", JSON.stringify(savedFilters));

                    // 🔹 Если удаляется фильтр "Цена", сбрасываем оба поля и удаляем параметры из URL
                    const url = new URL(window.location.href);
                    if (key === "price_range") {
                        document.getElementById("price-min").value = "";
                        document.getElementById("price-max").value = "";
                        url.searchParams.delete("price_min");
                        url.searchParams.delete("price_max");
                    } else {
                        const inputField = document.querySelector(`[name="${key}"]`);
                        if (inputField) {
                            if (inputField.type === "checkbox" || inputField.type === "radio") {
                                inputField.checked = false;
                            } else {
                                inputField.value = "";
                            }
                        }
                        url.searchParams.delete(key);
                    }

                    window.history.replaceState({}, "", url.toString());

                    // 🔹 Перезагружаем страницу для применения изменений
                    window.location.reload();
                }

                clearFiltersBtn.addEventListener("click", function () {
                    localStorage.removeItem("savedFilters");
                    filterForm.reset();

                    document.querySelectorAll(".filter-container input, .filter-container select").forEach((input) => {
                        if (input.type === "checkbox" || input.type === "radio") {
                            input.checked = false;
                        } else {
                            input.value = "";
                        }
                    });

                    window.location.href = window.location.pathname;
                });

                filterForm.addEventListener("change", updateFilters);
                restoreFilters();
            });
        </script>
    </body>
@endsection



