<div class="panel panel-default delivery-date-panel">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-clock-o"></i> <?php echo $panel_delivery_date; ?> </h4>
  </div>
  <div class="panel-body">
    <div class="form-group <?php echo $delivery_date_required ? 'required' : ''; ?>">
        <div class="row">
          <label class="control-label <?php echo $mpcheckout_template == 'checkout_1' ? 'col-sm-3' : 'col-sm-4'; ?>" for="input-delivery-date"><?php echo $entry_delivery_date; ?></label>
          <div class="<?php echo $mpcheckout_template == 'checkout_1' ? 'col-sm-5' : 'col-sm-8'; ?>">
            <div class="input-group">
              <input type="text" name="delivery_date" value="<?php // echo $estimate_date; ?>" data-date-format="YYYY-MM-DD" class="form-control delivery-datetimepicker" />
              <?php if(!$delivery_date_required) { ?>
              <span class="input-group-btn">
                <button class="btn btn-default clear-date" type="button"><i class="fa fa-times"></i></button>
              </span>
              <?php } ?>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
var disables_weeks = [];
<?php foreach($disables_weeks as $disables_week) { ?>
  disables_weeks.push(<?php echo $disables_week; ?>);
<?php } ?>

var disabled_dates = [];
<?php foreach($disabled_dates as $disabled_date) { ?>
  disabled_dates.push('<?php echo $disabled_date; ?>');
<?php } ?>
  
$('.delivery-datetimepicker').datetimepicker({
    format: 'yyyy-mm-dd',
    pickTime: false,
    minDate: moment().add('<?php echo $minimum_days; ?>', 'days'),
    maxDate: moment().add('<?php echo $maximum_days; ?>', 'days'),
    autoclose: 1,
    daysOfWeekDisabled: disables_weeks,
    disabledDates: disabled_dates,
    defaultDate: '<?php echo $estimate_date; ?>',
    useCurrent: false,
});

$('input[name=\'delivery_date\']').keypress(function(event) {
  event.preventDefault();
});

$('.clear-date').click(function() {
  $('input[name=\'delivery_date\']').val('');
});
});
</script>