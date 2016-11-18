<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Session->flash(); ?>
<div class="login-div">
    <?php echo $this->Form->create('User')?>
    <div class="form-group">
        <label>Login:</label>
        <?php echo $this->Form->input('username', ['label'=>'', 'class'=>'form-control']); ?>
    </div>
    <div class="form-group">
        <label>Password:</label>
        <?php echo $this->Form->input('password', ['label'=>'', 'class'=>'form-control']); ?>
    </div>
    <?php echo $this->Form->end(['label'=>'Login', 'class'=>'btn btn-primary']); ?>
</div>
