<div class="col-xl-3 col-md-6">
    <div class="stat-card {{ $class }}">
        <div class="stat-card-inner">
            <div class="stat-icon">
                <i class="{{ $icon }}"></i>
            </div>

            <div class="stat-content">
                <span class="stat-label">{{ $label }}</span>
                <h3 class="stat-value">{{ $value }}</h3>
                @if(!empty($change))
                    <span class="stat-change {{ $changeType }}">
                        <i class="fas fa-arrow-up"></i> {{ $change }}
                    </span>
                @endif
            </div>
        </div>

        <div class="stat-card-footer">
            <span class="text-white-50">{{ $footer }}</span>
        </div>
    </div>
</div>
