<?php if($this->session->has('user')) : ?>   

<header id = "above">
<span class='aboveheader right'>
<a href="<?=$this->url->create("users/profile/".$this->session->get('user')."")?>"><?php print_r($this->session->get('user')); ?></a> 
 <a href="<?=$this->url->create('users/logout')?>">Logout</a>
<?php else: ?> 
<header id = "above">
<span class='aboveheader right'>
<a href="<?=$this->url->create('users/login')?>">Login</a> |
 <a href="<?=$this->url->create('users/add')?>">Register</a>
<?php endif; ?> 
</span>
</header>