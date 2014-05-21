<?php

// this is my empty array for the list of items
$items = array();


/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
//                     ** FUNCTIONS BELOW **                        


// function to display the results of your items list
function list_items($list)
{
    $result = '';

    foreach ($list as $key => $value)
    {
        $result .= "[" . ($key + 1) . "] {$value}\n";  
    }
    return $result;
}

// function that reads the input of your user
function get_input($upper = false) 
{
    $result = trim(fgets(STDIN));
    return $upper ? strtoupper($result) : $result;
}

// function for sorting your items menu how you'd like
function sort_menu($items)
{
    echo "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ";
    $input = get_input(true); 

    // sort the $items
    switch ($input) 
    {
        case 'A':
            asort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
        case 'Z':
            arsort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
        case 'O':
            ksort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
        case 'R':
            krsort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
    }

    return $items;   
}

// function that imports a file to the list
function read_file()
{
    echo "Enter the filename: ";
    $filename = get_input();
    $handle = fopen($filename, 'r');
    $contents = trim(fread($handle, filesize($filename)));
    return $contents;
    fclose($handle);
}


//                   ^^^ FUNCTIONS ^^^
/////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////

// the loop of input conditions

do 
{
    echo list_items($items);
    echo '(N)ew item, (R)emove item, (S)ort, (O)pen file, (Q)uit : ';
    $input = get_input(true);
    
    // to put in a new item
    if ($input == 'N') 
    {   
        echo "Enter item: ";
        $item = trim(fgets(STDIN));

        echo "Add this item to the [B]eginning or [E]nd of list: ";
        $b_and_e = get_input(true);

        // option for putting the item in the beginning
        if ($b_and_e == 'B')
        {
            array_unshift($items, $item);
        }

        // option for putting the item on the end
        elseif ($b_and_e == 'E')
        {
            array_push($items, $item);
        }
    } 
    // option for removing any item
    elseif ($input == 'R') 
    {
        echo 'Enter item number to remove: ';
        $key = get_input();
        $key--;
        unset($items[$key]);
        $items = array_values($items);
    }
    // hidden option to remove the first item
    elseif ($input == 'F')
    {
        array_shift($items);
    }
    // hidden option to remove the last item
    elseif ($input == 'L')
    {
        array_pop($items);
    }
    // option for sorting your list
    elseif ($input == 'S')
    {
        $items = sort_menu($items);
    }
    // option for opening a file
    elseif ($input == 'O')
    {      
        $contents = read_file();
        // explode the string into an array
        $content_array = explode("\n", $contents);
        $items = array_merge($items, $content_array);
    }
} 
// quitting option
while ($input != 'Q');

echo "Goodbye!\n";
exit(0);







