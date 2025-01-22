<?php if($provider->message->message != ""): ?>
<div
	class="alert alert-<?php if($provider->message->success == false): ?>danger<?php else : ?>success<?php endif;?> alert-dismissible fade show"
	role="alert">
  <?php echo $provider->message->message; ?>
  <a href="#" class="jq-alert-close alert-close"> <span
		aria-hidden="true">&times;</span>
	</a>
</div>
<?php endif; ?>