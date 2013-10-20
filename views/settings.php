<?php print $header; ?>
<div style="margin-left:20px">
    <form method="post" action="<?php echo Uri::to('admin/twitter-card-settings'); ?>" novalidate>
    <div class="control-group">
        <textarea name="twitter_card_description" cols="30" rows="10" placeholder="@description"><?php print $twitter_card_description; ?></textarea>
        <p>Adding description will override the site description.</p>
    </div>
    <div class="control-group">
        <input type="text" name="twitter_card_creator_username" placeholder="@creator_username" value="<?php print $twitter_card_creator_username; ?>">
    </div>
    <div class="control-group">
        <input type="text" name="twitter_card_site_username" placeholder="@site_username" value="<?php print $twitter_card_site_username; ?>">
    </div>
    <input type="hidden" value="<?php print $token; ?>" name="token"/>
    <button>Go!</button>
    </form>
</div>
<?php print $footer; ?>
