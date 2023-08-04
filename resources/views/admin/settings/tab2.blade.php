<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <form class="configForm2">
				@csrf
                <div class="card-body">

					<div class="row">
						<div class="col-md-6 col-12">
							<div class="form-group">
								<label class="form-label" for="ip_address"> {{__('msg.sys.ipaddress')}} <span style="color:red;">*</span> </label>
								<input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="" value="127.0.0.1">
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="form-group">
								<label class="form-label" for="port"> {{__('msg.sys.port')}} <span style="color:red;">*</span> </label>
								<input type="text" class="form-control" id="port" name="port" placeholder="" value="3306">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label class="form-label" for="ip_address"> {{__('msg.sys.dbname')}} <span style="color:red;">*</span> </label>
								<input type="text" class="form-control" id="database_name" name="database_name" placeholder="" value="quickstart2022">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label class="form-label" for="port"> {{__('msg.sys.dbusername')}} <span style="color:red;">*</span> </label>
								<input type="text" class="form-control" id="dbusername" name="dbusername" placeholder="" value="root">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label class="form-label" for="port"> {{__('msg.sys.dbpassword')}} <span style="color:red;">*</span> </label>
								<input type="password" class="form-control" id="dbpassword" name="dbpassword" placeholder="" value="quickstartv2">
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
