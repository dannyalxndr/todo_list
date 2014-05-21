<?php

$items = array();

function list_items($list) 
{
    $place = '';
    // Iterate through list items
    foreach ($list as $key => $item) 
    {
        $newKey = $key + 1;
        $place .= "[" . $newKey . "]" . " " . $item . PHP_EOL;
    // Display each item and a newline
    }
    return $place;
}

// Get STDIN, strip whitespace and newlines, 
// and convert to uppercase if $upper is true
function get_input($upper = false) 
{
    // Return filtered STDIN input
    if($upper == TRUE) 
    {
        return strtoupper(trim(fgets(STDIN)));
    } 
    else 
    {
        return trim(fgets(STDIN));
    }
}

function sort_menu($items)
{
    echo "(A)-Z, (Z)-A, (O)rder entered, (R)everse order entered: ";
    $input = get_input(true); 

    // sort the $items
    switch ($input) 
    {
        case 'A':
            sort($items, SORT_NATURAL|SORT_FLAG_CASE);
            break;
        case 'Z':
            rsort($items, SORT_NATURAL|SORT_FLAG_CASE);
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

function read_file($filename) 
{
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    $contents_array = explode("\n", $contents);
    fclose($handle);
    return $contents_array;
}

function save_file($filename, $data_to_save)
{
    $input = 'Y';

    if (file_exists($filename)) 
    {
        echo "This will overwrite the file. Are you sure? Y or N? ";
        $input = get_input(TRUE);
    }

    if ($input == 'Y') 
    {
        $handle = fopen($filename, 'w');
        $contents = implode("\n", $data_to_save);
        fwrite($handle, $contents);
        fclose($handle);
    } else {
        echo "No changes were made.\n";
    }
}

do 
{
    echo list_items($items);
    echo '(N)ew item, (R)emove item, (S)ort, (M)anage files, (Q)uit : ';
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
    elseif ($input == 'A')
    {
        save_file();
        echo "Your file has been saved!\n";
    }
    // option for opening a file
    elseif ($input == 'M') 
    {

        echo "(O)pen file - or - (S)ave file? ";
        $input = get_input(TRUE);

        echo "Enter filename: ";
        $filename = get_input();

        if($input == 'S')
        {
            save_file($filename, $items);
            echo "\n.. saving file ..\n\n";
        } elseif($input == 'O') 
        {
            $new_items = read_file($filename);
            $items = array_merge($items, $new_items);
            echo "\n.. file is merging ..\n\n";
        }
    }
} 
// quitting option
while ($input != 'Q');

echo "Goodbye!\n";
exit(0);