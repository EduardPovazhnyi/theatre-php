<?php
include "database/config.php";
include "components/header.php";

$blogID = $_GET['bid'];

$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `content`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
WHERE `blog`.`id` = $blogID");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bContent, $bImage, $bText, $bShow, $bCreated, $uName);
$blog->fetch();

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
            </div>
        </div>
    </div>
</section>

<?php
include "components/footer.php";
?>