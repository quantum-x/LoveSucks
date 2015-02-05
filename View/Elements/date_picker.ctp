<script type="text/javascript">
$(function() {
    "use strict";

    $('button[name="daterange"]').daterangepicker(
        {
          locale: {
                applyLabel: '<?php echo addslashes(__('Apply'))?>',
                cancelLabel: '<?php echo addslashes(__('Cancel'))?>',
                fromLabel: '<?php echo addslashes(__('From'))?>',
                toLabel: '<?php echo addslashes(__('To'))?>',
                weekLabel: 'W',
                customRangeLabel: '<?php echo addslashes(__('Custom Range'))?>'
          },
          ranges: {
             '<?php echo addslashes(__('Today')) ?>': [moment(), moment()],
             '<?php echo addslashes(__('Yesterday')) ?>': [moment().subtract('days', 1), moment().subtract('days', 1)],
             '<?php echo addslashes(__('Week to date')) ?>': [moment().startOf('week'), moment().endOf('week')],
             '<?php echo addslashes(__('Month to date')) ?>': [moment().startOf('month'), moment().endOf('month')],
             '<?php echo addslashes(__('Year to date')) ?>': [moment().startOf('year'), moment()],
             '<?php echo addslashes(__('Last Week')) ?>': [moment().subtract('week', 1).startOf('week'), moment().subtract('week', 1).endOf('week')],
             '<?php echo addslashes(__('Last Month')) ?>': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
             '<?php echo addslashes(__('Last Year')) ?>': [moment().subtract('year', 1).startOf('year'), moment().subtract('year', 1).endOf('year')]
          },
          startDate: moment().subtract('days', 29),
          endDate: moment()
        },
        function(start, end, label) {
            var url_params = queryString.parse(location.search);
            url_params['filter[date][start]'] = start.format('YYYY-MM-DD HH:mm:ss');
            url_params['filter[date][end]'] = end.format('YYYY-MM-DD HH:mm:ss');
            var url = '<?php echo $this->here; ?>';
            self.location = url + '?' + queryString.stringify(url_params);
        }
    );
});
</script>