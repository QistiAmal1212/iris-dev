<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <form class="configForm2">
				@csrf
                <div class="card-body">

					<div class="row">
						<div class="col-md-6 col-12">
							<div class="form-group">
								<label for="endsession" class=""> {{__('msg.sys.endsession')}}  <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="endsession" name="endsession" placeholder="" value="120">
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="form-group">
								<label for="userinboxlimit" class=""> {{__('msg.sys.userinboxlimit')}} <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="userinboxlimit" name="userinboxlimit" placeholder="" value="">
							</div>
						</div>
					</div>
                </div>
                
                <div class="card-footer ">
                    <button type="submit" class="btn btn-primary float-right">{{__('msg.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <!-- START CONTAINER FLUID -->
<div class=" container-fluid container-fixed-lg bg-white">
	<!-- START card -->
	<div class="card card-transparent">
		<div class="card-block">
			<form class="form-horizontal" role="form" autocomplete="off" method="post" action="{{ route('admin.settings') }}">

				@include('components.bs.input', [
					'name' => 'SESSION_LIFETIME',
					'info' => 'Dalam kiraan minit.',
					'label' => 'Sesi Tamat (session)',
					'mode' => 'required',
					'class' => 'text-lowercase',
					'value' => env("SESSION_LIFETIME")
				])

				@include('components.bs.input', [
					'name' => 'INBOX_LIMIT',
					'info' => 'Jumlah notifikasi dalam inbox.',
					'label' => 'Had Inbox Pengguna',
					'mode' => 'required',
					'class' => 'text-lowercase',
					'value' => env("INBOX_LIMIT")
				])

				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-info pull-right" type="submit">
							<i class="fa fa-check m-r-5"></i> Simpan
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- END card -->
</div>
<!-- END CONTAINER FLUID --> --}}
