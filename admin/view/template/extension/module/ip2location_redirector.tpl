<?php if (!$ajax) : ?>
    <?php echo $header; ?>
    <style scoped>
        .loading-overlay-container {
            position: relative;
        }
        .loading-overlay {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            font-size: 4em;
            text-align: center;
            /*padding-top: 45%;*/
            z-index: 20;
        }
    </style>
    <?php echo $column_left; ?>
    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="pull-right">
                    <a href="<?php echo $action_cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
                <h1><?php echo $heading_title; ?></h1>
                <ul class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <?php foreach ($warnings as $warning) : ?>
            <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> <?php echo $warning['message']; ?>
                <?php if ($warning['action']) : ?>
                <a href="<?php echo $warning['load'] ? $warning['load'] : ''; ?>" <?php if ($warning['load']) { ?>data-load="warning"<?php } else { ?>data-warning="action"<?php } ?> data-type="<?php echo $warning['type']; ?>"><?php echo $warning['action']; ?></a>
                <i class="fa fa-circle-o-notch fa-spin warning-action-loading hidden"></i>
                <?php endif; ?>
                <?php if ($warning['disableable']) : ?>
                <a href="#" data-warning="not-show-again" data-type="<?php echo $warning['type']; ?>" data-dismiss="alert"><?php echo $text_not_show_again; ?></a>
			<?php endif; ?>condition
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php endforeach; ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_rules; ?></h3>
                </div>
                <div class="panel-body loading-overlay-container" id="load-content">
					<?php endif; ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <form method="GET" action="<?php echo $action_search; ?>" data-load="search">
                                <div class="row form-inline">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

											<a role="button" data-toggle="collapse" href="#advanced-search" aria-expanded="false" aria-controls="advanced-search"><?php echo $text_advanced_search_criteria; ?></a>
                                        </div>
                                    </div>
                                    <div class="collapse" id="advanced-search">
                                        <div class="well" style="margin:5px">
											<div class="col-sm-2">
	                                            <div class="form-group">
	                                                <label for="filter-per-page" class="control-label"><?php echo $entry_per_page; ?></label>
	                                                <select name="limit" id="filter-per-page" class="form-control">
	                                                    <?php foreach ($limits as $limit) { ?>
	                                                    <option value="<?php echo $limit['value']; ?>"<?php if ($limit['selected']) : ?> selected<?php endif; ?>><?php echo $limit['value']; ?></option>
	                                                    <?php } ?>
	                                                </select>
	                                            </div>
	                                        </div>
											<div class="col-sm-10">
												<div class="form-group">
	                                                <label for="filter-status" class="control-label"><?php echo $entry_status; ?></label>
	                                                <select name="status" id="filter-status" class="form-control">
	                                                    <option value=""<?php if ($filterStatus === null) : ?> selected<?php endif; ?>><?php echo $text_none; ?></option>
	                                                    <option value="1"<?php if ($filterStatus === true) : ?> selected<?php endif; ?>><?php echo $text_enabled; ?></option>
	                                                    <option value="0"<?php if ($filterStatus === false) : ?> selected<?php endif; ?>><?php echo $text_disabled; ?></option>
	                                                </select>
	                                            </div>
											</div>
	                                        <div class="col-sm-12">
	                                            <div class="form-group">
	                                                <?php foreach ($codes as $code) { ?>
	                                                <label class="checkbox-inline">
	                                                    <input type="checkbox" name="code[]" value="<?php echo $code['code']; ?>"<?php if ($code['checked']) { ?> checked<?php } ?>>
	                                                    <?php echo $code['text']; ?>
	                                                </label>
	                                                <?php } ?>
	                                            </div>
	                                        </div>
											<p>&nbsp;</p>
										</div>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?php echo $token; ?>">
                                <input type="hidden" name="route" value="<?php echo $route; ?>">
                            </form>
                        </div>
                    </div>
					<div class="row">
						<div class="col-sm-12 text-right">
							<p>
								<span data-toggle="modal" data-target="#add-rule-modal">
									<a data-button="add" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary" data-update-url="<?php echo $current_url; ?>"><i class="fa fa-plus"></i> New Rule
									</a>
								</span>
							</p>
						</div>
					</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
									<td class="text-left col-sm-2"><?php echo $column_origin; ?></td>
                                    <td class="col-sm-3">
                                        <a data-load="sort" href="<?php echo $sort_from; ?>" class="<?php echo $sort == 'from' ? strtolower($order) : ''; ?>">
                                            <?php echo $column_from; ?>
                                        </a>
                                    </td>
                                    <td class="col-sm-3">
                                        <a data-load="sort" href="<?php echo $sort_to; ?>" class="<?php echo $sort == 'to' ? strtolower($order) : ''; ?>">
                                            <?php echo $column_to; ?>
                                        </a>
                                    </td>
                                    <td class="col-sm-1">
                                        <a data-load="sort" href="<?php echo $sort_code; ?>" class="<?php echo $sort == 'code' ? strtolower($order) : ''; ?>">
                                            <?php echo $column_code; ?>
                                        </a>
                                    </td>
                                    <td class="col-sm-1">
                                        <a data-load="sort" href="<?php echo $sort_status; ?>" class="<?php echo $sort == 'status' ? strtolower($order) : ''; ?>">
                                            <?php echo $column_status; ?>
                                        </a>
                                    </td>
                                    <td class="text-right col-sm-2"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rules) : ?>
                                <?php foreach ($rules as $rule) : ?>
                                    <tr>
										<td>
											<span data-preview="origins" data-rule-id="<?php echo $rule['id']; ?>" style="display:block;overflow:auto;max-height:60px"><?php echo $rule['show_origin']; ?></span>
											<select class="form-control hidden" data-input="origins" data-rule-id="<?php echo $rule['id']; ?>" multiple data-placeholder="<?php echo $entry_origin; ?>">
												<?php foreach ($origins as $origin) : ?>
			                                    <option value="<?php echo $origin['code']; ?>"<?php if(in_array($origin['code'], $rule['origins'])) echo ' selected'; ?>><?php echo $origin['text']; ?></option>
			                                    <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <span data-preview="from" data-rule-id="<?php echo $rule['id']; ?>"><span class="label label-<?php echo (($rule['condition'] == 0) ? 'success' : (($rule['condition'] == 1) ? 'info' : 'danger')); ?>"><?php echo (($rule['condition'] == 0) ? $text_equals_to : (($rule['condition'] == 1) ? $text_begins_with : $text_regular_expression)); ?></span><br /><?php echo $rule['show_from']; ?></span>

											<div class="row">
												<div class="col-sm-3" style="margin-right:0;padding-right:0">
													<select class="form-control hidden" data-input="condition" data-rule-id="<?php echo $rule['id']; ?>">
		                                                <option value="0"<?php if ($rule['condition'] == 0) : ?> selected<?php endif; ?>><?php echo $text_equals_to; ?></option>
		                                                <option value="1"<?php if ($rule['condition'] == 1) : ?> selected<?php endif; ?>><?php echo $text_begins_with; ?></option>
														<option value="2"<?php if ($rule['condition'] == 2) : ?> selected<?php endif; ?>><?php echo $text_regular_expression; ?></option>
		                                            </select>
												</div>
												<div class="col-sm-9" style="margin-left:0;padding-left:2px">
	                                            	<input type="hidden" data-input="from" data-rule-id="<?php echo $rule['id']; ?>" value="<?php echo $rule['from']; ?>" class="form-control" placeholder="<?php echo $entry_from; ?>">
												</div>
											</div>
                                        </td>
                                        <td>
                                            <span data-preview="to" data-rule-id="<?php echo $rule['id']; ?>"><?php echo $rule['show_to']; ?></span>
                                            <input type="hidden" data-input="to" data-rule-id="<?php echo $rule['id']; ?>" value="<?php echo $rule['to']; ?>" class="form-control" placeholder="<?php echo $entry_to; ?>"<?php if($rule['code'] == 404) echo ' disabled'; ?>>
                                        </td>
                                        <td>
                                            <span data-preview="code" data-rule-id="<?php echo $rule['id']; ?>"><?php echo $codes[$rule['code']]['code']; ?></span>
                                            <select class="form-control hidden" data-input="code" data-rule-id="<?php echo $rule['id']; ?>">
                                                <?php foreach ($codes as $code) : ?>
                                                <option value="<?php echo $code['code']; ?>"<?php if ($code['code'] == $rule['code']) : ?> selected<?php endif; ?>><?php echo $code['text']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <span data-preview="status" data-rule-id="<?php echo $rule['id']; ?>"><?php echo $rule['status'] ? $text_enabled : $text_disabled; ?></span>
                                            <select class="form-control hidden" data-input="status" data-rule-id="<?php echo $rule['id']; ?>">
                                                <option value="1"<?php if ($rule['status']) : ?> selected<?php endif; ?>><?php echo $text_enabled; ?></option>
                                                <option value="0"<?php if (!$rule['status']) : ?> selected<?php endif; ?>><?php echo $text_disabled; ?></option>
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <a data-button="edit" data-rule-id="<?php echo $rule['id']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                            <a data-button="save" data-rule-id="<?php echo $rule['id']; ?>" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success hidden"><i class="fa fa-save"></i></a>
                                            <a data-button="cancel" data-rule-id="<?php echo $rule['id']; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-warning hidden"><i class="fa fa-reply"></i></a>
                                            <a data-button="delete" data-rule-id="<?php echo $rule['id']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left"><?php echo isset($pagination) ? $pagination : ''; ?></div>
                        <div class="col-sm-6 text-right"><?php echo isset($results) ? $results : ''; ?></div>
                    </div>
                    <div class="loading-overlay hidden" id="loading-overlay">
                        <i class="fa fa-circle-o-notch fa-spin"></i> <?php echo $text_loading; ?>
                    </div>
