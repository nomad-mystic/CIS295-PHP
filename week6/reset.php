<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 4/7/2016
 * Time: 10:02 PM
 */

require_once('assets/includes/common_requires.php');

// getting url information
$username = get_get_value(User::USERNAME_KEY);
$code = get_get_value(User::RESET_CODE_KEY);
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once('assets/includes/common_head_contents.php'); ?>
    <script>
        loadContent('assets/includes/change_password_content.php', function() {
            changePassword('<?php echo $username; ?>', '<?php echo $code; ?>');
        });
    </script>
</head>
<body>
<header>
    <div id="navbar_area"></div>
</header>
<section>
    <main>
        <article>
            <h1>Welcome to Generic Sharer!!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias enim
                minima numquam quos! Accusamus aperiam aspernatur cumque deserunt minima
                neque officia quod quos soluta totam! Corporis cumque dolorem error officiis!</p>
        </article>
    </main>
</section>
</body>
</html>