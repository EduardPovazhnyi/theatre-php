<?php
include "database/config.php";
include "components/header.php";

$blogID = $_GET['bid'];

// get blog
$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `content`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`, `show`.`name`, `show`.`id`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
INNER JOIN `show` ON `blog`.`show` = `show`.`id`
WHERE `blog`.`id` = $blogID;");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bContent, $bImage, $bText, $bShow, $bCreated, $uName, $sName, $sID);
$blog->fetch();

// get all show names

$show = $conn->prepare("SELECT
`id`, `name`
FROM `show`;");

$show->execute();
$show->store_result();
$show->bind_result($showID, $showName);
?>

<style>p {text-align: center;}</style>
<?php if ($blogID == 0) :?>
<p class="text-[#880707] text-[40px] font-semibold mt-4">Add Blog</p>
<?php else :?>
<p class="text-[#880707] text-[40px] font-semibold mt-4">Edit Blog</p>
<?php endif?>

<main class="upload container mx-auto p-6">
	<h1 class="text-2xl font-bold text-center mb-6"></h1>
    <?php if(isset($_SESSION['statusMsg'])) : ?>
        <h4 class="text-center text-green-500 font-semibold"><?= $_SESSION['statusMsg'] ?></h4>
    <?php endif ?>
<section class="uploadVinyl bg-white shadow-md rounded-lg p-6 mt-4">
    <form action="addBlogController?bid=<?=$blogID?>" method="post" enctype="multipart/form-data" class="space-y-4">
        <label for="imgUpload" class="block text-gray-600">Select Image</label>
        <input type="file" name="image_url" id="imgUpload" class="block w-full border rounded p-2">
        Current image: <?= $bImage ?>
       
        <label for="blogTitle" class="block text-gray-600">Blog Title</label>    
        <input type="text" name="title" id="blogTitle" value="<?=$bTitle?>" required class="block w-full border rounded p-2">
       
        <label for="blogContent" class="block text-gray-600">Blog Content</label>    
        <textarea name="content" id="blogContent" required class="block w-full border rounded p-2"><?=$bText?></textarea>

        <label for="shows">Select a Show:</label>
        <select name="show" id="shows">
            <option value=<?=$sID?>><?=$sName?></option>
            <?php while($show->fetch()) : ?>
                <?php if ($showID != $sID) : ?>
                <option value=<?=$showID?>><?=$showName?></option>
                <?php endif ?>
            <?php endwhile?>
        </select>
        <br>

        <input type="submit" name="submit" value="Upload" class='px-4 py-2 text-sm rounded-sm font-bold text-black border-2 border-black bg-[#FFF000] transition-all ease-in-out duration-300 hover:bg-black hover:text-[#FFF000] hover:border-[#FFF000]'>
    </form>
</section>
</main>

<?php
include "components/footer.php";
?>