<?php
use Core\Error;
use Core\Language;
use Helpers\Form;
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <h1><?= Language::show('Cart', 'Cart'); ?></h1>
            <p><?= Language::show('Your cart is empty', 'Cart'); ?></p>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="well">
              <p class="text-center"><?= Language::show('Already member ? Log in', 'Cart'); ?></p>
              <?= Form::open($params = array('method'=>'post')); ?>
                  <?= Error::display($error); ?>
                  <div class="form-group">
                      <label for="email" class="control-label"><?= Language::show('Email', 'Cart'); ?></label>
                      <input type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter you email" placeholder="example@gmail.com">
                  </div>
                  <div class="form-group">
                      <label for="password" class="control-label"><?= Language::show('Password', 'Cart'); ?></label>
                      <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                  </div>
                    
                  <div id="loginErrorMsg" class="alert alert-error hide"><?= Language::show('Wrong username or password', 'Cart'); ?></div>
                  <button type="submit" name="login_customer" class="btn btn-success btn-block"><?= Language::show('Login', 'Cart'); ?></button>
              <?= Form::close(); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="well">
              <p class="text-center"><?= Language::show('New member ? Welcome !', 'Cart'); ?></p>
              <a href="#" name="new_user" class="btn btn-warning btn-block"><?= Language::show('Continue', 'Cart'); ?></a>
                <br><br>
                <?= Form::open($params = array('method'=>'post')); ?>
                    <div class="form-group">
                          <label for="lastname" class="control-label"><?= Language::show('Lastname', 'Cart'); ?></label>
                          <input type="text" class="form-control" id="lastname" name="lastname" value="" required="" />
                    </div>
                    <div class="form-group">
                          <label for="firstname" class="control-label"><?= Language::show('Firstname', 'Cart'); ?></label>
                          <input type="text" class="form-control" id="firstname" name="firstname" value="" required="" />
                    </div>
                    <div class="form-group">
                          <label for="address1" class="control-label"><?= Language::show('Address 1', 'Cart'); ?></label>
                          <input type="text" class="form-control" id="address1" name="address1" value="" required="" />
                    </div>
                    <div class="form-group">
                          <label for="address2" class="control-label"><?= Language::show('Address 2', 'Cart'); ?></label>
                          <input type="text" class="form-control" id="address2" name="address2" value="" />
                    </div>
                    <div class="form-group">
                          <label for="postal_code" class="control-label"><?= Language::show('Postal Code', 'Cart'); ?></label>
                          <input type="text" class="form-control" id="postal_code" name="postal_code" value="" required="" />
                    </div>
                    <div class="form-group">
                          <label for="city" class="control-label"><?= Language::show('City', 'Cart'); ?></label>
                          <input type="text" class="form-control" id="city" name="city" value="" required="" />
                    </div>
                    <div class="form-group">
                          <label for="phone" class="control-label"><?= Language::show('Phone', 'Cart'); ?></label>
                          <input type="text" class="form-control" id="phone" name="phone" value="" required="" />
                    </div>
                
                    <div class="form-group">
                      <label for="email" class="control-label"><?= Language::show('Email', 'Cart'); ?></label>
                      <input type="text" class="form-control" id="email" name="email" value="" required="" title="Please enter you email" placeholder="example@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label"><?= Language::show('Password', 'Cart'); ?></label>
                        <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                    </div>
                    <button type="submit" name="new_customer" class="btn btn-warning btn-block"><?= Language::show('Create an account', 'Cart'); ?></button>
                <?= Form::close(); ?>
            </div>
        </div>
    </div>
</div>
