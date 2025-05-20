<?php
include "database/config.php";
include "components/header.php";

$blog = $conn->prepare("SELECT 
`review`.`id`, `user`, `show`, `content`, `review`.`created`, `show`.`name`, `user`.`username`
FROM `review`
INNER JOIN `user` ON `review`.`user` = `user`.`id`
INNER JOIN `show` ON `review`.`show` = `show`.`id`
ORDER BY `review`.`created` DESC;");

$blog->execute();
$blog->store_result();
$blog->bind_result($rID, $rUser, $rShow, $rText, $rCreated, $sName, $uName);

?>

<!-- component -->
<div class="bg-gradient-to-bl from-blue-50 to-violet-50 flex items-center justify-center lg:h-screen">
      <div class="container mx-auto mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-4">
          <div class="bg-white rounded-lg border p-4">
            <div class="px-1 py-4">
              <div class="font-bold text-xl mb-2">Blog Title</div>
              <p class="text-gray-700 text-base">This is a simple blog card example using Tailwind CSS. You can replace this text with your own blog content.</p>
            </div>
            <div class="px-1 py-4">
              <a href="#" class="text-blue-500 hover:underline">Read More</a>
            </div>
          </div>
          <!-- Add more items as needed -->
        </div>
      </div>
</div>

<?php
include "components/footer.php";
?>