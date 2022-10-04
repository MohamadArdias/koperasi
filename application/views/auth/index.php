<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<style>
  #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #customers td,
  #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  #customers tr:hover {
    background-color: #ddd;
  }

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #0066ff;
    color: white;
  }
</style>

<div id="infoMessage"><?php echo $message; ?></div>

<div class="card ">
	<div class="mt-3" id="customers">
		<div class="card-body ">
			<a href="<?= base_url('index.php/auth/create_user'); ?>" class="btn btn-primary">Create User</a>
		</div>

		<div class="overflow-auto">
		<table class="table">
			<tr>
				<th><?= 'No'; ?></th>
				<th><?php echo 'Name'; ?></th>
				<th><?php echo lang('index_email_th'); ?></th>
				<th><?php echo lang('index_groups_th'); ?></th>
				<th><?php echo lang('index_status_th'); ?></th>
				<th><?php echo lang('index_action_th'); ?></th>
			</tr>
			<?php $i = 1; ?>
			<?php foreach ($users as $user) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
					<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
					<td>
						<?php foreach ($user->groups as $group) : ?>
							<?php echo htmlspecialchars($group->name); ?><br />
						<?php endforeach ?>
					</td>
					<td><?php echo  lang('index_active_link'); ?></td>
					<!-- <td>
						<?php
						// echo ($user->active) ? anchor("auth/deactivate/" . $user->id, lang('index_active_link')) : anchor("auth/activate/" . $user->id, lang('index_inactive_link')); 
						?>
					</td> -->
					<td><?php echo anchor("auth/edit_user/" . $user->id, 'Edit'); ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		</div>
	</div>
</div>


<?php
$this->load->view('templates/footer');
?>