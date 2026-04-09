<footer class="site-footer mt-5">
    <div class="container py-5">
        <div class="row">

            <!-- О проекте -->
            <div class="col-md-4 mb-4">
                <h6 class="footer-title">О проекте</h6>
                <p class="footer-text">
                    Платформа создана в обучающих целях.
                </p>
               {{-- <p class="footer-text">
                   Создано <a href="{{route('showByUsername',['username'=>'admin'])}}">gristen</a>
                </p>--}}

                <div class="footer-badges mt-3">
                    <span class="badge bg-dark">Laravel</span>
                    <span class="badge bg-dark">Livewire</span>
                    <span class="badge bg-dark">Bootstrap</span>
                </div>
            </div>

            <!-- Навигация -->
            <div class="col-md-4 mb-4">
                <h6 class="footer-title">Навигация</h6>
                <ul class="footer-links">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/movies">Фильмы</a></li>
                    <li><a href="/popular">Популярное</a></li>
                    <li><a href="/contacts">Контакты</a></li>
                </ul>
            </div>

            <!-- Контакты / соц -->
            <div class="col-md-4 mb-4">
                <h6 class="footer-title">Контакты</h6>

                <div class="footer-contact mb-3">
                    <div><i class="bi bi-envelope"></i> email@example.com</div>

                </div>

                <div class="footer-social">
                    <a href="https://github.com/" target="_blank">
                        <i class="bi bi-github"></i>
                    </a>
                    <a href="https://t.me/" target="_blank">
                        <i class="bi bi-telegram"></i>
                    </a>
                    <a href="https://youtube.com/" target="_blank">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="d-flex justify-content-between flex-wrap footer-bottom">
            <span>© {{ date('Y') }} Все права защищены.</span>

            <div class="footer-extra-links">
                <a href="#">Политика</a>
                <a href="#">Условия</a>
            </div>
        </div>
    </div>
</footer>
