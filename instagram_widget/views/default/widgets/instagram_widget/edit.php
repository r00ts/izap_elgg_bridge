<?php

?>

<p><b>Instagram Username:</b><br />
<input name="params[instagramUsername]" rows="15" cols="24" value="<?php echo $vars['entity']->instagramUsername ?>">
</p>
<p><b>Select photos to show:</b><br />
    <select name="params[instagramCount]">
    <option value="1" <?php if ($vars['entity']->instagramCount == 1) echo " selected=\"yes\" "; ?>>1</option>
    <option value="3" <?php if ((!$vars['entity']->instagramCount) || ($vars['entity']->limit == 3)) echo " selected=\"yes\" "; ?>>3</option>
    <option value="5" <?php if ($vars['entity']->instagramCount == 5) echo " selected=\"yes\" "; ?>>5</option>
    <option value="10" <?php if ($vars['entity']->instagramCount == 10) echo " selected=\"yes\" "; ?>>10</option>
    </select>
</p>