<?php
require_once 'Modules/User.php';

$user = new User();
$error_message = null;

?>
<html>

<?php include('templates/includes/head.php'); ?>

<body class="dark:bg-gray-800">
  <section class="mt-16 max-w-4xl p-6 mx-auto bg-white dark:bg-gray-700 rounded-md shadow-md ">
    <h2 class="text-2xl font-semibold text-gray-700 capitalize dark:text-white">Register</h2>

    <form class="mt-4" action="" method="POST">
      <!-- error -->

      <?php
      if (isset($_POST['name'])) {
        $error_message = $user->register($_POST['name'], $_POST['email'], $_POST['password']);

        if ($error_message) {
      ?>
          <div class="flex w-full my-8 overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex items-center justify-center w-12 bg-red-600">
              <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
              </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
              <div class="mx-3">
                <span class="font-semibold text-yellow-400 dark:text-yellow-300">Warning</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">
                  <?php echo $error_message; ?>
                </p>
              </div>
            </div>
          </div>
        <?php }

        if ($user->success_message) {
        ?>

          <div class="flex w-full overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex items-center justify-center w-12 bg-emerald-500">
              <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
              </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
              <div class="mx-3">
                <span class="font-semibold text-emerald-500 dark:text-emerald-400">Success</span>
                <p class="text-sm text-gray-600 dark:text-gray-200">
                  <?php echo $user->success_message; ?>
                </p>
              </div>
            </div>
          </div>

      <?php }
      } ?>

      <div>

      </div>
      <div>
        <label class="text-gray-700 dark:text-gray-200" for="user_name">Name</label>

        <input name="name" id="user_name" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
      </div>

      <div>
        <label class="text-gray-700 dark:text-gray-200" for="emailAddress">Email Address</label>

        <input name="email" id="emailAddress" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
      </div>

      <div>
        <label class="text-gray-700 dark:text-gray-200" for="password">Password</label>

        <input name="password" id="password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
      </div>

      <div class="flex justify-end mt-6">
        <button type="submit" class="px-6 w-full py-2 leading-5 text-gray-900 transition-colors duration-200 transform bg-gray-200 rounded-md hover:bg-gray-400 focus:outline-none focus:bg-gray-400">Register</button>
      </div>
    </form>
  </section>

</body>

</html>