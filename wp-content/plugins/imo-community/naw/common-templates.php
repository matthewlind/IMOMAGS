<?php

?>



   <!-- log/reg popup start -->
        <div class="basic-popup basic-form reg-popup">
            <div class="popup-inner clearfix">
                <form id="imo-ajax-login-form" action="/imo-email-login.json" method="post">
                    <fieldset>
                        <h3>Login</h3>
                        <div class="f-row">
                            <input name="email" type="text" placeholder="Email Address" />
                        </div>
                        <div class="f-row">
                            <input name="password" type="password" placeholder="Password" />
                        </div>
                        <div class="form-link">
                            <a href="#">Lost your password?</a>
                        </div>
                        <div class="f-row">
                            <div class="btn-red">
                                <input type="submit" value="Log In" />
                            </div>
                        </div>
                </form>
                <form id="imo-ajax-register-form" action="/imo-email-register.json" method="post">
                        <span class="or-delim">OR</span>
                        <h3>Register</h3>
                        <div class="f-row">
                            <input name="displayname" type="text" placeholder="Display Name" />
                        </div>
                        <div class="f-row">
                            <input name="email" type="text" placeholder="Email Address" />
                        </div>
                        <div class="f-row">
                            <input name="password" type="password" placeholder="Password" />
                        </div>
                        <div class="f-row">
                            <span class="btn-red">
                                <input type="submit" value="Submit" />
                            </span>
                        </div>
                    </fieldset>
                </form>
            </div>
            <a class="btn-close-popup jq-close-popup" href="#">close</a>
            <a class="btn-cancel jq-close-popup" href="#">Cancel</a>
        </div>
        <!-- log/reg popup end -->





  <!-- Modal -->
  <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">Sending Photo...</h2>
        </div>
        <div class="modal-body">
          <div id="progressBar">

            <div></div><span></span>
          </div>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


