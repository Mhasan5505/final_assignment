<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a style="text-decoration: none" href="{{ route('admin.users') }}">Users</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a style="text-decoration: none" href="#">Jobs</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a style="text-decoration: none" href="#">Jobs Applications</a>
            </li>  
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a style="text-decoration: none" href="{{ route('account.logout') }}">Logout</a>
            </li>                                                     
        </ul>
    </div>
</div>