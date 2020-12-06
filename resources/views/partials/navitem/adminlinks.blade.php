<li class="nav-item ">
    <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Email System </a>
    <div id="submenu-1" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Inbox</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Compose Email</a>
            </li>
        </ul>
    </div>
</li>


<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle"></i>Member </a>
    <div id="submenu-2" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">All member</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Create Memeber</a>
            </li>
        </ul>
    </div>
</li>



<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fa fa-fw fa-user-circle"></i>News section </a>
    <div id="submenu-3" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3-2" aria-controls="submenu-3-2">News</a>
                <div id="submenu-3-2" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">All news</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Create news</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tags</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fa fa-fw fa-user-circle"></i>Ptc Ads</a>
    <div id="submenu-4" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">All PTC Ads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Create PTC Ads</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-15" aria-controls="submenu-15"><i class="fa fa-fw fa-user-circle"></i>PPV Ads</a>
    <div id="submenu-15" class="collapse submenu" style="">
       
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">All Video Ads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Create Video Ads</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fa fa-fw fa-user-circle"></i>Investment Section</a>
    <div id="submenu-5" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
            <a class="nav-link {{ (request()->is('/plan/*')) ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5-1" aria-controls="submenu-5-1">Plan</a>
                <div id="submenu-5-1" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('plan.index') }}">All plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('plan.create') }}">Create plan</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('investment-style.index')}}">Style</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"> Investments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Members Investments</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" ><i class="fa fa-fw fa-user-circle"></i>Instant gateways</a>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fa fa-fw fa-user-circle"></i>Offline gateways</a>
    <div id="submenu-7" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">All local gateway</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Create local gateway</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fa fa-fw fa-user-circle"></i>Membership</a>
    <div id="submenu-8" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">All membership</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Create Membership</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fa fa-fw fa-user-circle"></i>Deposit area</a>
    <div id="submenu-9" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Deposit request</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fa fa-fw fa-user-circle"></i>Withdraw area</a>
    <div id="submenu-10" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Completed Withdraw</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Withdraw request</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11"><i class="fa fa-fw fa-user-circle"></i>Support area</a>
    <div id="submenu-11" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">All open request</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">All close ticket</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-12" aria-controls="submenu-12"><i class="fa fa-fw fa-user-circle"></i>KYC area</a>
    <div id="submenu-12" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Identity verify request</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Address verify request</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-13" aria-controls="submenu-13"><i class="fa fa-fw fa-user-circle"></i>Website toolkit</a>
    <div id="submenu-13" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Testimonials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Website F.A.Q</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Website Page</a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item ">
    <a class="nav-link " href="#" ><i class="fa fa-fw fa-user-circle"></i>Settings</a>
</li>

<li class="nav-item ">
    <a class="nav-link " href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-14" aria-controls="submenu-14"><i class="fa fa-fw fa-user-circle"></i>left</a>
    <div id="submenu-14" class="collapse submenu" style="">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
        </ul>
    </div>
</li>