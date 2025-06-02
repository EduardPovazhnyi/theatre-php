<?php
include "database/config.php";
include "components/header.php";
?>

<?php if(isset($_SESSION['id'])) : ?>
              <div class="mt-20">
                <form id="commentForm" action="feedbackController?uid=<?=$_SESSION['id']?>" method="post">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Leave feedback here:</label>
                  <textarea id="comment" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your comment..."></textarea>
                  <button type="submit" class="relative inline cursor-pointer text-xl font-medium text-[#880707] hover:text-[#4D0000] before:bg-[#FFF000]  before:absolute before:-bottom-1 before:block before:h-[2px] before:w-full before:origin-bottom-right before:scale-x-0 before:transition before:duration-300 before:ease-in-out hover:before:origin-bottom-left hover:before:scale-x-100">Submit Feedback</button>
                </form>
                <?php else : ?>
                  <p>Please sign in to leave feedback.</p>
              </div>
              <?php endif ?>

<?php
include "components/footer.php";
?>