<nav id="sidebar">
    <div class="sidebar-header">
        <h3>{{ appName() }}</h3>
        <strong>TK</strong>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ activeMenu('frontend.user.dashboard') }}">
            <a href="{{ route('frontend.user.dashboard') }}">
                <i class="fas fa-book"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="{{ activeMenu('frontend.user.subscription.*') }}">
            <a href="{{ route('frontend.user.subscription.index') }}">
                <i class="fa fa-bookmark"></i>
                Subcription
            </a>
        </li>
        <li class="{{ activeMenu('frontend.user.transaction.*') }}">
            <a href="{{ route('frontend.user.transaction.index') }}">
                <i class="fa fa-credit-card"></i>
                Transaksi
            </a>
        </li>
    </ul>
</nav>
