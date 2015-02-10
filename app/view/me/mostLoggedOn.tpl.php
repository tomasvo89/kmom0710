<h1>Top active users</h1>  

<div class="mostLoggedOn">
<table style='width: 100%; text-align: left;'>

<tr>
    <th></th>
    <th><?='Username'?></th>
    <th><?='Name'?></th>
    <th><?='Email'?></th>

</tr> 

<?php foreach ($mostLoggedOn as $user) : ?>
<tr>
    <td><img src='http://www.gravatar.com/avatar/<?=md5(strtolower(trim($user->email)))?>.jpg?s=40' alt=''></td>
    <td><a href="<?=$this->url->create('users/id/' . $user->id) ?>"><?=$user->acronym?></a></td>
    <td><?=$user->name?></td>
    <td><?=$user->email?></td>
</tr> 
<?php endforeach; ?>

</table>
</div>