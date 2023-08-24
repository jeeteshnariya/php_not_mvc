 <?php

  require_once '../lib/db.php';
  require_once '../lib/helper.php';
  require_once '../layout/header.php';

  $db = new db();
  $db->table_name = 'users';

  $id = get('id');

  $mode = ($id == null) ? 'insert' : 'update';

  if ($id !== null) {
    $user = $db->get_by($id);
    extract($user);
    // dd($user);
  }

  if (post('submit') !== null) {

    $data = [

      'fullname' => post('fullname'),
      'email' => post('email'),
      'contact' => post('contact'),
      'address' => post('address'),
      'status' =>  post('status') !== null ? post('status') : 'Locked',
    ];

    $mode = post('submit');
    $result = null;
    if($mode == 'insert' && $id !== null) {
      $result = $db->create($data);
    }

    if ($mode == 'update' && $id !== null) {
      $result =  $db->update($data, post('id'));
    }
 

    dd($result);
    if ($result) {
      $path = link_path('users/index.php');
      // redirect($path);
      dd(redirect($path));
    }
  }




  ?>

 <form method="post" action="<?= '/users/edit.php' ?>" class="bg-white rounded   p-4 px-4 md:p-8 mb-6 mx-64">
   <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
     <div class="text-gray-600">
       <h1 class="text-3xl font-bold">
         <?= ucfirst($mode) ?> Users <?= $id ?></h1>
       <p class="font-medium text-lg">Personal Details</p>
       <p>Please fill out all the fields.</p>
     </div>

     <div class="lg:col-span-2">
       <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
         <div class="md:col-span-5">
           <label for="fullname">Full Name</label>
           <input type="text" name="fullname" id="fullname" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?= isset($fullname) ? $fullname : '' ?>" />
         </div>

         <div class="md:col-span-2">
           <label for="email">Email Address</label>
           <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?= isset($email) ? $email : '' ?>" placeholder="email@domain.com" />
         </div>

         <div class="md:col-span-1">
           <label for="contact">Contact</label>
           <input type="text" name="contact" id="contact" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="<?= isset($contact) ? $contact : '' ?>" placeholder="+91 9876543210" />
         </div>

         <div class="md:col-span-2">
           <label for="status">Status</label>
           <div class="flex mt-4">
             <div class="flex items-center mr-4">
               <input id="inline-radio" type="radio" value="active" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
               <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Active</label>
             </div>
             <div class="flex items-center mr-4">
               <input id="inline-2-radio" type="radio" value="locked" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
               <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Locked</label>
             </div>
           </div>

         </div>

         <div class="md:col-span-5">
           <label for="address">Address / Street</label>
           <textarea type="text" name="address" id="address" class="  border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" rows="5"><?= isset($address) ? $address : '' ?></textarea>
         </div>




         <input name="submit" value="<?= $mode ?>" class="hidden">
         <input name="id" value="<?= $id ?>" class="hidden">

         <div class="md:col-span-5 text-right">
           <div class="inline-flex items-end">

             <a href="<?= link_path('users/index.php') ?>">
               <button class="bg-gray-100 hover:bg-gray-200 text-black font-bold py-2 px-4 rounded mr-2">

                 Cancle

               </button>
             </a>
             <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit"> <?= ucfirst($mode) ?></button>
           </div>
         </div>

       </div>
     </div>
   </div>
 </form>


 <?php require_once '../layout/footer.php'; ?>