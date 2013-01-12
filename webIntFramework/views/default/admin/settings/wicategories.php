<?php
/**
 * Admin page
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */

            // Load fancybox
    elgg_load_js('lightbox');
    elgg_load_css('lightbox');
    elgg_load_js('wi.category');
   
   
    echo "<h4>Categories showing depends on plugins activated</h4>";
    
if (elgg_is_active_plugin('wiAuction')) {


    $list = elgg_list_entities(array(
                        'type' => 'object',
                        'subtype' => 'wiauctioncategory',
                            "pagination" => false,
                            "full_view" => false
    ));



    ?>


    <div class="elgg-module elgg-module-inline">
            <div class="elgg-head">
                <?php echo elgg_view("output/url", array("text" => elgg_echo("add"), "href" => $vars["url"] . "wicategory/forms/save/wiauction", "class" => "elgg-button elgg-button-action add-float-right categories-popup"));?>
                    <h3>
                            <?php echo elgg_echo('wi:category:wiauction'); 

                            ?>
                    </h3>
            </div>
            <div class="elgg-body">
                    <?php echo $list; ?>
            </div>
    </div>


<?php
}

if (elgg_is_active_plugin('wiJob') || elgg_is_active_plugin('wiJobGPL') || elgg_is_active_plugin('wiSkill')) {
    $list = elgg_list_entities(array(
                        'type' => 'object',
                        'subtype' => 'wijobskillcategory',
    ));

    ?>



    <div class="elgg-module elgg-module-inline">
            <div class="elgg-head">
                <?php echo elgg_view("output/url", array("text" => elgg_echo("add"), "href" => $vars["url"] . "wicategory/forms/save/wijobskill", "class" => "elgg-button add-float-right elgg-button-action categories-popup"));?>
                    <h3>
                            <?php echo elgg_echo('wi:category:wijobskill'); ?>
                    </h3>
            </div>
            <div class="elgg-body">
                    <?php echo $list; ?>
            </div>
    </div>

<?php
}
?>
