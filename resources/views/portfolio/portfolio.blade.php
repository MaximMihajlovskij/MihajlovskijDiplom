@extends('base')

@section('portfolio')
<head>
    <style>
        .theme-bg-4 {
            background: #fff !important;
        }

        .project-item:before {
            background: linear-gradient(0deg,rgb(38, 61, 230) 0%, rgba(235, 117, 59, 0) 100%) !important;
        }
    </style>
</head>
    <!-- Breadcrumb area start  -->
    <div class="breadcrumb__area theme-bg-1 p-relative z-index-11 pt-95 pb-95" style="padding-top: 95px; padding-bottom: 95px;">
         <div class="breadcrumb__thumb" data-background="assets/imgs/bg/breadcrumb-bg.jpg"></div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xxl-12">
                  <div class="breadcrumb__wrapper text-center">
                     <h2 class="breadcrumb__title">Портфолио</h2>
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

      <!-- Project area start -->
        <section class="project-area theme-bg-4 section-space p-relative fix">
        <div class="container">
            <div class="row g-5">
                @if($projects->isEmpty())
                    <p class="text-danger">Нет выполненных работ</p>
                @endif
                @foreach ($projects as $project)
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="project-item">
                            <div class="project-thumb w-img">
                                <img src="{{ asset('storage/' . $project->image) }}" 
                                    data-project-id="{{ $project->id }}" 
                                    class="clickable-image" 
                                    alt="Проект">
                            </div>
                            <div class="project-content-inner">
                                <div class="project-content">
                                <span>Адрес</span>
                                <h4>ул.Новооктябрьская 14</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Модальное окно -->
                    <div class="modal fade" id="imageModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Просмотр изображения</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $project->image) }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach    
            </div>
        </div>
        </section>

      <!-- Project area end -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.clickable-image').forEach(img => {
                console.log("Обнаружено изображение:", img); // ✅ Проверка загрузки

                img.addEventListener('click', function() {
                    let modalId = '#imageModal' + this.dataset.projectId;
                    let modalElement = document.querySelector(modalId);

                    console.log("Нажатие на изображение:", this.src);
                    console.log("Ищем модальное окно:", modalId);
                    console.log("Найден элемент модального окна:", modalElement);

                    if (modalElement) {
                        modalElement.querySelector('.img-fluid').src = this.src;
                        console.log("Открываем модальное окно:", modalElement);
                        new bootstrap.Modal(modalElement).show();
                    } else {
                        console.error("❌ Модальное окно не найдено:", modalId);
                    }
                });
            });
        });
    </script>
@endsection