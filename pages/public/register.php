<?php
include "database/config.php";
include "components/header.php";
// session_start();
?>

<div class="font-[sans-serif]" style="background: url('assets/images/shows/login_bg.jpg') center/cover no-repeat; min-height: 100vh;">
  <div class="flex flex-col justify-center min-h-screen p-4">
    <div class="max-w-md w-full mx-auto border border-gray-300 rounded-2xl p-8 bg-white shadow">
      <div class="text-center mb-12">
        <a href="javascript:void(0)">
          <img src="<?= ROOT_DIR ?>assets/images/clyde_theatre_tp.png" alt="logo" class='w-40 inline-block' />
        </a>
      </div>

      <h2 class="text-gray-800 text-center text-2xl font-bold">Sign up</h2>
      <form action="registerController" method="post">
        <div class="space-y-6">
        <?php if (isset($_SESSION['status_message'])) : ?>
          <div class="status-message"><?= $_SESSION['status_message'] ?></div>
          <?php unset($_SESSION['status_message']) ?>
        <?php endif?>
          <div>
            <label class="text-gray-800 text-sm mb-2 block">Email</label>
            <input name="email" type="text" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter email" />
          </div>
          <div>
            <label class="text-gray-800 text-sm mb-2 block">Username</label>
            <input name="username" type="text" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter username" />
          </div>
          <div>
            <label class="text-gray-800 text-sm mb-2 block">Password</label>
            <input name="password" type="password" class="text-gray-800 bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Enter password" />
          </div>
        </div>
        <div class="!mt-8">
          <button type="submit" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-black border-2 border-black bg-[#FFF000] transition-all ease-in-out duration-300 hover:bg-black hover:text-[#FFF000] hover:border-[#FFF000] focus:outline-none">
            Create an Account
          </button>
        </div>
        <p class="text-gray-800 text-sm mt-6 text-center">
          Already have an account?
          <a href="login" class="text-[#880707] hover:text-[#4D0000] font-semibold hover:underline ml-1">Login here</a>
        </p>
      </form>
    </div>
  </div>
</div>

<?php
include "components/footer.php";
?>