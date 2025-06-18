<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">Админ-панель</li>
          <h4 class="text-white">Пользователи</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.users') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Пользователи
                  <span class="badge badge-info right">{{ \App\Models\User::count() }}</span>
                </p>
              </a>
          </li>

          <h4 class="text-white">Оборудование</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.crudcamera') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Видеокамеры
                  <span class="badge badge-info right">{{ \App\Models\Camera::count() }}</span>
                </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.scud.turnikety') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Турникеты
                  <span class="badge badge-info right">{{ \App\Models\Turniket::count() }}</span>
                </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.scud.barrier') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Шлагбаумы
                  <span class="badge badge-info right">{{ \App\Models\Barrier::count() }}</span>
                </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ route('admin.scud.accessories') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Аксессуары
                  <span class="badge badge-info right">{{ \App\Models\Accessorie::count() }}</span>
                </p>
              </a>
          </li>

          <h4 class="text-white">Заявки</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.repaircamera') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Ремонт оборудования
                  <span class="badge badge-info right">{{ \App\Models\RepairCamera::count() }}</span>
                </p>
              </a>
          </li>

          <h4 class="text-white">Заказы</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.cart') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Заказы
                  <span class="badge badge-info right">{{ \App\Models\Cart::count() }}</span>
                </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('admin.scud.cartitem') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Заказанные товары
                  <span class="badge badge-info right">{{ \App\Models\CartItem::count() }}</span>
                </p>
              </a>
          </li>

          <h4 class="text-white">Отзывы</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.review') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Отзывы
                  <span class="badge badge-info right">{{\App\Models\Review::count()}}</span>
                </p>
              </a>
          </li>

          <h4 class="text-white">Фирмы</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.firms') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Фирмы
                  <span class="badge badge-info right">{{ \App\Models\Firm::count() }}</span>
                </p>
              </a>
          </li>

          <h4 class="text-white">Тех.характеристики</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.specification') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Технические характеристики
                  <span class="badge badge-info right">{{ \App\Models\Specification::count() }}</span>
                </p>
              </a>
          </li>

          <h4 class="text-white">Статусы</h4>
          <li class="nav-item">
              <a href="{{ route('admin.scud.status') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Статус срочности
                  <span class="badge badge-info right">{{ \App\Models\Status::count() }}</span>
                </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('admin.scud.complete') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Статус Выполнения
                  <span class="badge badge-info right">{{ \App\Models\Completed::count() }}</span>
                </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('admin.scud.action') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Статус ожидания
                  <span class="badge badge-info right">{{\App\Models\Action::count()}}</span>
                </p>
              </a>
          </li>

          <h2 class="text-white">Сайт</h2>
          <li class="nav-item">
              <a href="{{ route('admin.scud.sait.index.index') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Баннеры
                  <span class="badge badge-info right">{{ \App\Models\Banner::count() }}</span>
                </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('admin.scud.sait.index.partner') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Клиенты
                  <span class="badge badge-info right">{{ \App\Models\Partner::count() }}</span>
                </p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('admin.scud.sait.index.projects') }}" class="nav-link">
                <i class="nav-icon far fa-calendar-alt"></i>
                <p>
                  Портфолио
                  <span class="badge badge-info right">{{ \App\Models\Project::count() }}</span>
                </p>
              </a>
          </li>
        </ul>
      </nav>