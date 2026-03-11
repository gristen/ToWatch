@extends('components.admin.app')

@section('content')
    <div class="admin-wrapper">
        <!-- Прелоадер (загрузка) -->
        <div class="preloader">
            <div class="spinner"></div>
        </div>

        <div class="container-fluid">
            <div class="row">

                @include('components.admin.sidebar')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                    <!-- Хедер с приветствием -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 header-gradient">
                        <div>
                            <h1 class="h2 mb-1">
                                <i class="fas fa-chart-pie me-2"></i>
                                Приборная панель
                            </h1>

                        </div>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-share-alt me-1"></i>Поделиться
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-download me-1"></i>Экспорт
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Статистика в карточках -->
                    <div class="row g-3 mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card stat-card-primary">
                                <div class="stat-card-inner">
                                    <div class="stat-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-label">Пользователи</span>
                                        <h3 class="stat-value">{{$DashboardData['totalUsers']}}</h3>
                                        <span class="stat-change positive">
                                        <i class="fas fa-arrow-up"></i> +12.5%
                                    </span>
                                    </div>
                                </div>
                                <div class="stat-card-footer">
                                    <span class="text-white-50">За последний месяц</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card stat-card-success">
                                <div class="stat-card-inner">
                                    <div class="stat-icon">
                                        <i class="fas fa-film"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-label">Фильмы</span>
                                        <h3 class="stat-value">856</h3>
                                        <span class="stat-change positive">
                                        <i class="fas fa-arrow-up"></i> +5.2%
                                    </span>
                                    </div>
                                </div>
                                <div class="stat-card-footer">
                                    <span class="text-white-50">Активных</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card stat-card-info">
                                <div class="stat-card-inner">
                                    <div class="stat-icon">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-label">Комментарии</span>
                                        <h3 class="stat-value">3,421</h3>
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
                                        <h3 class="stat-value">4.8</h3>
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
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Скачать</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Печать</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="myChart" class="chart-canvas"></canvas> {{----}}
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
                                                <small class="text-muted"><i class="far fa-clock me-1"></i>5 минут назад</small>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent text-center">
                                    <a href="#" class="btn btn-sm btn-link">Все активности <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Таблица с данными -->
                    <div class="card card-dashboard">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-table me-2 text-success"></i>
                                <h5 class="card-title mb-0">Последние регистрации</h5>
                            </div>
                            <div class="card-actions">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Поиск...">
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4" width="50">#</th>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Дата регистрации</th>
                                        <th>Статус</th>
                                        <th class="text-end pe-4">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="ps-4">1</td>
                                        <td><span class="badge bg-secondary">233</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial bg-primary rounded-circle me-2">E</div>
                                                example@mail.ru
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="user-status online me-2"></span>
                                                gristen
                                            </div>
                                        </td>
                                        <td>12-02-2025</td>
                                        <td><span class="badge badge-soft-success">Активен</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-icon btn-outline-primary" title="Редактировать">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-info" title="Просмотр">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-danger" title="Удалить">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4">2</td>
                                        <td><span class="badge bg-secondary">234</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial bg-success rounded-circle me-2">J</div>
                                                john@example.com
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="user-status online me-2"></span>
                                                john_doe
                                            </div>
                                        </td>
                                        <td>11-02-2025</td>
                                        <td><span class="badge badge-soft-success">Активен</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-icon btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4">3</td>
                                        <td><span class="badge bg-secondary">235</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial bg-warning rounded-circle me-2">J</div>
                                                jane@example.com
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="user-status offline me-2"></span>
                                                jane_smith
                                            </div>
                                        </td>
                                        <td>10-02-2025</td>
                                        <td><span class="badge badge-soft-warning">Ожидает</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-icon btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4">4</td>
                                        <td><span class="badge bg-secondary">236</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial bg-info rounded-circle me-2">M</div>
                                                mike@example.com
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="user-status busy me-2"></span>
                                                mike_wilson
                                            </div>
                                        </td>
                                        <td>09-02-2025</td>
                                        <td><span class="badge badge-soft-success">Активен</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-icon btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-icon btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm justify-content-center mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Тостер уведомлений -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-check-circle text-success me-2"></i>
                <strong class="me-auto">Успешно</strong>
                <small>только что</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Данные успешно обновлены!
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
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Скрываем прелоадер
                setTimeout(() => {
                    document.querySelector('.preloader').style.opacity = '0';
                    setTimeout(() => {
                        document.querySelector('.preloader').style.display = 'none';
                    }, 500);
                }, 1000);

                // Градиент для графика
                const ctx = document.getElementById('myChart').getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(78, 115, 223, 0.3)');
                gradient.addColorStop(1, 'rgba(78, 115, 223, 0)');

                const monthlyData = @json(array_values($DashboardData['monthlyRegistration']));


                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
                        datasets: [{
                            label: 'Регистрации',
                            data: monthlyData,
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

                // Кнопка обновления графика
                document.getElementById('refreshChart')?.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    icon.classList.add('fa-spin');

                    // Показываем тост
                    const toast = new bootstrap.Toast(document.getElementById('liveToast'));
                    toast.show();

                    setTimeout(() => {
                        icon.classList.remove('fa-spin');
                    }, 1000);
                });
            });
        </script>
    @endpush
@endsection
