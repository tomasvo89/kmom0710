<h1 style='border-bottom:1px solid black;'><?=$title?></h1>

<table style='text-align: left;'>

<tr>
    <th><?='Id'?></th>
    <th><?='Username'?></th>
    <th><?='Name'?></th>
    <th><?='Email'?></th>
</tr> 

<?php foreach ($users as $user) : ?>

<tr>
    <td><?=$user->id?></td>
    <td><?=$user->acronym?></td>
    <td><a href="<?=$this->url->create('users/profile/'.$user->acronym)?>"><?=$user->name?></a></td> 
    <td><?=$user->email?></td>
</tr>

<?php endforeach; ?>


</table>

<p><a href='<?=$this->url->create('')?>'><i class="fa fa-arrow-left"></i> Back</a></p> 