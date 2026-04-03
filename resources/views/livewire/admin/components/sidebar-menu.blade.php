<div>
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
        <div class="position-sticky pt-3">
            <ul class="nav flex-column">
                @foreach($this->menu as $item)
                    <li class="nav-item">
                        <a wire:current="active" wire:navigate class="nav-link  {{ request()->routeIs($item['active_routes'] ?? $item['route']) ? 'active' : '' }}" href="{{ route($item['route']) }}">
                            <i class="bi {{ $item['icon'] }} me-2"></i>
                            {{$item['title']}}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    </nav>
</div>
