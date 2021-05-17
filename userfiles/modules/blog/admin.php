<?php must_have_access(); ?>

<?php
$from_live_edit = false;
if (isset($params["live_edit"]) and $params["live_edit"]) {
    $from_live_edit = $params["live_edit"];
}
?>

<?php if (isset($params['backend'])): ?>
    <module type="admin/modules/info"/>
<?php endif; ?>

<div class="card style-1 mb-3 <?php if ($from_live_edit): ?>card-in-live-edit<?php endif; ?>">
    <div class="card-header">
        <?php $module_info = module_info($params['module']); ?>
        <h5>
            <img src="<?php echo $module_info['icon']; ?>" class="module-icon-svg-fill"/> <strong><?php _e($module_info['name']); ?></strong>
        </h5>
    </div>

    <div class="card-body pt-3">

        <nav class="nav nav-pills nav-justified btn-group btn-group-toggle btn-hover-style-3">
            <a class="btn btn-outline-secondary justify-content-center active" data-toggle="tab" href="#settings"><i class="mdi mdi-cog-outline mr-1"></i> <?php _e('Settings'); ?></a>
            <a class="btn btn-outline-secondary justify-content-center" data-toggle="tab" href="#templates"><i class="mdi mdi-pencil-ruler mr-1"></i> <?php _e('Templates'); ?></a>
        </nav>

        <div class="tab-content py-3">

            <div class="tab-pane fade show active" id="settings">
                <div class="module-live-edit-settings module-blog-settings">

                    <div class="form-group">
                        <label class="control-label d-block"><?php echo _e("Display content from", true); ?></label>
                        <select name="content_from_id" class="mw_option_field selectpicker" data-width="100%" data-size="5" data-live-search="true">
                            <option>Select..</option>

                            <?php
                            $pageTreeFilter = array();
                            $pageTreeFilter['link'] = "{title}";
                            $pageTreeFilter['list_tag'] = " ";
                            $pageTreeFilter['list_item_tag'] = "option";
                            $pageTreeFilter['active_code_tag'] = ' selected="selected" ';

                            pages_tree($pageTreeFilter);
                            ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label d-block"><?php echo _e("Filtering the results", true); ?></label>
                        <div class="custom-control custom-switch pl-0">
                            <label class="d-inline-block mr-5" for="filtering_the_results"><?php _e('No'); ?></label>
                            <input class="mw_option_field custom-control-input" id="filtering_the_results" type="checkbox"
                                   autocomplete="off" name="filtering_the_results" <?php if (get_option('filtering_the_results', 'xax') == 'y'): ?>checked<?php endif; ?> option-group="xax" data-value-checked="y" data-value-unchecked="n">
                            <label class="custom-control-label" for="filtering_the_results"><?php _e('Yes'); ?></label>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#filtering_the_results').change(function() {
                                if ($(this).prop('checked')) {
                                    $('.js-blog-filtering-the-results').fadeIn();
                                } else {
                                    $('.js-blog-filtering-the-results').fadeOut();
                                }
                            });
                        });
                    </script>

                    <div class="js-blog-filtering-the-results">

                        
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="templates">
                <module type="admin/modules/templates"/>
            </div>
        </div>

    </div>
</div>