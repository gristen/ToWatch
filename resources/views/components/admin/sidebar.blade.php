@php
    $menu = [
['title' => 'Главная', 'icon' => 'bi-speedometer2', 'route' => 'admin.dashboard'],
        ['title' => 'Пользователи', 'icon' => 'bi-people', 'route' => 'admin.dashboard', 'active_routes' => 'admin.dashboard'],
        ['title' => 'Фильмы', 'icon' => 'bi-film', 'route' => 'admin.dashboard', 'active_routes' => 'admin.dashboard'],
        ['title' => 'Роли', 'icon' => 'bi-shield-lock', 'route' => 'admin.roles.index', 'active_routes' => 'admin.roles.*'],
//        ['title' => 'Категории', 'icon' => 'bi-tags', 'route' => 'admin.categories.index', 'active_routes' => 'admin.categories.*'],
//        ['title' => 'Комментарии', 'icon' => 'bi-chat-dots', 'route' => 'admin.comments.index', 'active_routes' => 'admin.comments.*'],
//        ['title' => 'Рейтинги', 'icon' => 'bi-star', 'route' => 'admin.ratings.index', 'active_routes' => 'admin.ratings.*'],
//        ['title' => 'Аналитика просмотров', 'icon' => 'bi-graph-up', 'route' => 'admin.analytics.index', 'active_routes' => 'admin.analytics.*'],
//        ['title' => 'Задачи', 'icon' => 'bi-check2-square', 'route' => 'admin.tasks.index', 'active_routes' => 'admin.tasks.*'],
//        ['title' => 'Логи действий', 'icon' => 'bi-journal-text', 'route' => 'admin.logs.index', 'active_routes' => 'admin.logs.*'],
        ];
@endphp


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">

            @foreach($menu as $item)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs($item['active_routes'] ?? $item['route']) ? 'active' : '' }}" href="{{ route($item['route']) }}">
                        <i class="bi {{ $item['icon'] }} me-2"></i>
                        {{$item['title']}}
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</nav>
