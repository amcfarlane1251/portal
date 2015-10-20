<?php
	
	$report = $vars['entity'];

	$percentVar;
	if(strpos($report->percent_complete, '%') == false) {
		if($report->percent_complete != null) {
			$percentVar = '%';
		} else {
			$percentVar = '0%';
		}
	}
?>

	<table class="tasks" width="100%">
		<tr>
			<td width="5%" id="percent-complete-summary">
				<?php echo $report->percent_complete . $percentVar; ?>
			</td>
			<td colspan="2" id="report-title-summary">
				<?php
					echo elgg_view('output/url', array(
						'text' => $report->title,
						'value' => $report->getURL(),
						'is_trusted' => true,
					));
				?>
			</td>
		</tr>
	</table>


