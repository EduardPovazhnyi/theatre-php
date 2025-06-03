<?php
include "database/config.php";
include "components/header.php";

$showID = $_GET['sid'];


// get details of this show
$show = $conn->prepare("SELECT `id`, `name`, `type`, `created` 
FROM `show` 
WHERE `show`.`id` = $showID;");

$show->execute();
$show->store_result();
$show->bind_result($sID, $sName, $sType, $sCreated);
$show->fetch();

// get all blog posts on this show
$blog = $conn->prepare("SELECT
`blog`.`id`, `user`, `title`, `image_url`, `content`, `show`, `blog`.`created`, `user`.`username`, `show`.`name`
FROM `blog`
INNER JOIN `user` ON `blog`.`user` = `user`.`id`
INNER JOIN `show` ON `blog`.`show` = `show`.`id`
WHERE `show` = $showID
ORDER BY `created` DESC;");

$blog->execute();
$blog->store_result();
$blog->bind_result($bID, $bUser, $bTitle, $bImage, $bText, $bShow, $bCreated, $uName, $sName);

// get all reviews on this show
$review = $conn->prepare("SELECT
`review`.`id`, `user`, `show`, `content`, `review`.`created`, `show`.`name`, `user`.`username`
FROM `review`
INNER JOIN `user` ON `review`.`user` = `user`.`id`
INNER JOIN `show` ON `review`.`show` = `show`.`id`
WHERE `show` = $showID
ORDER BY `review`.`created` DESC;");

$review->execute();
$review->store_result();
$review->bind_result($rID, $rUser, $rShow, $rText, $rCreated, $sName, $uName);
?>

<style>p {text-align: center;}</style>
<p class="text-[#880707] text-[40px] font-semibold mt-4"><?= $sName ?> </p>
<p class="text-[#880707] text-[20px] font-semibold mt-4">Show type: <?= $sType ?> </p>



<!-- text box to leave a review -->
<?php if(isset($_SESSION['id'])) : ?>
              <div class="mt-20">
                <form id="commentForm" action="reviewController?sid=<?= $showID ?>&uid=<?=$_SESSION['id']?>" method="post">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Review show <?= $sName ?></label>
                  <textarea id="comment" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your comment..."></textarea>
                  <button type="submit" class="relative inline cursor-pointer text-xl font-medium text-[#880707] hover:text-[#4D0000] before:bg-[#FFF000]  before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition before:duration-300 before:ease-in-out hover:before:origin-bottom-left hover:before:scale-x-100">Submit Review</button>
                </form>
                <?php else : ?>
                  <p>Please sign in to review this show.</p>
              </div>
              <?php endif ?>
              
<!-- show reviews of this show -->

<h2 class="mt-20 text-3xl font-extrabold text-[#880707] mb-8">Reviews for <?= $sName ?></h2>
    <div class="flex justify-center relative top-1/3">
  <?php if ($review->num_rows == 0) : ?>
    <p class="mt-20">No reviews have been left yet </p>
    <?php else : ?>
  <?php while($review->fetch()) : ?>
<div class="mt-1 relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
    <div class="relative flex gap-4">
        <div class="flex flex-col w-full">
            <div class="flex flex-row justify-between">
                <p class="relative text-xl whitespace-nowrap truncate overflow-hidden"><?= $uName ?></p>
                <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
            </div>
            <p class="text-gray-500"><?= htmlspecialchars($rText) ?></p>

            <!-- only show delete button if user is logged in AND an admin -->
            <?php if(isset($_SESSION['id'])) : ?>
              <?php if ($_SESSION['role'] == 'admin') : ?>
                <button class='px-4 py-2 text-sm rounded-sm font-bold text-white border-2 border-white bg-[#FF0000] transition-all ease-in-out duration-300 hover:bg-white hover:text-[#FF0000] hover:border-[#FF0000]'><a href="deleteReviewController?rid=<?=$rID?>&sid=<?=$showID?>" >Delete</a></button>
            <?php endif ?>
            <?php endif ?>

        </div>
    </div>
    <p class="-mt-2 text-gray-400 text-sm"><?= $rCreated ?></p>
</div>
<?php endwhile ?>
<?php endif ?>
</div>


<!-- show blog posts -->
<div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
      <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">
        <h2 class="text-3xl font-extrabold text-[#880707] mb-8">Blog posts for <?= $sName ?></h2>
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