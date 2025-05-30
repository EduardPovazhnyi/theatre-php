<?php
include "database/config.php";
include "components/header.php";

$blogID = $_GET['bid'];

// blog

$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `content`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`, `show`.`name`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
INNER JOIN `show` ON `blog`.`show` = `show`.`id`
WHERE `blog`.`id` = $blogID");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bContent, $bImage, $bText, $bShow, $bCreated, $uName, $sName);
$blog->fetch();

// comments

$comment = $conn->prepare("SELECT 
`comment`.`id`, `user`, `blog`, `content`, `comment`.`created`, `user`.`username` 
FROM `comment`
INNER JOIN `user` ON `comment`.`user` = `user`.`id`
WHERE `blog` = $blogID;");

$comment->execute();
$comment->store_result();
$comment->bind_result($cID, $cUser, $cBlog, $cContent, $cCreated, $uName);

?>

<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-3xl font-semibold text-[#880707] capitalize lg:text-4xl dark:text-white">Blog post</h1>
        <div class="mt-8 lg:-mx-6 lg:flex lg:items-center">
            <img class="object-cover w-full lg:mx-6 lg:w-1/2 rounded-xl h-72 lg:h-96" src="<?=ROOT_DIR?>assets/images/shows/<?= $bImage ?>"alt="<?=$sName?>">

            <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6 ">

            <!-- only show delete button if user is logged in AND an admin -->
            <?php if(isset($_SESSION['id'])) : ?>
              <?php if ($_SESSION['role'] == 'admin') : ?>
                <button class='px-4 py-2 text-sm rounded-sm font-bold text-white border-2 border-white bg-[#FF0000] transition-all ease-in-out duration-300 hover:bg-white hover:text-[#FF0000] hover:border-[#FF0000]'><a href = 'deleteBlogController?bid=<?=$blogID?>' >Delete</a></button>
              <?php endif ?>
            <?php endif ?>

                <p class="text-sm text-[#880707] uppercase">Created at: <?=$bCreated?></p>

                <a class="block mt-4 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">
                <p><?=$bTitle?></p>
                </a>

                <p class="mt-3 text-sm text-[#880707] dark:text-gray-300 md:text-sm">
                <p>By <?=$uName?></p>
                </p>

                <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                <p><?=$bText?></p>
                </p>

                <?php if(isset($_SESSION['id'])) : ?>
              <div class="mt-20">
                <form id="commentForm" action="commentControllerSanitise?bid=<?= $bID ?>&uid=<?=$_SESSION['id']?>" method="post">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Comment on <?= $bTitle ?></label>
                  <textarea id="comment" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your comment..."></textarea>
                  <button type="submit" class="relative inline cursor-pointer text-xl font-medium text-[#880707] hover:text-[#4D0000] before:bg-[#FFF000]  before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition before:duration-300 before:ease-in-out hover:before:origin-bottom-left hover:before:scale-x-100">Submit Comment</button>
                </form>
                <?php else : ?>
                  <p>Please sign in to comment on this blog</p>
              </div>
              <?php endif ?>
            </div>
        </div>
    </div>

    <div class="flex justify-center relative top-1/3">
  <?php if ($comment->num_rows == 0) : ?>
    <p class="mt-20">No comments have been left yet </p>
    <?php else : ?>
  <?php while($comment->fetch()) : ?>
<div class="mt-1 relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
    <div class="relative flex gap-4">
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-between">
                <p class="relative text-xl whitespace-nowrap truncate overflow-hidden"><?= $uName ?></p>
                <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
            </div>
            <p class="text-gray-500"><?= htmlspecialchars($cContent) ?></p>

            <!-- only show delete button if user is logged in AND an admin -->
            <?php if(isset($_SESSION['id'])) : ?>
              <?php if ($_SESSION['role'] == 'admin') : ?>
                <button class='px-4 py-2 text-sm rounded-sm font-bold text-white border-2 border-white bg-[#FF0000] transition-all ease-in-out duration-300 hover:bg-white hover:text-[#FF0000] hover:border-[#FF0000]'><a href="deleteCommentController?cid=<?=$cID?>&bid=<?=$blogID?>" >Delete</a></button>
            <?php endif ?>
            <?php endif ?>

        </div>
    </div>
    <p class="-mt-2 text-gray-400 text-sm"><?= $cCreated ?></p>
</div>
<?php endwhile ?>
<?php endif ?>
</div>
</section>

<script>
document.getElementById('commentForm').addEventListener('submit', function(event) {
  const comment = document.getElementById('comment').value.trim();

  // Basic checks
  if (comment.length < 5) {
    alert('Comment must be at least 5 characters long.');
    event.preventDefault();
  }
  if (comment.length > 500) {
    alert('Comment cannot be longer than 500 characters.');
    event.preventDefault();
  }
  else{

  }
});
</script>

</section>

<?php
include "components/footer.php";
?>