<li class="nav-item">
<a class="nav-link {{(request()->is('packages/*')) ? 'active' : ''}}" href="{{route('packages.index')}}" aria-expanded="false"><i class="mdi mdi-chart-line"></i>Investment
        Plan</a>
</li>
{{-- <li class="nav-item">
<a class="nav-link {{ (request()->is('deposit/*')) ? 'active' : '' }}" href="{{route('deposit.create')}}" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i>Cash
        Deposit</a>
</li> --}}
{{-- <li class="nav-item">
    <a class="nav-link" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i>Cash
        Withdrawal</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i>My
        Referrals & Link</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" aria-expanded="false"><i class="mdi mdi-transfer"></i>Fund
        Transfer</a>
</li> --}}
<li class="nav-item">
<a class="nav-link {{(request()->is('investments/*')) ? 'active' : ''}}" href="{{route('investments.index')}}" aria-expanded="false"><i class="mdi mdi-highway"></i>My
        Investments</a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link" href="#" aria-expanded="false"><i class="mdi mdi-history"></i>Interests
        History</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" aria-expanded="false"><i class="mdi mdi-history"></i>Deposit
        History</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" aria-expanded="false"><i
            class="mdi mdi-format-rotate-90"></i>Withdraw History</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#" aria-expanded="false"><i class="mdi mdi-phone-incoming"></i>Earning
        History</a>
</li> --}}