<?php if (!$ajax) : ?>
                </div>
            </div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-database"></i> <?php echo $text_database; ?></h3>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="<?php echo $action_save_settings ?>" id="database-form">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="lookup-method"><span data-toggle="tooltip" title="<?php echo $help_method; ?>"><?php echo $entry_method; ?></span></label>
							<div class="col-sm-2">
								<select class="form-control" id="lookup-method" name="method">
									<option value="0"<?php if ($settings['ip2location_lookup_method'] == 0) echo ' selected'; ?>><?php echo $text_local_binary_database; ?></option>
									<option value="1"<?php if ($settings['ip2location_lookup_method'] == 1) echo ' selected'; ?>><?php echo $text_remote_api; ?></option>
								</select>
							</div>
						</div>
						<div id="local-database" class="form-group<?php if($settings['ip2location_lookup_method'] == 1) echo ' hidden'; ?>">
							<label class="col-sm-2 control-label" for="database"><span data-toggle="tooltip" title="<?php echo $help_database_location; ?>"><?php echo $entry_database_location; ?></span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="database" id="database" value="<?php echo $settings['ip2location_database_location']; ?>" placeholder="<?php echo $entry_database_location; ?>">
								<p class="help-block"><?php echo $entry_database_location_description; ?></p>
							</div>
						</div>
						<div id="remote-api" class="form-group<?php if($settings['ip2location_lookup_method'] == 0) echo ' hidden'; ?>">
							<label class="col-sm-2 control-label" for="api-key"><span data-toggle="tooltip" title="<?php echo $help_api_key; ?>"><?php echo $entry_api_key; ?></span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="apiKey" id="api-key" value="<?php echo $settings['ip2location_api_key']; ?>" placeholder="<?php echo $entry_api_key; ?>">
								<p class="help-block"><?php if($ws_credit != '') echo '<strong>' . $entry_remaining_credit . '</strong>' . $ws_credit; else echo $entry_api_key_description; ?></p>
							</div>
						</div>
						<div class="text-right">
							<a id="save-settings" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $button_save; ?></a>
						</div>
					</form>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-location-arrow"></i> <?php echo $text_lookup; ?></h3>
				</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="<?php echo $action_lookup ?>" id="lookup-form">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="ip-address"><?php echo $entry_ip_address; ?></label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="ipAddress" id="ip-address" value="<?php echo $ipAddress; ?>" placeholder="<?php echo $entry_ip_address; ?>"<?php if(!$lookupEnabled) echo ' disabled'; ?>>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-5">
								<a id="lookup-button" data-toggle="tooltip" title="<?php echo $button_lookup; ?>" class="btn btn-primary<?php if(!$lookupEnabled) echo ' disabled'; ?>"><i class="fa fa-search"></i> <?php echo $button_lookup; ?></a>
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
    <div class="container text-center" style="padding-bottom:20px;"><?php echo $developer; ?></div>
    <div class="modal fade" tabindex="-1" role="dialog" id="add-rule-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" action="<?php echo $action_add ?>" id="add-rule-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><?php echo $text_add_rule; ?></h4>
                    </div>
                    <div class="modal-body">
						<div class="form-group">
                            <label class="col-sm-2 control-label" for="add-rule-from"><span data-toggle="tooltip" title="<?php echo $help_origin; ?>"><?php echo $entry_origin; ?></span></label>
                            <div class="col-sm-10">
								<select class="form-control" id="add-origin" name="origins[]" multiple style="width:100%" data-placeholder="<?php echo $entry_origin; ?>">
									<?php foreach ($origins as $origin) : ?>
                                    <option value="<?php echo $origin['code']; ?>"><?php echo $origin['text']; ?></option>
                                    <?php endforeach; ?>
                                </select>
							</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="add-rule-from"><span data-toggle="tooltip" title="<?php echo $help_from; ?>"><?php echo $entry_from; ?></span></label>
                            <div class="col-sm-3" style="margin-right:0;padding-right:0">
								<select class="form-control" id="add-from-condition" name="condition">
                                    <option value="0"><?php echo $text_equals_to; ?></option>
                                    <option value="1"><?php echo $text_begins_with; ?></option>
									<option value="2"><?php echo $text_regular_expression; ?></option>
                                </select>
							</div>
							<div class="col-sm-7">
                                <input type="text" class="form-control" name="from" id="add-rule-from" placeholder="<?php echo $entry_from; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="add-rule-to"><span data-toggle="tooltip" title="<?php echo $help_to; ?>"><?php echo $entry_to; ?></span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="to" id="add-rule-to" placeholder="<?php echo $entry_to; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="add-rule-code"><span data-toggle="tooltip" title="<?php echo $help_code; ?>"><?php echo $entry_code; ?></span></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="add-rule-code" name="code">
                                    <?php foreach ($codes as $code) : ?>
                                    <option value="<?php echo $code['code']; ?>"><?php echo $code['text']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="add-rule-status"><?php echo $entry_status; ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="add-rule-status" name="status">
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <i class="fa fa-circle-o-notch fa-spin add-rule-loading hidden"></i>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><?php echo $button_cancel; ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo $button_create; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="pre-action-content-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><?php echo $text_pre_action_content; ?></h4>
                </div>
                <div class="modal-body">
                    <p id="pre-action-content-help"></p>
                    <textarea readonly id="pre-action-content-textarea" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $button_ok; ?></button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" data-action-url="add" value="<?php echo $action_add; ?>">
    <input type="hidden" data-action-url="save" value="<?php echo $action_save; ?>">
    <input type="hidden" data-action-url="delete" value="<?php echo $action_delete; ?>">
	<input type="hidden" data-action-url="save_settings" value="<?php echo $action_save_settings; ?>">
	<input type="hidden" data-action-url="lookup" value="<?php echo $action_lookup; ?>">
	<input type="hidden" data-name="equals-to" value="<?php echo $text_equals_to; ?>">
	<input type="hidden" data-name="begins-with" value="<?php echo $text_begins_with; ?>">
	<input type="hidden" data-name="regular-expression" value="<?php echo $text_regular_expression; ?>">
    <input data-action-url="not-show-again" type="hidden" value="<?php echo $action_not_show_again; ?>">
    <input data-action-url="warning-action" type="hidden" value="<?php echo $action_warning_action; ?>">
    <input data-text="ajax-error" type="hidden" value="<?php echo $error_ajax; ?>">
    <input data-text="ajax-no-response" type="hidden" value="<?php echo $text_ajax_no_response; ?>">
    <input data-text="confirm-delete" type="hidden" value="<?php echo $text_confirm_delete; ?>">
    <input data-text="confirm-leave-page" type="hidden" value="<?php echo $text_confirm_leave_page; ?>">
    <input data-text="button-yes" type="hidden" value="<?php echo $button_yes; ?>">
    <input data-text="button-no" type="hidden" value="<?php echo $button_no; ?>">
    <?php echo $footer; ?>
<?php endif; ?>
