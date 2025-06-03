<?php
include "database/config.php";
include "components/header.php";
?>


<style>div {text-align: center;}</style>

<div>
    <div>
        <p class="text-[#880707] text-[40px] font-semibold mt-4">Welcome, Admin <?= $_SESSION['username'] ?> </p>
    </div>
    <button class='px-4 py-2 text-sm rounded-sm font-bold text-black border-2 border-black bg-[#FFF000] transition-all ease-in-out duration-300 hover:bg-black hover:text-[#FFF000] hover:border-[#FFF000]'><a href = 'adminBloglist' >Admin Blog List</a></button>
    <button class='px-4 py-2 text-sm rounded-sm font-bold text-black border-2 border-black bg-[#FFF000] transition-all ease-in-out duration-300 hover:bg-black hover:text-[#FFF000] hover:border-[#FFF000]'><a href = 'userlist' >User List</a></button>
    <button class='px-4 py-2 text-sm rounded-sm font-bold text-black border-2 border-black bg-[#FFF000] transition-all ease-in-out duration-300 hover:bg-black hover:text-[#FFF000] hover:border-[#FFF000]'><a href = 'addblog?bid=0' >Add Blog</a></button>
</div>


<?php
include "components/footer.php";
?>