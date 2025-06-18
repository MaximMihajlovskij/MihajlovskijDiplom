@extends('base')

@section('accessories_description')

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
                                        @if($accessorie->image)
                                            <img src="{{ asset('storage/' . $accessorie->image) }}" class="img-fluid" alt="{{ $accessorie->name }}">
                                        @else
                                            <span>Нет фото</span>
                                        @endif
                                    </button>
                                    <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                        data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                        aria-selected="true">
                                        @if($accessorie->image)
                                            <img src="{{ asset('storage/' . $accessorie->image) }}" class="img-fluid" alt="{{ $accessorie->name }}">
                                        @else
                                            <span>Нет фото</span>
                                        @endif
                                    </button>
                                    <button class="nav-link active" id="img-1-tab" data-bs-toggle="tab"
                                        data-bs-target="#img-1" type="button" role="tab" aria-controls="img-1"
                                        aria-selected="true">
                                        @if($accessorie->image)
                                            <img src="{{ asset('storage/' . $accessorie->image) }}" class="img-fluid" alt="{{ $accessorie->name }}">
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
                                            <img src="{{ asset('storage/' . $accessorie->image) }}" class="img-fluid" alt="{{ $accessorie->name }}">
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
                        <h3 class="product__details-title text-capitalize">{{ $accessorie->name }}</h3>
                    </div>

                    <div class="product__details-price">
                        <span class="new-price">{{ $accessorie->price }} BYN</span>
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

                    <div class="tag">
                        @if($accessorie->quantity <= 0)
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
                                        @if(isset($accessorie->description))
                                            <button class="nav-link" id="nav-description-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-description" type="button" role="tab"
                                                aria-controls="nav-description" aria-selected="false">Описание
                                            </button>
                                        @endif    
                                        <button class="nav-link active" id="nav-review-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review"
                                            aria-selected="true">Отзывы ({{ $reviews->count() }})
                                        </button>
                                    </div>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xxl-9 col-xl-8 col-lg-8">
                                <div class="product__details-more-tab-content">
                                    <div class="tab-content" id="productmorecontent">
                                        @if(isset($accessorie->description))
                                            <div class="tab-pane fade" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                                                <div class="product__details-des">
                                                    @if(isset($accessorie->description))
                                                        <p>{{ $accessorie->description }}</p>
                                                    @else
                                                        <p class="text-danger">Нет описания</p>   
                                                    @endif     
                                                </div>
                                            </div>
                                        @endif            
                                    

                                                            
                                                            
                                                    </section>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show active" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                                            <div class="product__details-review">
                                                <h3 class="comments-title">{{ $accessorie->name }}</h3>
                                                <div class="latest-comments mb-50">
                                                    <form action="{{ route('accessories.descriptionaccessories', $accessorie->id) }}" method="GET" class="d-flex align-items-center gap-2 p-2 border rounded w-auto mt-2">
                                                        <label>Отзывы с:</label>
                                                        <input type="date" name="date_from" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_from') }}">
                                                        
                                                        <label>по:</label>
                                                        <input type="date" name="date_to" class="form-control form-control-sm w-auto shadow-none" value="{{ request('date_to') }}">
                                                        
                                                        <button type="submit" class="btn btn-primary btn-sm px-3">
                                                            <i class="fas fa-filter"></i> Фильтровать
                                                        </button>
                                                    </form>
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
                                                    <form id="review-form" action="{{ route('reviews.store', $accessorie->id) }}" method="POST">
                                                        @csrf 
                                                        <input type="hidden" id="review-id" name="review_id">
                                                        <input type="hidden" name="accessorie_id" value="{{ $accessorie->id }}">
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