<?php
include "database/config.php";
include "components/header.php";

$blogID = $_GET['bid'];

// blog

$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `content`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
WHERE `blog`.`id` = $blogID");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bContent, $bImage, $bText, $bShow, $bCreated, $uName);
$blog->fetch();

// comments

$comment = $conn->prepare("SELECT 
`comment`.`id`, `user`, `blog`, `content`, `comment`.`created`, `user`.`username` 
FROM `comment`
INNER JOIN `user` ON `comment`.`user` = `user`.`id`
WHERE `blog` = $blogID;");

$comment->execute();
$comment->store_result();
$comment->bind_result($cID, $cUser, $cBlog, $cContent, $bCreated, $uName);

?>

<section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
        <h1 class="text-3xl font-semibold text-[#880707] capitalize lg:text-4xl dark:text-white">Blog post</h1>

        <div class="mt-8 lg:-mx-6 lg:flex lg:items-center">
            <img class="object-cover w-full lg:mx-6 lg:w-1/2 rounded-xl h-72 lg:h-96" src="<?=ROOT_DIR?>assets/images/shows/<?= $bImage ?>"alt="">

            <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6 ">
                <p class="text-sm text-[#880707] uppercase">Created at: <?=$bCreated?></p>

                <a class="block mt-4 text-2xl font-semibold text-gray-800 dark:text-white md:text-3xl">
                <p><?=$bTitle?></p>
                </a>

                <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                <p><?=$bText?></p>
                </p>

                <div class="flex items-center mt-6">
                    <div class="mx-4">
                        <h1 class="text-sm text-[#880707] dark:text-gray-200"><p>By <?=$uName?></p></h1>
                    </div>
                </div>

                <?php if(isset($_SESSION['id'])) : ?>
              <div class="mt-20">
                <form id="commentForm" action="commentControllerSanitise?bid=<?= $blogId ?>&uid=<?=$userId?>" method="post">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Comment on <?= $blogTitle ?></label>
                  <textarea id="comment" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your comment..."></textarea>
                  <button type="submit" class="relative inline cursor-pointer text-xl font-medium before:bg-violet-600  before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition before:duration-300 before:ease-in-out hover:before:origin-bottom-left hover:before:scale-x-100">Submit Comment</button>
                  <p class="mt-5">Your comment will appear once approved by admin</p>
                </form>
                <?php else : ?>
                  <p>Please sign in to comment on this blog</p>
              </div>
              <?php endif ?>

            </div>
        </div>
    </div>
</section>

<?php
include "components/footer.php";
?>