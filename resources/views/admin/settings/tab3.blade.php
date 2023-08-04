<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <form class="configForm2">
				@csrf
                <div class="card-body">

					<div class="row">
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="emeltype" class="form-label"> {{__('msg.sys.emeltype')}}  <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="emeltype" name="emeltype" placeholder="" value="SMTP">							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="ip_address2" class="form-label"> {{__('msg.sys.ipaddress')}} <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="ip_address2" name="ip_address" placeholder="" value="smtp.gmail.com">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="port2" class="form-label"> {{__('msg.sys.port')}}  <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="port2" name="port" placeholder="" value="587">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-12">
							<div class="form-group">
								<label for="database_name2" class=""> {{__('msg.sys.dbname')}}  <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="database_name2" name="database_name" placeholder="" value="quickstart2022">
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="form-group">
								<label for="sendername" class=""> {{__('msg.sys.sendername')}}  <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="sendername" name="sendername" placeholder="" value="QuickStart2022">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="senderemel" class=""> {{__('msg.sys.senderemel')}}  <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="senderemel" name="senderemel" placeholder="" value="mail.quickstart2022@company.com">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="dbusername2" class=""> {{__('msg.sys.dbusername')}}  <span style="color:red;">*</span></label>
								<input type="text" class="form-control" id="dbusername2" name="dbusername" placeholder="" value="mail.quickstart2022@company.com">
							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="form-group">
								<label for="database_name2" class=""> {{__('msg.sys.encryption')}} <span style="color:red;">*</span></label>
								<div class="pt-1">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="radio1">
										<label class="form-check-label">SSL</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="radio1" checked>
										<label class="form-check-label">TLS</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio">
										<label class="form-check-label">NONE</label>
									</div>	
								</div>					
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
