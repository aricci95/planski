<?php foreach($this->parentMessages as $message) : ?>
	<tr <?php echo ($message['expediteur_id'] == $this->context->get('user_id')) ? '' : 'class="grey"'; ?>>
		<td>
			<table style="margin:5px;">
				<tr>
					<td style="vertical-align: top;">
						<?php $this->render('user/wSmall', array('user' => $message)); ?>
					</td>
					<td style="vertical-align: top;width:100%;">
						<?php echo Tools::timeConvert($message['delais']); ?>
						<span style="float:right;"><?php echo $message['state_libel']; ?></span>
						<hr>
						<?php echo Tools::toSmiles($message['content']); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<?php endforeach; ?>
