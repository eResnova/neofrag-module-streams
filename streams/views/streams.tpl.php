<div class="col-md-<?php echo $this->config->streams_per_row; ?>">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo icon('fa-video-camera').' <a href="'.url('streams/'.$data['stream_id'].'/'.url_title($data['title'])).'">'.$data['title'].'</a>'; ?></h3>
		</div>
		<a href="<?php echo url('streams/'.$data['stream_id'].'/'.url_title($data['title'])); ?>"><img src="https://static-cdn.jtvnw.net/previews-ttv/live_user_<?php echo $data['id']; ?>-1200x675.jpg" class="img-responsive" alt="" /></a>
	</div>
</div>