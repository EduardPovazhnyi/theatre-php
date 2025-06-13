<?php
include "database/config.php";
include "components/header.php";

$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`, `show`.`name`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
INNER JOIN `show` ON `blog`.`show` = `show`.`id`
ORDER BY `created` DESC;");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bImage, $bText, $bShow, $bCreated, $uName, $sName);

?>

<!-- Theatre background section -->
<div class="w-full flex justify-center items-center">
  <img src="assets/images/shows/theatre.jpg" alt="Clyde Theatre" class="w-full max-h-[400px] object-cover shadow-lg" style="object-position: center;">
</div>

<!-- Title and subtitle under the image -->
<div class="text-center mt-4 mb-6">
  <h1 class="text-[#880707] text-[40px] font-extrabold">Welcome to Clyde Theatre!</h1>
  <p class="text-[#880707] text-[20px] font-extrabold mt-4">
    We are a local theater committed to working with and for the community to produce the best stage plays and films. Glad to see you on our web.
  </p>
</div>

<div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
      <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <h2 class="text-3xl font-extrabold text-[#880707] mb-8">Blog posts</h2>
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
<?php
include "components/footer.php";
?>