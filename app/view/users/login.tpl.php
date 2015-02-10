<form method=post>
    <fieldset>
    <p><label>Username:<br/><input type='text' name='acronym' required/></label></p>
    <p><label>Password:<br/><input type='password' name='password' required/></label></p>
    <p><input type='submit' name='doLogin' value='Login' onClick="this.form.action = '<?=$this->url->create('users/login-user')?>'"/></p>
    <?php if(!empty($output)) : ?>
    <?php if($output == 'registerd') : ?>
        <output>Congratulations! You are now a member, login!</output>
    <?php elseif ($output == 'locked') : ?>
        <output>You must login to access the site</output>        
    <?php else : ?>
        <output>Could not login, Wrong username or password?</output>
    <?php endif; ?>
    <?php endif; ?>
    </fieldset>
</form> 
