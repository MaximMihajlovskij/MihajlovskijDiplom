@extends('base')

@section('index')
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .hero-section {
            width: 100%;
            height: 100%; /* 🚀 Заполняет весь экран */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* ✅ Слайдер */
        .swiper-container {
            width: 100%;
            height: 100%; 
            position: relative;
        }

        /* ✅ Центрирование изображений */
        .swiper-slide img {
            width: 100%;
            height: auto;
            max-height: 85vh; /* Ограничение высоты для лучшей адаптивности */
            object-fit: contain; /* ✅ Показывает изображение полностью */
            aspect-ratio: 16 / 9; /* ✅ Сохраняет пропорции */
            border-radius: 10px;
            object-fit: cover;
        }

        /* ✅ Разделы */
        section {
            padding: 60px 0;
            text-align: center;
            background:rgb(255, 255, 255);
        }

        /* ✅ Заголовки */
        h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color:#007bff;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* ✅ Карточки услуг */
        /* ✅ Общий стиль блоков */
        .service-box,
        .feature-item {
            width: 100%;
            max-width: 350px; /* 🚀 Одинаковая ширина */
            height: 250px; /* 🚀 Одинаковая высота */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            padding: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .service-box:hover,
        .feature-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .service-box:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .service-box img {
            width: 80px;
            margin-bottom: 10px;
        }

        /* ✅ Увеличенный размер иконок */
        #services-section .icon i {
            font-size: 3rem; /* 🔹 Сделали крупнее */
            color: #007bff; /* 🔹 Синий цвет */
        }

        /* 📌 Адаптивность */
        @media (max-width: 768px) {
            #services-section .icon i {
                font-size: 2.5rem; /* 🔹 Чуть меньше на мобильных */
            }
        }

        /* ✅ Раздел "Почему выбирают нас?" */
        .features {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        /* ✅ Контейнер карты */
        .map-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
        }

        /* ✅ Стилизация карты */
        .map-container {
            width: 100%;
            max-width: 1200px; /* 🚀 Увеличенная ширина */
            height: 550px; /* 🚀 Увеличенная высота */
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            border: none;
        }

        /* 📌 Адаптивность */
        @media (max-width: 768px) {
            .map-container {
                width: 100%; /* 🚀 Полная ширина */
                height: 450px; /* 🚀 Увеличено для мобильных */
            }   
        }

        /* ✅ Заголовок */
        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* ✅ Галерея */
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        .gallery img {
            width: 250px;
            height: 160px;
            border-radius: 10px;
            object-fit: cover;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* ✅ Кнопка "Смотреть больше" */
        .btn-view-more {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 8px;
            margin-top: 20px;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }

        .btn-view-more:hover {
            background: #0056b3;
        }

        /* ✅ Общий стиль */
        .company-section {
            padding: 60px 0;
            background: #f8f9fa;
        }

        .company-info, .company-resources {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .resource-item p {
            text-align: left; /* 🚀 Текст внутри `p` слева */
        }

        .container .company-info {
            text-align: left; /* ✅ Принудительное выравнивание */
        }

        /* ✅ Заголовки */
        .company-title, .resources-title {
            color: #007bff;
            font-weight: bold;
        }

        /* ✅ Ресурсы */
        .resources-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .resource-item {
            display: flex;
            gap: 10px;
        }

        .resource-item img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }

        /* ✅ Кнопка */
        .btn-learn-more {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            align-self: flex-start;
        }

        .btn-learn-more:hover {
            background: #0056b3;
        }

        /* ПРо нас */
        /* ✅ Общий стиль секции */
        .trust-section {
            padding: 60px 0;
            background: #f8f9fa;
            text-align: center;
        }

        /* ✅ Заголовок */
        .trust-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #345AED;
            margin-bottom: 30px;
        }

        /* ✅ Блок с преимуществами */
        .trust-list {
            display: flex;
            justify-content: space-between;;
            align-items: center;
            gap: 15px; /* 🔹 Уменьшаем расстояние между блоками */
            flex-wrap: nowrap; /* 🔹 Запрещаем перенос на новую строку */
        }

        /* ✅ Элемент списка */
        .trust-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 120px; /* 🔹 Минимальная ширина */
        }

        /* ✅ Цифры вместо иконок */
        .trust-item .number {
            font-size: 2rem;
            font-weight: bold;
            color: #345AED;
            background: rgba(52, 90, 237, 0.1);
            padding: 15px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* ✅ Стрелки */
        .arrow {
            font-size: 2rem;
            color: #345AED;
        }

        /* 📌 Адаптивность */
        @media (max-width: 768px) {
            .trust-list {
                flex-wrap: wrap; /* 🔹 Позволяем перенос на мобильных */
                gap: 10px;
            }

            .arrow {
                display: none; /* 🚀 Убираем стрелки на мобильных */
            }
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /*Форма обратной связи*/ 
        #contact-section {
            background-image: url('/storage/banners/edit the image to remove the word _Корзина_ and resize it to 1107 x 113.8.png'); /* Укажи путь к изображению */
            background-size: cover; /* Масштабирование */
            background-position: center; /* Центрирование */
            background-repeat: no-repeat; /* Без повторений */
            padding: 60px 0; /* Отступы */
        }

        .contact-form {
            background: rgba(255, 255, 255, 0.85); /* Полупрозрачный фон для читаемости */
            border-radius: 12px; /* Закругленные края */
            padding: 30px;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15); /* Легкая тень */
        }
        .contact-form .form-group input,
        .contact-form .form-group textarea {
            border-radius: 8px; /* Закругленные поля */
            border: 1px solid #ccc; /* Легкая граница */
            padding: 12px;
            font-size: 16px;
        }
        /* ✅ Кнопка отправки */
        .contact-form .btn-primary {
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 24px;
            transition: 0.3s;
        }

        /* ✅ Эффект при наведении */
        .contact-form .btn-primary:hover {
            background-color: #0056b3;
        }

        /* ✅ Улучшение читаемости на мобильных */
        @media (max-width: 767.98px) {
            .contact-form {
                padding: 20px;
            }
            .contact-form .form-group input,
            .contact-form .form-group textarea {
                font-size: 14px;
            }
        }
        .contact-section .img {
            width: 100%;
            background-position: top center; 
        }

        .contact-section .contact-info p a {
            color: #4b69bd; 
        }

        .contact-section .contact-form {
            width: 100%; 
        }
        @media (max-width: 767.98px) {
            .contact-section .contact-form .btn-primary {
                display: block;
                width: 100%; 
            } 
        }

        .contact-section .box {
            width: 100%; 
        }
        .contact-section .box h3 {
            font-size: 20px; 
        }
        .contact-section .box .icon {
            margin-top: 5px; 
        }
        .contact-section .box .icon span {
            color: #4b69bd; 
        }

        /* 📌 Основные стили иконок */
        .icon i {
            font-size: 2rem; /* Увеличенный размер */
            color: #007bff; /* Синий цвет */
        }

        /* ✅ Адаптивность */
        @media (max-width: 768px) {
            .icon i {
                font-size: 1.8rem; /* Чуть меньше на мобильных */
            }
        }

        .img-fluid {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
        }
    </style>
    <body>
        <header class="hero-section text-center text-white">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->alt_text }}">
                        </div>
                    @endforeach
                </div>
                <!-- Навигация -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>    
        </header>
         <!-- 🔹 О нас -->
        <section id="about" class="py-5 bg-light">
            <div class="container text-center">
                <h2>О нас</h2>
                <p>Наша компания предлагает современные решения для видеонаблюдения, охранных систем и контроля доступа.</p>
            </div>
        </section>

        <section class="company-section">
            <div class="container">
                <div class="row align-items-left">
                    <!-- ✅ Левая колонка (Описание компании) -->
                    <div class="col-md-7 company-info">
                        <h2 class="company-title">ОАО "Сиситемы охраны и безопасности"</h2>
                        <p>Современные системы безопасности – необходимая защита для бизнеса, жилых комплексов и общественных пространств. Мы предлагаем широкий ассортимент видеокамер, надежные шлагбаумы и функциональные турникеты, которые помогут обеспечить контроль доступа и безопасность на объекте.</p>
                        <p>Мы гарантируем качественный сервис, гибкую систему рассрочки и индивидуальный подход к каждому клиенту. Безопасность начинается с правильного выбора!</p>
                        <a href="/kompaniya" class="btn-learn-more">Подробнее &gt;</a>
                    </div>

                    <!-- ✅ Правая колонка (Ресурсы DiplomMax) -->
                    <div class="col-md-5 company-resources">
                        <h4 class="resources-title">Наши ресурсы:</h4>
                        <div class="resources-list">
                            <div class="resource-item">
                                <img src="/storage/svg/icon-factory.svg" alt="Icon Factory">
                                <p>Предлагаем широкий ассортимент видеокамер, шлагбаумов и турникетов от ведущих производителей. Надежные решения для контроля доступа и безопасности на любых объектах</p>
                            </div>
                            <div class="resource-item">
                                <img src="/storage/svg/icon-team.svg" alt="Icon Team">
                                <p>Проводим диагностику, настройку и восстановление работоспособности систем. Оперативный ремонт видеокамер, шлагбаумов и турникетов с гарантией качества</p>
                            </div>
                            <div class="resource-item">
                                <img src="/storage/svg/icon-robot.svg" alt="Icon Robot">
                                <p>Наши специалисты выполняют монтаж и настройку оборудования с учетом технических требований и индивидуальных особенностей объекта</p>
                            </div>
                            <div class="resource-item">
                                <img src="/storage/svg/icon-brain.svg" alt="Icon Brain">
                                <p>Помогаем выбрать оптимальные решения для защиты и удобства, учитывая специфику вашего пространства и бюджет</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="trust-section">
            <div class="container">
                <h2 class="trust-title">Нам доверяют</h2>

                <div class="trust-list">
                    <div class="trust-item">
                        <div class="number">1</div>
                        <p>Лояльность <br> к клиентам</p>
                    </div>
                    <div class="arrow">→</div>
                    <div class="trust-item">
                        <div class="number">2</div>
                        <p>Система <br> Рассрочки</p>
                    </div>
                    <div class="arrow">→</div>
                    <div class="trust-item">
                        <div class="number">3</div>
                        <p>Комплексный <br> подход «от и до»</p>
                    </div>
                    <div class="arrow">→</div>
                    <div class="trust-item">
                        <div class="number">4</div>
                        <p>Беремся за самые <br> сложные проекты</p>
                    </div>
                    <div class="arrow">→</div>
                    <div class="trust-item">
                        <div class="number">5</div>
                        <p>Делаем <br> в срок</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 🔹 Почему выбирают нас? -->
        <section id="features" class="py-5 bg-light">
            <div class="container text-center">
                <h2>Почему выбирают нас?</h2>
                <div class="features">
                    <div class="feature-item">
                        <h3>10+ лет опыта</h3>
                        <p>Мы работаем на рынке безопасности более 10 лет.</p>
                    </div>
                    <div class="feature-item">
                        <h3>Качественное оборудование</h3>
                        <p>Надежные продукты от ведущих производителей.</p>
                    </div>
                    <div class="feature-item">
                        <h3>Сотни довольных клиентов</h3>
                        <p>Наши решения помогают сотням компаний.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-services-2 bg-light" id="services-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
                    <div class="col-md-12 heading-section text-center ftco-animate">
                        <h2 class="mb-4">Услуги</h2>
                        <p>Наша компания может предоставить вам следующие услуги</p>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services text-center d-block">
                        <div class="icon justify-content-center align-items-center d-flex"><span class="flaticon-pin"><i class="bi bi-tools"></i></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Ремонт оборудования</h3>
                            <p>Профессиональный ремонт и техническое обслуживание оборудования</p>
                        </div>
                        </div>      
                    </div>
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services text-center d-block mt-lg-5 pt-lg-4">
                        <div class="icon justify-content-center align-items-center d-flex"><span class="flaticon-detective"><i class="bi bi-cart"></i></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Продажа оборудования</h3>
                            <p>Широкий ассортимент качественного оборудования для любых задач</p>
                        </div>
                        </div>      
                    </div>
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services text-center d-block">
                        <div class="icon justify-content-center align-items-center d-flex"><span class="flaticon-house"><i class="bi bi-wrench"></i></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Установка оборудования</h3>
                            <p>Гарантированная точность и надежность при установке оборудования</p>
                        </div>
                        </div>      
                    </div>
                    <div class="col-md d-flex align-self-stretch ftco-animate">
                        <div class="media block-6 services text-center d-block mt-lg-5 pt-lg-4">
                        <div class="icon justify-content-center align-items-center d-flex"><span class="flaticon-purse"><i class="bi bi-question-circle"></i></span></div>
                        <div class="media-body">
                            <h3 class="heading mb-3">Помощь в выборе оборудования</h3>
                            <p>Экспертные консультации по подбору оборудования под ваши потребности</p>
                        </div>
                        </div>      
                    </div>
                </div>
			</div>
		</section>

        <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
            <div class="container">
                <div class="row justify-content-center mb-5 pb-3">
                    <div class="col-md-7 heading-section text-center ftco-animate">
                        <h2 class="mb-4">Связаться с нами</h2>
                        <p>Если есть какие-то вопросы, мы обязательно вам ответим</p>
                    </div>
                </div>

                <div class="row block-9">
                    <div class="col-md-7 order-md-last d-flex ftco-animate">
                        <form action="{{ route('contact.send') }}" class="bg-light p-4 p-md-5 contact-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Ваше имя">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Ваш Email">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Сообщение"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Отправить" class="btn btn-primary py-3 px-5">
                            </div>
                        </form>
                    </div>

                    <div class="col-md-5 d-flex">
                        <div class="row d-flex contact-info mb-5">
                            <div class="col-md-12 ftco-animate">
                                <div class="box p-2 px-3 bg-light d-flex">
                                    <div class="icon mr-3">
                                        <span class="icon-map-signs"><i class="bi bi-buildings"></i></span>
                                    </div>
                                    <div>
                                        <h3 class="mb-3">Адрес</h3>
                                        <p>улица Новооктябрьская 14</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ftco-animate">
                                <div class="box p-2 px-3 bg-light d-flex">
                                    <div class="icon mr-3">
                                        <span class="icon-phone2"><i class="bi bi-telephone"></i></span>
                                    </div>
                                    <div>
                                        <h3 class="mb-3">Телефон</h3>
                                        <p><a href="tel://1234567920">+375 (33) 872-98-23</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ftco-animate">
                                <div class="box p-2 px-3 bg-light d-flex">
                                    <div class="icon mr-3">
                                        <span class="icon-paper-plane"><i class="bi bi-envelope-at"></i></span>
                                    </div>
                                    <div>
                                        <h3 class="mb-3">Email</h3>
                                        <p><a href="mailto:info@yoursite.com">scudsecurity01@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ftco-animate">
                                <div class="box p-2 px-3 bg-light d-flex">
                                    <div class="icon mr-3">
                                        <span class="icon-globe"></span>
                                    </div>
                                    <div>
                                        <h3 class="mb-3">Website</h3>
                                        <p><a href="#">yoursite.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="map-wrapper">
            <iframe class="map-container" 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1181.910177261272!2d23.82808030338474!3d53.66800324047914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dfd62d208ddc01%3A0x9bab964eacca9d5e!2sHotel%20%22Eleon%22!5e0!3m2!1sru!2sby!4v1746891778108!5m2!1sru!2sby"
                allowfullscreen="" loading="lazy">
            </iframe>
        </div>

        <section id="projects" class="py-5 bg-light">
            <div class="container text-center">
                <h2 class="section-title">Наши выполненные <br> проекты</h2>

                <!-- ✅ Галерея -->
                <div class="gallery">
                    @if($projects->isEmpty())
                        <p class="text-danger">Нет выполненных работ</p>
                    @endif
                    @foreach ($projects->take(5) as $project)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="">
                    @endforeach
                </div>
                <!-- ✅ Кнопка -->
                <a href="{{ route('portfolio.portfolio') }}" class="btn-view-more">Смотреть больше работ</a>
            </div>
        </section>

        <section class="site-section" id="gallery-section" data-aos="fade">
            <div class="container">

                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <h2 class="section-title mb-3">Наши клиенты</h2>
                    </div>
                </div>

                <div id="posts" class="row no-gutter">
                    @foreach ($partners as $partner)
                        <div class="item web col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">
                            <a href="https://proflink.by/wp-content/uploads/2022/06/Rectangle-3.png" class="item-wrap fancybox">
                                <span class="icon-search2"></span>
                                <img class="img-fluid" src="{{ asset('storage/' . $partner->image) }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- 🔹 Скрипты -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                new Swiper('.swiper-container', {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    grabCursor: true,
                });
            });
        </script>
    </body>
@endsection