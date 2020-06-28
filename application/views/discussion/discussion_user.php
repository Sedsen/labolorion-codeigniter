<div class="row">
	<div class="col col-lg-8 col-lg-offset-2">
		<?php echo form_open("discussion/add_message"); ?>
		<?php echo form_error("message"); ?>
			<div class="form-group">
				<label for="message">Envoyer un message</label>
				<textarea name="message" class="form-control" rows="3"></textarea>
			</div>
			<button type="submit" class="btn btn-success">Envoyer</button>
		<?php echo form_close(); ?>
	</div>
	
</div>
<br>
<div class="row">
	<p>
		<?php 
		if ($this->session->utilisateur != FALSE || $this->session->utilisateur != NULL) {
		 	$user = $this->session->utilisateur['username'];
		 	$chat_id = $this->discussion_model->select_chat_id($user)[0]->id;
		 	//var_dump($this->discussion_model->select_chat_id($user));
		 	//var_dump($this->session->utilisateur);
			$messages = $this->discussion_model->select_chat_id_user($chat_id);
			$user_access = $this->session->utilisateur['user_access']; 
		 
		?>
		<div class="col col-lg-8 col-md-10 col-sm-10">
			<ul class="list-unstyled">
				<?php foreach ($messages as $message) {
					//var_dump($user_access);
					if ($message->user_id == $user) {
				 ?>
				 <li>
				 	<!--<div class="bg-secondary text-light" style="margin-left: 30px;">
				 		<?php echo $message->user_id; ?>
				 		<p class="text-right"><small ><?php echo $message->created_at; ?></small></p>
				 	</div>-->
				 	<div class="d-flex justify-content-end" id="user_discuss">
				 		<div class="bg-success text-light " style="border: none;border-radius: 8px;">
				 			<?php echo $message->message; ?><br>
				 			<small style="font-size: 10px;"><?php echo $message->created_at; ?></small>
				 		</div>
				 	</div>
				 	
				 	<br> 
				 </li>
				<?php } else { //if ($user_access == '1') {
					 ?>
				<li>
				 	<!--<div class="bg-success text-light" >
				 		<?php echo $message->user_id; ?>
				 		<p class="text-right"><small ><?php echo $message->created_at; ?></small></p>
				 	</div>-->
				 	<div class="d-flex justify-content-start" >
				 		<div class="bg-light text-dark">
				 			<?php echo $message->message; ?><br>
				 			<small style="font-size: 10px;"><?php echo $message->created_at; ?></small>
				 		</div>
				 		
				 	</div>
				 	<br> 
				 </li>
				<?php //}
					}
				} ?>
			</ul>
		</div>
	<?php  } ?>
	</p>
</div>