<?php

// Create a new directory in your vagrant-lamp directory named todo_list with a file named todo.php containing the code above. Use git init to initialize a new local repository in that directory and commit your code. Create a new remote repository on GitHub called CLI_Todo_List and add the remote to your local repository so you can push your code.

// After each exercise item, commit and push changes to your GitHub repository.

// Update the code to allow upper and lowercase inputs from user for all menu items. Test adding, removing, and quitting.

// Update the program to start numbering the list with 1 instead of 0. Make sure remove still works as expected.



// Create array to hold list of todo items
$items = array();

do 
{
    foreach ($items as $key => $item) 
    {   
        $key++;
        echo "[{$key}] {$item}\n";
    }
    echo '(N)ew item, (R)emove item, (Q)uit : ';
    
    $input = trim(fgets(STDIN));
    
    if (($input == 'N') || ($input == 'n')) 
    {
        echo 'Enter item: ';
        $items[] = trim(fgets(STDIN));
    } 
    
    elseif (($input == 'R') || ($input == 'r'))
    {
        echo 'Enter item number to remove: ';
        $key = trim(fgets(STDIN)) - 1;
        unset($items[$key]);
        $items = array_values($items);
    }
} 
while (($input != 'Q') && ($input != 'q'));

echo "Goodbye!\n";

exit(0);


