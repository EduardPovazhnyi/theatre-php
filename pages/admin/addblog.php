<?php
include "database/config.php";
include "components/header.php";

// Get blog data if editing
$blogID = isset($_GET['bid']) ? (int)$_GET['bid'] : 0;
$blogData = [
    'title' => '',
    'content' => '',
    'show' => '',
    'image_url' => ''
];
if ($blogID) {
    $blog = $conn->prepare("SELECT `title`, `content`, `show`, `image_url` FROM `blog` WHERE `id` = ?");
    $blog->bind_param("i", $blogID);
    $blog->execute();
    $blog->store_result();
    $blog->bind_result($blogData['title'], $blogData['content'], $blogData['show'], $blogData['image_url']);
    $blog->fetch();
}

// get all show names

$show = $conn->prepare("SELECT
`id`, `name`
FROM `show`;");

$show->execute();
$show->store_result();
$show->bind_result($showID, $showName);
?>

<style>p {text-align: center;}</style>

<p class="text-[#880707] text-[40px] font-semibold mt-4">Add Blog</p>


<main class="upload container mx-auto p-6">
	<h1 class="text-2xl font-bold text-center mb-6"></h1>
    <?php if (isset($_SESSION['statusMsg'])): ?>
    <h4 class="text-center text-green-500 font-semibold"><?= $_SESSION['statusMsg']; ?></h4>
    <?php unset($_SESSION['statusMsg']); ?>
<?php endif; ?>

<section class="uploadVinyl bg-white shadow-md rounded-lg p-6 mt-4">
    <form action="addBlogController?bid=<?=$blogID?>" method="post" enctype="multipart/form-data">
       
        <label for="imgUpload" class="block text-gray-600">Select Image</label>
        <?php if ($blogID && $blogData['image_url']): ?>
            <div>
                <img src="assets/images/shows/<?=$blogData['image_url']?>" style="max-width: 300px;">
                <br>
                <span class="text-xs">Current image</span>
            </div>
        <?php endif; ?>
        <input type="file" name="image_url" id="imgUpload" class="block w-full border rounded p-2">
        
   
       
        <label for="blogTitle" class="block text-gray-600">Blog Title</label>    
        <input type="text" name="title" id="blogTitle" value="<?=htmlspecialchars($blogData['title'])?>" required class="block w-full border rounded p-2">
       
        <label for="blogContent" class="block text-gray-600">Blog Content</label>    
        <textarea name="content" id="blogContent" required class="block w-full border rounded p-2"><?=htmlspecialchars($blogData['content'])?></textarea>

        <label for="shows">Select a Show:</label>
        <select name="show" id="shows">
            <?php while($show->fetch()) : ?>
             
                <option value=<?=$showID?>><?=($showID == $blogData['show']) ? 'selected' : ''?>><?=$showName?></option>
               
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