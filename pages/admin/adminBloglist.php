<?php
include "database/config.php";
include "components/header.php";

// get all blogs
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

<style>p {text-align: center;}</style>
<p class="text-[#880707] text-[40px] font-semibold mt-4">Admin Blog List</p>


<style>
.center {
  margin: auto;
  width: 60%;
  padding: 10px;
  text-align: justify;
  text-justify: inter-word;
}
</style>
<?php while($blog->fetch()) : ?>
          <div class="bg-white center rounded overflow-hidden">
            <div class="p-1">
              <span class="text-lg font-bold text-gray-800 mb-3"><?= $bTitle ?>       By <?= $uName ?>  </span>
              <button class='px-4 py-2 text-sm rounded-sm font-bold text-white border-2 border-white bg-[#00FF00] transition-all ease-in-out duration-300 hover:bg-white hover:text-[#00FF00] hover:border-[#00FF00]'><a href="addblog" >Edit</a></button>
              <button class='px-4 py-2 text-sm rounded-sm font-bold text-white border-2 border-white bg-[#FF0000] transition-all ease-in-out duration-300 hover:bg-white hover:text-[#FF0000] hover:border-[#FF0000]'><a href="deleteBlogControllerList?bid=<?=$bID?>"  >Delete</a></button>
            </div>
          </div>
          <?php endwhile ?>

<?php
include "components/footer.php";
?>