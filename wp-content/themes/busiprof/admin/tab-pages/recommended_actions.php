<?php
$busiprof_actions = $this->recommended_actions;
$busiprof_actions_todo = get_option('busiprof_recommended_actions', false);
?>
<div id="recommended_actions" class="busiprof-tab-pane panel-close">
    <div class="action-list row">
        <?php if ($busiprof_actions): foreach ($busiprof_actions as $key => $busiprof_actionValue): ?>
                <div class="action col-md-6 col-sm-6 col-xs-12" id="<?php echo esc_attr($busiprof_actionValue['id']); ?>">
                    <div class="recommended_box ">
                        <img width="772" height="180" src="<?php echo esc_url(BUSI_TEMPLATE_DIR_URI) . '/images/' . str_replace(' ', '-', strtolower($busiprof_actionValue['title'])) . '.png'; ?>">
                        <div class="action-inner">
                            <h3 class="action-title"><?php echo esc_html($busiprof_actionValue['title']); ?></h3>
                            <div class="action-desc"><?php echo esc_html($busiprof_actionValue['desc']); ?></div>
                            <?php echo wp_kses_post($busiprof_actionValue['link']); ?>
                            <div class="action-watch">
                                <?php if (!$busiprof_actionValue['is_done']): ?>
                                    <?php if (!isset($busiprof_actions_todo[$busiprof_actionValue['id']]) || !$busiprof_actions_todo[$busiprof_actionValue['id']]): ?>
                                        <span class="dashicons dashicons-visibility"></span>
                                    <?php else: ?>
                                        <span class="dashicons dashicons-hidden"></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="dashicons dashicons-yes"></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;
        endif; ?>
    </div>
</div>