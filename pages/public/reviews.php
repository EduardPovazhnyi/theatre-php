<?php
include "database/config.php";
include "components/header.php";

$review = $conn->prepare("SELECT 
`review`.`id`, `user`, `show`, `content`, `review`.`created`, `show`.`name`, `user`.`username`
FROM `review`
INNER JOIN `user` ON `review`.`user` = `user`.`id`
INNER JOIN `show` ON `review`.`show` = `show`.`id`
ORDER BY `review`.`created` DESC;");

$review->execute();
$review->store_result();
$review->bind_result($rID, $rUser, $rShow, $rText, $rCreated, $sName, $uName);

?>

<div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
      <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <h2 class="text-3xl font-extrabold text-[#880707] mb-8">Reviews</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
          <?php while($review->fetch()) : ?>
          <div class="bg-white rounded overflow-hidden">
            <div class="p-6">
              <h3 class="text-lg font-bold text-gray-800 mb-3">Review of <?= $sName ?> </h3>
              <p class="text-[#880707] text-[13px] font-semibold mt-4">By <?= $uName ?> </p>
              <a href="blogInfo?bid=<?=$rShow?>" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-[#880707] hover:bg-[#4D0000] text-white text-[13px]">Read More</a>
            </div>
          </div>
          <?php endwhile ?>
        </div>
      </div>
    </div>
<?php
include "components/footer.php";
?>