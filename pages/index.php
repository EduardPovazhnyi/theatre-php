<?php
include "database/config.php";
include "components/header.php";

// get most recent 3 blog posts
$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`, `show`.`name`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
INNER JOIN `show` ON `blog`.`show` = `show`.`id`
ORDER BY `created` DESC
LIMIT 3;");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bImage, $bText, $bShow, $bCreated, $uName, $sName);

// get most recent 3 reviews
$review = $conn->prepare("SELECT
`review`.`id`, `user`, `show`, `content`, `review`.`created`, `show`.`name`, `user`.`username`
FROM `review`
INNER JOIN `user` ON `review`.`user` = `user`.`id`
INNER JOIN `show` ON `review`.`show` = `show`.`id`
ORDER BY `review`.`created` DESC
LIMIT 3;");

$review->execute();
$review->store_result();
$review->bind_result($rID, $rUser, $rShow, $rText, $rCreated, $sName, $uName);
?>

<style>p {text-align: center;}</style>
<p class="text-[#880707] text-[40px] font-semibold mt-4">Welcome to Clyde Theatre!</p>
<p class="text-[#880707] text-[20px] font-semibold mt-4">We are a local theater committed to working with and for the community to produce the best stage plays and films. Glad to see you on our web.</p>

<!-- show blog posts -->
<div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
      <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <h2 class="text-3xl font-extrabold text-[#880707] mb-8">Latest Blog Posts</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
          <?php while($blog->fetch()) : ?>
          <div class="bg-white rounded overflow-hidden">
            <img src="<?=ROOT_DIR?>assets/images/shows/<?= $bImage ?>" alt="<?= $sName ?>" class="w-full h-52 object-cover" />
            <div class="p-6">
              <h3 class="text-lg font-bold text-gray-800 mb-3"><?= $bTitle ?> </h3>
              <p class="text-[#880707] text-[13px] font-semibold mt-4">By <?= $uName ?> </p>
              <a href="blog?bid=<?=$bID?>" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-[#880707] hover:bg-[#4D0000] text-white text-[13px]">Read More</a>
            </div>
          </div>
          <?php endwhile ?>
        </div>
      </div>
    </div>

<!-- show reviews -->
<div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
      <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <h2 class="text-3xl font-extrabold text-[#880707] mb-8">Latest Reviews</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
          <?php while($review->fetch()) : ?>
          <div class="bg-white rounded overflow-hidden">
            <div class="p-6">
              <h3 class="text-lg font-bold text-gray-800 mb-3">Review of <?= $sName ?> </h3>
              <p class="text-[#880707] text-[13px] font-semibold mt-4">By <?= $uName ?> </p>
              <a href="show?sid=<?=$rShow?>" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-[#880707] hover:bg-[#4D0000] text-white text-[13px]">Read More</a>
            </div>
          </div>
          <?php endwhile ?>
        </div>
      </div>
    </div>
<?php
include "components/footer.php";
?>