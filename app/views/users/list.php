<?php require APPROOT . '/views/inc/header.php'; ?>
  <?php flash('user_message'); ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Users</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/users/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add User
      </a>
    </div>
  </div>
  <?php foreach($data['users'] as $user) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title">User name: <?php echo $user->name; ?></h4>
      <div class="bg-light p-2 mb-3">
        User e-mail: <?php echo $user->email; ?>
      </div>
      <div class="bg-light p-2 mb-3">
        User created on: <?php echo $user->userCreated; ?>
      </div>
      <p class="card-text"></p>
    </div>

    <?php if($user->id == $_SESSION['user_id']) : ?>
      <a href="<?php echo URLROOT; ?>/users/edit/<?php echo $user->id; ?>" class="btn btn-dark">Edit</a>

      <form class="pull-right" action="<?php echo URLROOT; ?>/users/delete/<?php echo $user->id; ?>" method="post">
        <input type="submit" value="Delete" class="btn btn-danger">
      </form>
    <?php endif; ?>

  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>