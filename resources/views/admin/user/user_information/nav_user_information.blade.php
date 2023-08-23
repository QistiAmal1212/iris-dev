<ul class="nav nav-pills nav-justified" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder active" id="account-info-tab" data-bs-toggle="tab" href="#account-info" aria-controls="account-info" role="tab" aria-selected="true">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            Akaun
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder" id="security-info-tab" data-bs-toggle="tab" href="#security-info" aria-controls="security-info" role="tab" aria-selected="true">
            <i class="fa fa-lock" aria-hidden="true"></i>
            Keselamatan
        </a>
    </li>
</ul>

<div class="tab-content bukanKptContent" id="bukanKptContent">
    <div class="tab-pane fade show active" id="account-info" role="tabpanel" aria-labelledby="account-info-tab">
        @include('admin.user.user_information.account')
    </div>
    <div class="tab-pane fade" id="security-info" role="tabpanel" aria-labelledby="security-info-tab">
        @include('admin.user.user_information.security')
    </div>
</div>
