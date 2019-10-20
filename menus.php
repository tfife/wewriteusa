
<ul class="navbar">
    <li class="logo"><img src="images/logo.png" alt="logo" style="height: 45px; width: auto"></li>
    <li class="search">
        <form method="post" action="search-results.php">
            <input type="text" name="search_string" value="<?php echo $_SESSION[search_string];?>">
            <button type="submit">Search</button>
        </form>
    </li>
    <li class="link1"><a href="profile.php">Profile</a></li>
    <li class="link2"><a href="dashboard.php">Dashboard</a></li>
    <li class="link3"><a href="notifications.php">***</a></li>
</ul>

<ul class="sidebar">
    <li><a href="profile.php">Profile</a></li>
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="mydocuments.php">My Docs</a></li>
    <li><a href="favorites.php">Favorites</a></li>
    <li><a href="friends.php">Friends</a></li>
</ul>

<div class="sidebar2">This will be another sidebar!</div>