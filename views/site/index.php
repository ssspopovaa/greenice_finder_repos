<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container">  
   <div class="alert alert-success" role="alert">
        <?php if (isset($errors) && is_array($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li> - <?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
   </div>
    
        <?php if (isset($_SESSION['message']) && is_array($_SESSION['message'])): ?>
            <div class="alert alert-info" role="alert"> 
            <ul>
                <?php foreach ($_SESSION['message'] as $message): ?>
                    <li> - <?php echo $message; ?></li>
                <?php endforeach; ?>
            </ul>
                </div>
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
   
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">HTML_URL</th>
      <th scope="col">Description</th>
      <th scope="col">Owner.Login</th>
      <th scope="col">Stargazers_Count</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
     <?php if (isset($repos) && count($repos) > 0): ?>
        <?php foreach ($repos as $rep): ?>  
            <tr>      
                <td><?php echo $rep->name; ?></td>
                <td><?php echo '<a href="' . $rep->html_url . '">' . $rep->html_url . '</a>'; ?></td>
                <td><?php echo $rep->description; ?></td>
                <td><?php echo $rep->owner->login; ?></td>
                <td><?php echo $rep->stargazers_count; ?></td>
                <td>
                    <a href="save/<?php echo $rep->id; ?>">
                        <button>Добавить</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php elseif (isset($repos) && count($repos) == 0): ?>
        <h3>Репозитории по такому имени не найдены</h3>
    <?php else: ?>
        <?php if (User::isGuest()): ?>
            <h3>Чтобы приступить к поиску - войдите в систему!</h3><br>
        <?php else: ?>
            <h3>Введите имя репозитория в строку поиска</h3><br>
        <?php endif; ?>
    <?php endif; ?>
  </tbody>
</table>
    <nav aria-label="paginate">
    <!-- Pagination -->
      <?php if(isset($pagination)){ echo $pagination->get();} ?>
    </nav>    
</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>