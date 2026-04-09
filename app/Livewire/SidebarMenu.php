<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarMenu extends Component
{
    public $menu = [
        ['title' => 'Главная', 'icon' => 'bi-speedometer2', 'route' => 'admin.dashboard','active_routes' => 'admin.dashboard'],
//        ['title' => 'Пользователи', 'icon' => 'bi-people', 'route' => 'admin.dashboard', 'active_routes' => 'admin.dashboard.*'],
//        ['title' => 'Фильмы', 'icon' => 'bi-film', 'route' => 'admin.dashboard', 'active_routes' => 'admin.dashboard.*'],
        ['title' => 'Роли', 'icon' => 'bi-shield-lock', 'route' => 'admin.roles.index', 'active_routes' => 'admin.roles.*'],
//        ['title' => 'Категории', 'icon' => 'bi-tags', 'route' => 'admin.categories.index', 'active_routes' => 'admin.categories.*'],
//        ['title' => 'Комментарии', 'icon' => 'bi-chat-dots', 'route' => 'admin.comments.index', 'active_routes' => 'admin.comments.*'],
//        ['title' => 'Рейтинги', 'icon' => 'bi-star', 'route' => 'admin.ratings.index', 'active_routes' => 'admin.ratings.*'],
//        ['title' => 'Аналитика просмотров', 'icon' => 'bi-graph-up', 'route' => 'admin.analytics.index', 'active_routes' => 'admin.analytics.*'],
        ['title' => 'Задачи', 'icon' => 'bi-check2-square', 'route' => 'admin.tasks.index', 'active_routes' => 'admin.tasks.*'],
//        ['title' => 'Логи действий', 'icon' => 'bi-journal-text', 'route' => 'admin.logs.index', 'active_routes' => 'admin.logs.*'],
    ];



    public function render()
    {
        return view('livewire.admin.components.sidebar-menu');
    }
}
