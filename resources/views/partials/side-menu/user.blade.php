<li class="nav-item">
    <a class="nav-link" href="{{ route('user.dashboard') }}" aria-expanded="false"><i class="mdi mdi-highway"></i>Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ (request()->is('packages/*')) ? 'active' : '' }}" href="{{ route('user.packages.index') }}" aria-expanded="false"><i class="mdi mdi-chart-line"></i>Investment</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ (request()->is('investments/*')) ? 'active' : '' }}" href="{{ route('user.investments.index') }}" aria-expanded="false"><i class="mdi mdi-highway"></i>My Investments</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('user.transfers.index') }}" aria-expanded="false"><i class="mdi mdi-highway"></i>Transfer</a>
</li>
<li class="nav-item ">
    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Withdrawals</a>
    <div id="submenu-1" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.withdraws.create') }}">Withdraw</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.withdraws.pending') }}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.withdraws.approved') }}">Approved</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('user.wallet.index') }}" aria-expanded="false"><i class="mdi mdi-highway"></i>Wallet History</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('user.wallet.index') }}" aria-expanded="false"><i class="mdi mdi-highway"></i>Loans</a>
</li>
