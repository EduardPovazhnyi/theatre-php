<?php
include "database/config.php";
include "components/header.php";

$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
ORDER BY `created` DESC;");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bImage, $bText, $bShow, $bCreated, $uName);

?>

<div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
      <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <h2 class="text-3xl font-extrabold text-[#880707] mb-8">Blog Posts</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
          <?php while($blog->fetch()) : ?>
          <div class="bg-white rounded overflow-hidden">
            <img src="<?=ROOT_DIR?>assets/images/shows/<?= $bImage ?>" alt="Blog Post 1" class="w-full h-52 object-cover" />
            <div class="p-6">
              <h3 class="text-lg font-bold text-gray-800 mb-3"><?= $bTitle ?> </h3>
              <p class="text-[#880707] text-[13px] font-semibold mt-4">By <?= $uName ?> </p>
              <a href="blogInfo?bid=<?=$bID?>" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-[#880707] hover:bg-[#4D0000] text-white text-[13px]">Read More</a>
            </div>
          </div>
          <?php endwhile ?>
        </div>
      </div>
    </div>
<?php
include "components/footer.php";
?>