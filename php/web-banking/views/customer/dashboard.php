<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Tailwindcss CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- AlpineJS CDN -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <!-- Inter Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet" />
  <style>
  * {
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
      'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
      'Helvetica Neue', sans-serif;
  }
  </style>

  <title>Dashboard</title>
</head>

<body class="h-full">
  <div class="min-h-full">
    <div class="bg-emerald-600 pb-32">
      <!-- Navigation -->
      <?php
      require_once "../nav.php";
      require_once "../header.php";
      ?>
    </div>

    <main class="-mt-32">
      <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg p-2">
          <!-- Current Balance Stat -->
          <dl class="mx-auto grid grid-cols-1 gap-px sm:grid-cols-2 lg:grid-cols-4">
            <div
              class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
              <dt class="text-sm font-medium leading-6 text-gray-500">
                Current Balance
              </dt>
              <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                $10,115,091.00
              </dd>
            </div>
          </dl>

          <!-- List of All The Transactions -->
          <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
              <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700">
                  Here's a list of all your transactions which inlcuded
                  receiver's name, email, amount and date.
                </p>
              </div>
            </div>
            <div class="mt-8 flow-root">
              <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                  <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                      <tr>
                        <th scope="col"
                          class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                          Receiver Name
                        </th>
                        <th scope="col"
                          class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                          Email
                        </th>
                        <th scope="col"
                          class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                          Amount
                        </th>
                        <th scope="col"
                          class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                          Date
                        </th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0">
                          Bruce Wayne
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                          bruce@wayne.com
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm font-medium text-emerald-600">
                          +$10,240
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                          29 Sep 2023, 09:25 AM
                        </td>
                      </tr>
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0">
                          Al Nahian
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                          alnahian@2003.com
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm font-medium text-red-600">
                          -$2,500
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                          15 Sep 2023, 06:14 PM
                        </td>
                      </tr>
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0">
                          Muhammad Alp Arslan
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                          alp@arslan.com
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm font-medium text-emerald-600">
                          +$49,556
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                          03 Jul 2023, 12:55 AM
                        </td>
                      </tr>

                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0">
                          Povilas Korop
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                          povilas@korop.com
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm font-medium text-emerald-600">
                          +$6,125
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                          07 Jun 2023, 10:00 PM
                        </td>
                      </tr>

                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0">
                          Martin Joo
                        </td>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                          martin@joo.com
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm font-medium text-red-600">
                          -$125
                        </td>
                        <td class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                          02 Feb 2023, 8:30 PM
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>

</html>