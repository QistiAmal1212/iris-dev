<body class="vertical-layout vertical-menu-modern {{ $configData['verticalMenuNavbarType'] }} {{ $configData['blankPageClass'] }} {{ $configData['bodyClass'] }} {{ $configData['sidebarClass']}} {{ $configData['footerType'] }} {{$configData['contentLayout']}}"
    data-open="click"
    data-menu="vertical-menu-modern"
    data-col="{{$configData['showMenu'] ? $configData['contentLayout'] : '1-column' }}"
    data-framework="laravel"
    data-asset-path="{{ asset('/')}}"
    >

    <!-- BEGIN: Header-->
    @include('panels.navbar')
    <!-- END: Header-->

	<!-- BEGIN: Main Menu-->
	@if((isset($configData['showMenu']) && $configData['showMenu'] === true))
	    @include('panels.sidebar')
	@endif
	<!-- END: Main Menu-->

	<!-- BEGIN: Content-->
	<div class="app-content content {{ $configData['pageClass'] }}">
		<!-- BEGIN: Header-->
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>

		@if(($configData['contentLayout']!=='default') && isset($configData['contentLayout']))
            <div class="content-area-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
                <div class="{{ $configData['sidebarPositionClass'] }}">
                    <div class="sidebar">
                        {{-- Include Sidebar Content --}}
                        @yield('content-sidebar')
                    </div>
                </div>
                <div class="{{ $configData['contentsidebarClass'] }}">
                    <div class="content-wrapper">
                        <div class="content-body">
                            {{-- Include Page Content --}}
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
		@else
            <div class="content-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
                {{-- Include Breadcrumb --}}
                @if($configData['pageHeader'] === true && isset($configData['pageHeader']))
                @include('panels.breadcrumb')
                @endif

                <div class="content-body">
                    {{-- Include Page Content --}}
                    @yield('content')
                </div>
            </div>
		@endif

	</div>
	<!-- End: Content-->

    <!-- BEGIN: Modal-->
    @stack('modal')

    <div id="modal-div"></div>
    <!-- End: Modal-->

	<div class="modal fade text-start" id="modal-changepassword" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="title-role">Kemaskini Kata Laluan</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('profile-update-password-first') }}" method="POST" id="firstTimePasswordForm" data-reloadPage="true" data-refreshFunctionName="reloadCaptchaPassword">
						@csrf
						<div class="card-body" id="div_first_password">
							<div class="alert alert-danger" role="alert">
								<div class="alert-heading">
									<i class="fa fa-lock" aria-hidden="true"></i>
									Sila kemas kini kata laluan anda pada kali pertama log masuk
								</div>
							</div>
            				<div class="alert alert-warning mb-2" role="alert">
								<h6 class="alert-heading">
									<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
									Pastikan keperluan ini dipenuhi:
								</h6>
								<div class="alert-body fw-normal">
									Minimum panjang kata laluan adalah 12 huruf, kombinasi antara huruf besar dan kecil, karakter & nombor.
								</div>
							</div>

							<table class="table" width="100%">
								<tr>
									<td class="fw-bolder">Kata Laluan Semasa: </td>
									<td>
										<div class="input-group input-group-merge form-password-toggle">
											<input type="password" class="form-control" name="old_password" id="old_password" placeholder="············">
											<span class="input-group-text cursor-pointer">
												<i data-feather="eye"></i>
											</span>
										</div>
									</td>
								</tr>

								<tr>
									<td class="fw-bolder">Kata Laluan Baru: </td>
									<td>
										<div class="input-group input-group-merge form-password-toggle">
											<input type="password" class="form-control" name="new_password" id="new_password" placeholder="············">
											<span class="input-group-text cursor-pointer">
												<i data-feather="eye"></i>
											</span>
										</div>
									</td>
								</tr>

								<tr>
									<td class="fw-bolder">Sahkan Kata Laluan: </td>
									<td>
										<div class="input-group input-group-merge form-password-toggle">
											<input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="············">
											<span class="input-group-text cursor-pointer">
												<i data-feather="eye"></i>
											</span>
										</div>
									</td>
								</tr>
								<tr>
									<td class="fw-bolder">
										<div class="captcha">
											<span>{!! captcha_img() !!}</span>
										</div>
									</td>
									<td>
										<div class="input-group input-group-merge">
											<input type="text" class="form-control" name="captcha_password" id="captcha_password" placeholder="Masukkan Captcha">
											<span class="input-group-text cursor-pointer" data-toggle="tooltip" title="Set Semula Captcha" id="reload_captcha_password" onclick="reloadCaptchaPassword()">
												<i data-feather="refresh-cw"></i>
											</span>
										</div>
									</td>
								</tr>
							</table>
							<button type="button" class="btn btn-success" onclick="generalFormSubmit(this);" id="update_password_button" hidden></button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a class="btn btn-secondary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Keluar</a>
					<button type="button" class="btn btn-primary" onclick="$('#update_password_button').trigger('click');">
						<span class="align-middle d-sm-inline-block d-none">
							Kemaskini Kata Laluan
						</span>
					</button>
				</div>
			</div>
		</div>
    </div>

	<script>

		function reloadCaptchaPassword() {
			var captcha = document.getElementById('captcha_password');
			captcha.value = '';

			$.ajax({
				method : "GET",
				url : "{{ route('reload.captcha') }}",
				success:function(data){
					$(".captcha span").html(data.captcha)
				}
			});
		}

	</script>

	<div class="sidenav-overlay"></div>
	<div class="drag-target"></div>

	{{-- include footer --}}
	@include('panels/footer')

	{{-- include default scripts --}}
	@include('panels/scripts')

	<?php
	if(auth()->user()->first_login){
	?>
	<script type="text/javascript">
		$(function() {
			$('#modal-changepassword').modal('show')
		});
	</script>
	<?php
	}
	?>

	<script type="text/javascript">
		$(window).on('load', function() {
			if (feather) {
				feather.replace({
					width: 14, height: 14
				});
			}
		})
	</script>

	@if (session('success'))
	<script>
			$(document).ready(function(){
				toastr.success('{{ session('success') }}');
			});
	</script>
	@php session()->put('success', null); @endphp
	@endif

	@if (session('error'))
	<script>
			$(document).ready(function(){
				toastr.error('{{ session('error') }}');
			});
	</script>
	@php session()->put('error', null); @endphp
	@endif

	@if (session('info'))
	<script>
			$(document).ready(function(){
				toastr.info('{{ session('info') }}');
			});
	</script>
	@php session()->put('info', null); @endphp
	@endif

	@if (session('scrollBottom'))
	<script>
			$(document).ready(function(){
				window.scrollTo(0, document.body.scrollHeight);
			});
	</script>
	@php session()->put('scrollBottom', null); @endphp
	@endif

	@if ($errors->any())
	<script>
		$(document).ready(function(){
			@foreach ($errors->all() as $error)
				toastr.error('{{ $error }}');
            @endforeach
		});
	</script>
	@endif
</body>
</html>
