
<aside>
<div  id="myDropdown">

        <BR>
        <BR>
        <div class=" class="dropdown-content"">
        <h2>USERS</h2>
        <nav>
            <ul>
                <?php foreach ($user as $user) : ?>
                    <li><a  class="user" href="?user_id=<?php echo $user['userId']; ?>">
                            <?php echo $user['username']; ?>
                        </a><br>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        </div>
</div>
    </aside>