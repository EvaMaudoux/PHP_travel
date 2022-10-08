<main role="main" class="container-fluid">
    <?php
    manageAlerts();
    // Manage views
    if (!empty($_GET['page']) && ($_GET['page'] != 'view/main')) {
        getView($_GET['page']);
    } else {
        echo '<h1>Air Travel</h1>
              <div class="alert alert-info">Welcome!</div>';
    }
    ?>
</main>