<!--<h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>-->

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("login", "class='page-login-form'");?>

  <p>
    <?php //echo lang('login_identity_label', 'identity');?>
    <label>Username</label>  
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php // echo lang('login_password_label', 'password');?>
    <label>Senha</label>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php //echo lang('login_remember_label', 'remember');?>
    <label>Lembre-me</label>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>

  <fieldset class="bts">
    <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>
    <p><a href="forgot">Esqueceu a senha?<?php // echo lang('login_forgot_password');?></a></p>
  </fieldset>
  
<?php echo form_close();?>


<?php if(isset($is_login_page)){?>
        <section class="page-login-side-form">
                <h3 class="page-main-title">Cadastro</h3>
                <p>Para se tornar um usuário do sistema, é necessário entrar em contato com um administrador.</p>
        </section>                            
<?php }?>