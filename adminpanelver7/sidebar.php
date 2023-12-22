<div class="sidebar" id="mySidebar" style="background-color: black;">
    <div class="side-header">
        <h5 style="margin-top:10px; color: white;">Hello, Admin</h5>
    </div>

    <hr style="border:1px solid; background-color:#fff; border-color:#fff;">

    <a id="userBanLink" href="userBan.php"><i class="fa fa-ban"></i> User Ban</a>
    <a id="postDeletionLink" href="postDeletion.php"><i class="fa fa-trash"></i> Post Deletion</a>
</div>

<div id="main">
    <button class="openbtn" onclick="toggleSidebar()"><i class="fa fa-home"></i></button>
</div>

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('mySidebar');
        var main = document.getElementById('main');
        var isSidebarOpen = sidebar.style.width === '250px';

        if (isSidebarOpen) {
            sidebar.style.width = '0';
            main.style.marginLeft = '0';
        } else {
            sidebar.style.width = '250px';
            main.style.marginLeft = '250px';
        }
    }

    document.getElementById("userBanLink").addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = "userBan.php";
    });

    document.getElementById("postDeletionLink").addEventListener("click", function(event) {
        event.preventDefault();
        window.location.href = "postDeletion.php";
    });
</script>
</body>
</html>
