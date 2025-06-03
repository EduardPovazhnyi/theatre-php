<?php
include "database/config.php";
include "components/header.php";

$user = $conn->prepare("SELECT 
`id`, `username`, `status`
 FROM `user` 
 WHERE NOT `status` = 'inactive'
 ORDER BY `id` ASC;");

$user->execute();
$user->store_result();
$user->bind_result($uID, $uName, $uStatus);
?>

<style>p {text-align: center;}</style>
<p class="text-[#880707] text-[40px] font-semibold mt-4">List of Active User Accounts</p>
<p class="text-[#880707] text-[20px] font-semibold mt-4">Warning: Deactivating a user will also delete all their comments.</p>

<style>
.center {
  margin: auto;
  width: 60%;
  padding: 10px;
  text-align: center;
  text-justify: inter-word;
}
</style>
<?php while($user->fetch()) : ?>
          <div class="bg-white center rounded overflow-hidden">
            <div class="p-1">
              <span class="text-lg center font-bold text-gray-800 mb-3"><?= $uName ?></span>
              <button class='px-4 py-2 text-sm rounded-sm font-bold text-white border-2 border-white bg-[#FF0000] transition-all ease-in-out duration-300 hover:bg-white hover:text-[#FF0000] hover:border-[#FF0000]'><a href="deactivateController?uid=<?=$uID?>"  >Deactivate</a></button>
            </div>
          </div>
          <?php endwhile ?>

<?php
include "components/footer.php";
?>