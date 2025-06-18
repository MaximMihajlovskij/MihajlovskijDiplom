@extends('base')

@section('wishlist')
    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95" style="padding-top: 95px; padding-bottom: 95px;">
            <div class="breadcrumb__thumb" data-background="assets/imgs/bg/breadcrumb-bg.jpg"></div>
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-xxl-12">
                    <div class="breadcrumb__wrapper text-center">
                        <h2 class="breadcrumb__title">Избранные</h2>
                        <div class="breadcrumb__menu">
                            <nav>
                                <ul>
                                    <li><span><a href="index.html">Home</a></span></li>
                                    <li><span>wishlist</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb area start  -->

        <!-- Cart area start  -->
        <div class="cart-area section-space">
            <div class="container">
                <div class="row">
                <div class="col-12">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Изображение</th>
                                <th class="cart-product-name">Оборудование</th>
                                <th class="product-price">Цена</th>
                                <th class="product-remove">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlistItems as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            @if ($item->camera)
                                                <a href="{{ route('video.descriptioncamera', $item->camera->id) }}">
                                                    <img src="{{ asset('storage/' . $item->camera->image) }}" alt="">
                                                </a>
                                            @elseif ($item->turniket)
                                                <a href="{{ route('video.descriptioncamera', $item->turniket->id) }}">
                                                    <img src="{{ asset('storage/' . $item->turniket->image) }}" alt="">
                                                </a>
                                            @elseif ($item->barrier)
                                                <a href="{{ route('video.descriptioncamera', $item->barrier->id) }}">
                                                    <img src="{{ asset('storage/' . $item->barrier->image) }}" alt="">
                                                </a>
                                            @elseif ($item->accessorie)
                                                <a href="{{ route('accessories.descriptionaccessories', $item->accessorie->id) }}">
                                                    <img src="{{ asset('storage/' . $item->accessorie->image) }}" alt="">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="product-name"><a href="">{{ $item->camera->name_camera ?? $item->turniket->name_turniket ?? $item->barrier->name_barrier ?? $item->accessorie->name }}</a></td>
                                        <td class="product-price"><span class="amount">{{ $item->camera->price ?? $item->turniket->price ?? $item->barrier->price ?? $item->accessorie->price }}</span></td>
                                        <td class="product-remove">
                                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit"><i class="fa fa-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Cart area end  -->
@endsection