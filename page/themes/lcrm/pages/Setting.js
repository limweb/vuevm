export default {
    template: `
  <div>
   <h1>Settings</h1>
   <!-- Notifications -->
   <!-- Content -->
   <div class="panel panel-primary" xmlns:v-bind="http://symfony.com/schema/routing">
      <div class="panel-body">
         <span class="pull-right">
         <a href="#" class="text-muted">
         <i class="fa fa-gear"></i>
         </a>
         </span>
         <form method="POST" action="/setting" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="novalidate" class="bv-form">
            <button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button><input name="_token" type="hidden" value="LnqEMrArD3quo8NysvAGsFtqh76x53n6Dp8SvbTN">
            <div class="nav-tabs-custom" id="setting_tabs">
               <ul class="nav nav-tabs" style="display:list-item;">
                  <li class="">
                     <a href="#general_configuration" data-toggle="tab" title="General configuration" aria-expanded="false"><i class="material-icons md-24">build</i></a>
                  </li>
                  <li>
                     <a href="#email_configuration" data-toggle="tab" title="Email configuration"><i class="material-icons md-24">email</i></a>
                  </li>
                  <li>
                     <a href="#payment_configuration" data-toggle="tab" title="Payment configuration"><i class="material-icons md-24">attach_money</i></a>
                  </li>
                  <li>
                     <a href="#start_number_prefix_configuration" data-toggle="tab" title="Start number prefix configuration"><i class="material-icons md-24">settings_applications</i></a>
                  </li>
                  <li class="">
                     <a href="#pusher_configuration" data-toggle="tab" title="Pusher Configuration" aria-expanded="false"><i class="material-icons md-24">receipt</i></a>
                  </li>
                  <li class="">
                     <a href="#paypal_settings" data-toggle="tab" title="Paypal settings" aria-expanded="false"><i class="material-icons md-24">payment</i></a>
                  </li>
                  <li class="">
                     <a href="#stripe_settings" data-toggle="tab" title="Stripe settings" aria-expanded="false"><i class="material-icons md-24">vpn_key</i></a>
                  </li>
                  <li class="">
                     <a href="#available_modules" data-toggle="tab" title="Available Modules" aria-expanded="false"><i class="material-icons md-24">widgets</i></a>
                  </li>
                  <li class="active">
                     <a href="#backup_configuration" data-toggle="tab" title="Backup Configuration" aria-expanded="true"><i class="material-icons md-24">backup</i></a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane" id="general_configuration">
                     <div class="form-group required  ">
                        <label for="site_logo_file" class="control-label">Site Logo</label>
                        <div class="controls row">
                           <img src="/img/av3_1510233061.gif" class="img-l col-sm-2">
                           <input name="site_logo_file" type="file" id="site_logo_file">
                           <img id="image-preview" width="300" style="display: none;">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="site_name" class="control-label">Site name</label>
                        <div class="controls">
                           <input class="form-control" name="site_name" type="text" value="dsla" id="site_name">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="site_email" class="control-label">Site email</label>
                        <div class="controls">
                           <input class="form-control" name="site_email" type="text" value="anusharmamvh@gmail.com" id="site_email">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="allowed_extensions" class="control-label">Allowed file extensions</label>
                        <div class="controls">
                           <input class="form-control" name="allowed_extensions" type="text" value="manta" id="allowed_extensions">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="max_upload_file_size" class="control-label">Maximum upload file size</label>
                        <div class="controls">
                           <select id="max_upload_file_size" class="form-control select2 select2-hidden-accessible" name="max_upload_file_size" tabindex="-1" aria-hidden="true">
                              <option value="1000">1MB</option>
                              <option value="2000">2MB</option>
                              <option value="3000">3MB</option>
                              <option value="4000">4MB</option>
                              <option value="5000">5MB</option>
                              <option value="6000">6MB</option>
                              <option value="7000">7MB</option>
                              <option value="8000">8MB</option>
                              <option value="9000">9MB</option>
                              <option value="10000" selected="selected">10MB</option>
                           </select>
                           <span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-max_upload_file_size-container"><span class="select2-selection__rendered" id="select2-max_upload_file_size-container" title="10MB">10MB</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                           <span class="help-block"></span>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="email_configuration">
                     <div class="form-group required ">
                        <label for="email_driver" class="control-label">Email driver</label>
                        <div class="controls">
                           <div class="form-inline">
                              <div class="radio">
                                 <div class="iradio_minimal-blue" style="position: relative;"><input class="icheck" name="email_driver" type="radio" value="true" id="email_driver" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                 <label for="true">MAIL</label>
                              </div>
                              <div class="radio">
                                 <div class="iradio_minimal-blue" style="position: relative;"><input class="icheck" name="email_driver" type="radio" value="false" id="email_driver" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                 <label for="false">SMTP</label>
                              </div>
                           </div>
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="email_host" class="control-label">Email server host</label>
                        <div class="controls">
                           <input class="form-control" name="email_host" type="text" value="gmail.com" id="email_host">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="email_port" class="control-label">Email server port</label>
                        <div class="controls">
                           <input class="form-control" name="email_port" type="text" value="" id="email_port">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="email_username" class="control-label">Email server username</label>
                        <div class="controls">
                           <input class="form-control" name="email_username" type="text" value="jojo@gmail.com" id="email_username">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="email_password" class="control-label">Email server password</label>
                        <div class="controls">
                           <input class="form-control" name="email_password" type="text" value="perpiklo" id="email_password">
                           <span class="help-block"></span>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="payment_configuration">
                     <div class="form-group required ">
                        <label for="sales_tax" class="control-label">Sales Tax%</label>
                        <div class="controls">
                           <input class="form-control" name="sales_tax" type="number" value="100" id="sales_tax" data-bv-field="sales_tax">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="sales_tax" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="payment_term1" class="control-label">Payment Term 1</label>
                        <div class="controls">
                           <input class="form-control" name="payment_term1" type="number" value="90" id="payment_term1" data-bv-field="payment_term1">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="payment_term1" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="payment_term2" class="control-label">Payment Term 6</label>
                        <div class="controls">
                           <input class="form-control" name="payment_term2" type="number" value="365" id="payment_term2" data-bv-field="payment_term2">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="payment_term2" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="payment_term3" class="control-label">Payment Term 3</label>
                        <div class="controls">
                           <input class="form-control" name="payment_term3" type="number" value="36" id="payment_term3" data-bv-field="payment_term3">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="payment_term3" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="opportunities_reminder_days" class="control-label">Opportunities Reminder</label>
                        <div class="controls">
                           <input class="form-control" name="opportunities_reminder_days" type="number" value="5" id="opportunities_reminder_days" data-bv-field="opportunities_reminder_days">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="opportunities_reminder_days" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="contract_renewal_days" class="control-label">Contract Renewal Reminder</label>
                        <div class="controls">
                           <input class="form-control" name="contract_renewal_days" type="number" value="12" id="contract_renewal_days" data-bv-field="contract_renewal_days">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="contract_renewal_days" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="invoice_reminder_days" class="control-label">Invoice Reminder</label>
                        <div class="controls">
                           <input class="form-control" name="invoice_reminder_days" type="number" value="7" id="invoice_reminder_days" data-bv-field="invoice_reminder_days">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="invoice_reminder_days" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="currency" class="control-label">Currency</label>
                        <div class="controls">
                           <select id="currency" class="form-control select2 select2-hidden-accessible" name="currency" tabindex="-1" aria-hidden="true">
                              <option value="USD">USD</option>
                              <option value="EUR" selected="selected">EUR</option>
                              <option value="VNĐ">đ</option>
                              <option value="BDT">৳</option>
                              <option value="Rupiah">Rp. </option>
                              <option value="Brazilian Real">R$</option>
                              <option value="INR">RS</option>
                              <option value="TL">TRY</option>
                              <option value="IQD">IQD</option>
                              <option value="GBP">1</option>
                              <option value="inr">dgfd</option>
                              <option value="Fcfa">655</option>
                              <option value="VND">123</option>
                              <option value="Peso Mexicano">$</option>
                           </select>
                           <span class="select2 select2-container select2-container--bootstrap" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-currency-container"><span class="select2-selection__rendered" id="select2-currency-container" title="EUR">EUR</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                           <span class="help-block"></span>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="start_number_prefix_configuration">
                     <div class="form-group required ">
                        <label for="quotation_prefix" class="control-label">Quotation prefix</label>
                        <div class="controls">
                           <input class="form-control" name="quotation_prefix" type="text" value="Q7000" id="quotation_prefix">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="quotation_start_number" class="control-label">Quotation start number</label>
                        <div class="controls">
                           <input class="form-control" name="quotation_start_number" type="number" value="0" id="quotation_start_number" data-bv-field="quotation_start_number">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="quotation_start_number" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="sales_prefix" class="control-label">Sales prefix</label>
                        <div class="controls">
                           <input class="form-control" name="sales_prefix" type="text" value="S000" id="sales_prefix">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="sales_start_number" class="control-label">Sales start number</label>
                        <div class="controls">
                           <input class="form-control" name="sales_start_number" type="number" value="0" id="sales_start_number" data-bv-field="sales_start_number">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="sales_start_number" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="invoice_prefix" class="control-label">Invoice Prefix</label>
                        <div class="controls">
                           <input class="form-control" name="invoice_prefix" type="text" value="I000" id="invoice_prefix">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="invoice_start_number" class="control-label">Invoice start number</label>
                        <div class="controls">
                           <input class="form-control" name="invoice_start_number" type="number" value="0" id="invoice_start_number" data-bv-field="invoice_start_number">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="invoice_start_number" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                     <div class="form-group required ">
                        <label for="invoice_payment_prefix" class="control-label">Invoice payment prefix</label>
                        <div class="controls">
                           <input class="form-control" name="invoice_payment_prefix" type="text" value="P000" id="invoice_payment_prefix">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="invoice_payment_start_number" class="control-label">Invoice payment start number</label>
                        <div class="controls">
                           <input class="form-control" name="invoice_payment_start_number" type="number" value="0" id="invoice_payment_start_number" data-bv-field="invoice_payment_start_number">
                           <span class="help-block"></span>
                        </div>
                        <small class="help-block" data-bv-validator="integer" data-bv-for="invoice_payment_start_number" data-bv-result="NOT_VALIDATED" style="display: none;">Please enter a valid number</small>
                     </div>
                  </div>
                  <div class="tab-pane" id="pusher_configuration">
                     <div class="form-group required ">
                        <label for="pusher_app_id" class="control-label">App ID</label>
                        <div class="controls">
                           <input class="form-control" name="pusher_app_id" type="text" value="291044" id="pusher_app_id">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="pusher_key" class="control-label">Key</label>
                        <div class="controls">
                           <input class="form-control" name="pusher_key" type="text" value="800bafbd0c0dcfab8a33" id="pusher_key">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="pusher_secret" class="control-label">Secret</label>
                        <div class="controls">
                           <input class="form-control" name="pusher_secret" type="text" value="02d7876415cf87f2acc7" id="pusher_secret">
                           <span class="help-block"></span>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="paypal_settings">
                     <div class="form-group required ">
                        <label for="paypal_testmode" class="control-label">Paypal testmode</label>
                        <div class="controls">
                           <div class="form-inline">
                              <div class="radio">
                                 <div class="iradio_minimal-blue checked" style="position: relative;"><input class="icheck" checked="checked" name="paypal_testmode" type="radio" value="true" id="paypal_testmode" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                 <label for="true">True</label>
                              </div>
                              <div class="radio">
                                 <div class="iradio_minimal-blue" style="position: relative;"><input class="icheck" name="paypal_testmode" type="radio" value="false" id="paypal_testmode" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                 <label for="false">False</label>
                              </div>
                           </div>
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="paypal_username" class="control-label">Paypal username</label>
                        <div class="controls">
                           <input class="form-control" name="paypal_username" type="text" value="admin@crm.com" id="paypal_username">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="paypal_password" class="control-label">Paypal password</label>
                        <div class="controls">
                           <input class="form-control" name="paypal_password" type="text" value="" id="paypal_password">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="paypal_signature" class="control-label">Paypal signature</label>
                        <div class="controls">
                           <input class="form-control" name="paypal_signature" type="text" value="" id="paypal_signature">
                           <span class="help-block"></span>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="stripe_settings">
                     <div class="form-group required ">
                        <label for="stripe_secret" class="control-label">Publishable Key</label>
                        <div class="controls">
                           <input class="form-control" name="stripe_secret" type="text" value="" id="stripe_secret">
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div class="form-group required ">
                        <label for="stripe_publishable" class="control-label">Secret Key</label>
                        <div class="controls">
                           <input class="form-control" name="stripe_publishable" type="text" value="" id="stripe_publishable">
                           <span class="help-block"></span>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="available_modules">
                     <div class="form-group">
                        <legend>Available Modules</legend>
                        <label>
                           <div class="icheckbox_minimal-blue checked" style="position: relative;"><input type="checkbox" value="contracts" name="modules[]" checked="" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                           Contracts
                        </label>
                     </div>
                  </div>
                  <div class="tab-pane active" id="backup_configuration">
                     <div class="form-group required ">
                        <label for="backup_type" class="control-label">Backup Service/Server</label>
                        <div class="controls">
                           <select name="backup_type" class="form-control">
                              <option value="local">                                            Local                                        </option>
                              <option value="dropbox">                                            Dropbox                                        </option>
                              <option value="s3">                                            Amazon S3                                        </option>
                           </select>
                           <span class="help-block"></span>
                        </div>
                     </div>
                     <div>
                        <div class="form-group required ">
                           <label for="disk_aws_key" class="control-label">AWS S3 Key</label>
                           <div class="controls">
                              <input class="form-control" name="disk_aws_key" type="text" value="fwafgw34t" id="disk_aws_key">
                              <span class="help-block"></span>
                           </div>
                        </div>
                        <div class="form-group required ">
                           <label for="disk_aws_secret" class="control-label">AWS S3 Secret</label>
                           <div class="controls">
                              <input class="form-control" name="disk_aws_secret" type="text" value="3q4t34qt" id="disk_aws_secret">
                              <span class="help-block"></span>
                           </div>
                        </div>
                        <div class="form-group required ">
                           <label for="disk_aws_bucket" class="control-label">AWS S3 Bucket</label>
                           <div class="controls">
                              <input class="form-control" name="disk_aws_bucket" type="text" value="3we5gy3h" id="disk_aws_bucket">
                              <span class="help-block"></span>
                           </div>
                        </div>
                        <div class="form-group required ">
                           <label for="disk_aws_region" class="control-label">AWS S3 Region (Ex: us-east-1)</label>
                           <div class="controls">
                              <input class="form-control" name="disk_aws_region" type="text" value="35h35hh4" id="disk_aws_region">
                              <span class="help-block"></span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Form Actions -->
            <div class="form-group">
               <div class="controls">
                  <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> OK</button>
               </div>
            </div>
            <!-- ./ form actions -->
         </form>
      </div>
   </div>
   <!-- /.content -->
</div>
  `,
    data() {
        return {
            message: "test Oh hai from the component"
        };
    },
    beforeRouteEnter(to, from, next) {
        console.log("route เข้า component ");
        // Pass a callback to next (optional)
        next(vm => {
            // this callback has access to component instance (ie: 'this') via `vm`
        });
    },

    beforeRouteLeave(to, from, next) {
        console.log("่ก่อน ออก จาก Component นี้ ");
        next();
    },
    components: {},
    mounted() {
        this.$nextTick(() => {
            this.$store.commit("hide");
            console.log("mounted---->", this.$store.state.overlay);
        });
    },
    updated() {
        this.$nextTick(() => {
            this.$store.commit("hide");
            console.log("updated---->", this.$store.state.overlay);
        });
    }
};