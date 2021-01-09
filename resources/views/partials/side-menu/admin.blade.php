<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i
            class="mdi mdi-highway"></i>Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1"
        aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Packages</a>
    <div id="submenu-1" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.packages.index') }}">All packages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.packages.create') }}">Create package</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2"
        aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle"></i>Investments</a>
    <div id="submenu-2" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.investments.adminindex') }}">View</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.investments.pending') }}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.investments.declined') }}">Declined</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3"
        aria-controls="submenu-3"><i class="fa fa-fw fa-user-circle"></i>Withdrawals</a>
    <div id="submenu-3" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.withdraws.pending') }}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.withdraws.approved') }}">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.withdraws.declined') }}">Declined</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4"
        aria-controls="submenu-4"><i class="fa fa-fw fa-user-circle"></i>Loans</a>
    <div id="submenu-4" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
            <a class="nav-link" href="{{route('admin.loans.pending')}}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.loans.approved')}}">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.loans.declined')}}">Declined</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('admin.loans.completed')}}">Completed</a>
            </li> --}}
        </ul>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5"
        aria-controls="submenu-5"><i class="fa fa-fw fa-user-circle"></i>Membership</a>
    <div id="submenu-5" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.membership.index') }}">View</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.membership.active') }}">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.membership.inactive') }}">In-active</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5"
        aria-controls="submenu-5"><i class="fa fa-fw fa-user-circle"></i>Roles & Permission</a>
    <div id="submenu-5" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.membership.index') }}">View</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.membership.active') }}">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.membership.inactive') }}">In-active</a>
            </li>
        </ul>
    </div>
</li>
