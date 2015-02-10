<h2><?=$title?></h2>
<div class='comment-form'>
    <form method=post>
        <input type=hidden name="redirect" value="<?=$this->url->create($pageType)?>">
        <input type=hidden name="pageType" value='<?=$pageType?>'>

        <fieldset>
        <legend>Redigera:</legend>
        <p><label>Kommentar:<br/><textarea name='content'><?=$content?></textarea></label></p>
        <p><label>Namn:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
        <p><label>Hemsida:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
        <p><label>Mail:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
        <p class=buttons>
            <input type='submit' name='doSave' value='Spara' onClick="this.form.action = '<?=$this->url->create('comment/save').'/' . $id?>'"/>
            <input type='reset' value='Reset'/>
            <input type='submit' value='Tillbaka' onClick="this.form.action = '<?=$this->url->create($pageType)?>'"/>
        </p>
        </fieldset>
    </form>
</div> 