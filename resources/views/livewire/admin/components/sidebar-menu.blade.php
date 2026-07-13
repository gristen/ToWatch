<div>
    <nav id="sidebarMenu"
         class="col-md-3 col-lg-2 d-md-block bg-dark sidebar d-flex flex-column"
        >

        <div class="position-sticky pt-3 flex-grow-1">

            <ul class="nav flex-column">

                @foreach($this->menu as $item)
                    <li class="nav-item">
                        <a wire:current="active"
                           wire:navigate
                           class="nav-link {{ request()->routeIs($item['active_routes'] ?? $item['route']) ? 'active' : '' }}"
                           href="{{ route($item['route']) }}">

                            <i class="bi {{ $item['icon'] }} me-2"></i>
                            {{ $item['title'] }}
                        </a>
                    </li>
                @endforeach
                    <a
                       class="nav-link "
                       href="{{route('log-viewer.index')}}"
                    target="__blank">

                        <i class="bi bi-journal-text me-2"></i>
                        logs
                    </a>
            </ul>

        </div>

        <div class="p-3 border-top border-secondary mt-auto position-absolute bottom-0">

            <a href="{{ route('profile.show', auth()->user()->id) }}"
               class="d-flex align-items-center text-decoration-none text-white">

                <!-- avatar -->
                <img src="{{
                           auth()->user()->avatar ? asset('storage/'. auth()->user()->avatar) : asset('assets/profile.jpg')
                             }}"
                     class="rounded-circle me-2"
                     width="40"
                     height="40"
                     style="object-fit: cover;">

                <!-- info -->
                <div class="flex-grow-1">
                    <div class="fw-semibold">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="text-muted small">
                        {{ auth()->user()->email }}
                    </div>
                </div>

            </a>

            <!-- logout -->
            <div class="mt-2">
                <a href="{{ route('logout') }}"
                   class="text-danger small text-decoration-none">
                    Выйти
                </a>
            </div>

        </div>

    </nav>
</div>
