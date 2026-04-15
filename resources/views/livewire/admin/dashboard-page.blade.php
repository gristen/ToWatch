<div>
    <div class="admin-wrapper">
        <!-- Прелоадер (загрузка) -->
        <div class="preloader">
            <div class="spinner"></div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <x-admin.header title="Дашборд панель"></x-admin.header>
                <!-- Статистика в карточках -->
                <div class="row g-3 mb-4">
                    <x-admin.stat-card
                        class="stat-card-primary"
                        icon="fas fa-users"
                        label="Пользователи"
                        :value="$DashboardData['currentMonthUser']['current']"
                        :change="$DashboardData['currentMonthUser']['percent'].'%'"
                        changeType="positive"
                        footer="За последний месяц"
                    />
                    <x-admin.stat-card
                        class="stat-card-success"
                        icon="fas fa-film"
                        label="Фильмов"
                        :value="$DashboardData['totalMovies']"

                        changeType="positive"
                        footer="Всего фильмов"
                    />
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card stat-card-info">
                            <div class="stat-card-inner">
                                <div class="stat-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-label">Комментарии</span>
                                    <h3 class="stat-value">{{$DashboardData['totalReviews']}}</h3>
                                    <span class="stat-change positive">
                                        <i class="fas fa-arrow-up"></i> +23%
                                    </span>
                                </div>
                            </div>
                            <div class="stat-card-footer">
                                <span class="text-white-50">12 новых</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card stat-card-warning">
                            <div class="stat-card-inner">
                                <div class="stat-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-label">Рейтинги</span>
                                    <h3 class="stat-value">{{$DashboardData['avgRating'] ?? '0'}}</h3>
                                    <span class="stat-change positive">
                                        <i class="fas fa-arrow-up"></i> +0.3
                                    </span>
                                </div>
                            </div>
                            <div class="stat-card-footer">
                                <span class="text-white-50">Средний балл</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- График и активность -->
                <div class="row g-3 mb-4">
                    <div class="col-lg-8">
                        <div class="card card-dashboard">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chart-line me-2 text-primary"></i>
                                    <h5 class="card-title mb-0">Статистика регистраций за год</h5>
                                </div>
                                <div class="card-actions">
                                    <button class="btn btn-sm btn-outline-secondary" id="refreshChart">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Скачать</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="fas fa-print me-2"></i>Печать</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas wire:ignore id="myChart" class="chart-canvas"></canvas> {{----}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-dashboard h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-bell me-2 text-warning"></i>
                                    <h5 class="card-title mb-0">Последние активности</h5>
                                </div>
                                <span class="badge bg-primary">3 новых</span>
                            </div>
                            <div class="card-body p-0">
                                <div class="activity-timeline">

                                    @foreach($DashboardData['activities'] as $activity)
                                        <div class="timeline-item">
                                            <div class="timeline-icon bg-primary">
                                                <i class="fas {{$activity->getIcon()}} "></i>
                                            </div>
                                            <div class="timeline-content">
                                                <p class="mb-1"> {{$activity->description}}</p>
                                                <small class="text-muted"><i
                                                        class="far fa-clock me-1"></i>{{$activity->created_at->diffForHumans()}}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer bg-transparent text-center">
                                <a href="#" class="btn btn-sm btn-link">Все активности <i
                                        class="fas fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <livewire:admin.components.table
                    :model="\App\Models\User::class"
                    title="Пользователи"
                    :searchColumns="['email','name']"
                    :actions="[
                      'delete'=>'admin.user.destroy'
                    ]"
                    :columns="[
                    ['field' => 'email', 'label' => 'Email'],
                    ['field' => 'name', 'label' => 'Username'],
                    ['field' => 'created_at', 'label' => 'Дата регистрации'],
                    [
                    'field' => 'role.name',
                    'label' => 'Роль',
                    'sortable' => true,
                    'relation' => 'role',
                    'table' => 'roles',
                    'foreign_key' => 'role_id'
                    ]
                    ]"

                />
            </div>
        </div>
    </div>


    @push('styles')
        <style>
            /* Дополнительные стили для прелоадера */
            .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #fff;
                z-index: 9999;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: opacity 0.5s;
            }

            .spinner {
                width: 50px;
                height: 50px;
                border: 5px solid #f3f3f3;
                border-top: 5px solid #4e73df;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            let chart = null;

            // Функция инициализации графика
            function initChart(data) {
                const canvas = document.getElementById('myChart');
                if (!canvas) return;

                const ctx = canvas.getContext('2d');

                // Удаляем старый график если есть
                if (chart) {
                    chart.destroy();
                }

                // Создаем градиент
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(78, 115, 223, 0.3)');
                gradient.addColorStop(1, 'rgba(78, 115, 223, 0)');

                // Создаем новый график
                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
                        datasets: [{
                            label: 'Регистрации',
                            data: data,
                            borderColor: '#4e73df',
                            backgroundColor: gradient,
                            borderWidth: 3,
                            pointBackgroundColor: '#4e73df',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#2c3e50',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: '#4e73df',
                                borderWidth: 1
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0,0,0,0.05)',
                                    drawBorder: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Инициализация при загрузке страницы
            document.addEventListener('DOMContentLoaded', function () {

                // Получаем данные из PHP
                const monthlyData = @json(array_values($DashboardData['monthlyRegistration']));

                // Инициализируем график
                initChart(monthlyData);
            });

            // Слушаем события Livewire
            document.addEventListener('livewire:navigated', function () {
                // Переинициализируем график после навигации
                const monthlyData = @json(array_values($DashboardData['monthlyRegistration']));
                initChart(monthlyData);
            });


        </script>
    @endpush
</div>
