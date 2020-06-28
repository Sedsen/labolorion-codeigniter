<div class="row">
	<div class="col col-lg-10">
		<?php $username = $this->uri->segment(3);
			echo form_open("discussion/add_admin_message/$username");
			echo form_error('reponse');
		 ?>
		<div class="form-group">
			<label>Répondre au message de <?php echo $username; ?></label>
			<textarea name="reponse" class="form-control" rows="3"></textarea>
		</div>
		<button class="btn btn-success"type="submit">Envoyer</button>
			
		<?php echo form_close(); ?>
	</div>
</div>
<br>
<div class="row">
	<p>
		<?php $username = $this->uri->segment(3);
			$admin = $this->session->utilisateur['username'];
			
			$chat_id = $this->discussion_model->select_chat_id_admin($username)[0]->id;
			
			$messages = $this->discussion_model->select_message($chat_id) ;
		  //var_dump($this->session);
		?>
		<div class="col col-lg-10 col-md-10 col-sm-10 ">
			<ul class="list-unstyled">
				<?php foreach ($messages as $message) {
					if ($message->user_id == $admin) {
				 ?>
				 <li >
				 	<!--<div class="bg-secondary text-light" style="margin-left: 30px;">
				 		<?php echo $message->user_id; ?>
				 		<p  class="text-right"><small><?php echo $message->created_at; ?></small></p>
				 	</div>-->
				 	<div class="d-flex justify-content-end">
				 		<div class="bg-success text-light " style="border: none;border-radius: 8px; ">
				 			<?php echo $message->message; ?><br>
				 			<small style="font-size: 10px;"><?php echo $message->created_at; ?></small>
				 		</div>
				 	</div>
				 	
				 	<br> 
				 </li>
				 <?php } 
				 	else {
				 ?>
				 <li>
				 	<!--<div class="bg-success text-light" >
				 		<?php echo $message->user_id;  ?>
				 		<p class="text-right"><small ><?php echo $message->created_at; ?></small></p>
				 	</div>-->
				 	<div class="d-flex justify-content-start">
				 		<div class="bg-info text-dark" style="border: none;border-radius: 8px; ">
				 			<?php echo $message->message; ?><br>
				 			<small style="font-size: 10px;"><?php echo $message->created_at; ?></small>
				 		</div>
				 	</div>
				 	
				 	<br> 
				 </li>
				<?php  }
				} ?>
			</ul>
		</div>

	</p>
</div>