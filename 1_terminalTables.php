<?php
/****************************************************
    By   Mirza Nezirovic
    On   Apr 2nd 2013
    For  Bicom Systems
    Purpose: programming test #1 "Terminal tables"  
*****************************************************/
    
if ( $argv[1] )   //Verify that CLI parameter exists.
{
    $handle = @fopen( $argv[1], "r" );
    if ($handle) 
    {
        while (($nextLine = fgets($handle)) !== false)
        {
            $nextLine = trim($nextLine, "\r\n");  //Trim off EOL to keep formating clean.
            parseLines($currentLine, $nextLine);
            $currentLine = $nextLine;
        }
        
        parseLines($currentLine, $nextLine);
            
        if (!feof($handle))
        {
            print "Error: unexpected fgets() fail!!\n";
        }
        
        fclose($handle);
    }
    else
    {
        print "\n Unable to open input file \"".$argv[1]."\" !!!\n";
    }
}
else 
{
    print "\n No input file specified!\n Please provide name of the input file.\n";
}
  

  
function parseLines ($currentLine, $nextLine)
{
    $currentLineLength = strlen($currentLine);
    $nextLineLength    = strlen($nextLine);
    
    //Print line of characters.
    for ($i = 0; $i < $currentLineLength; $i += 2)
    {
        if ( $currentLine[$i] != " " )   //Filled cell.
        {
            print "| ".$currentLine[$i]." ";
            if ($i == $currentLineLength - 1 OR $i == $currentLineLength - 2) //If filled cell is at the end of the line, adding final right side border.
                print "|";
        }
        else if ($currentLine[$i] == " " and $i != 0 and $currentLine[$i - 2] != " ") //Empty cell following a filled cell. Create right side border for the filled cell.
            print "|   ";
        else
            print "    ";
    }
    print "\r\n";
    
    //Print border between current row and the next row.
    $borderLength = $currentLineLength;
    if ($nextLineLength > $currentLineLength)
        $borderLength = $nextLineLength;
    
    for ($i = 0; $i < $borderLength; $i += 2)
    {
      if ( ($currentLine[$i] != " " and $i < $currentLineLength) or ($nextLine[$i] != " " and $i < $nextLineLength))  //Filled cell on current line OR on next line.
        {
            print "+---";
            if ($i == $borderLength - 1 or $i == $borderLength - 2) //If filled cell is at the end of the line, adding final right side border.
                print "+";
        }
        else if (  ($currentLine[$i] == " " and $i != 0 and $currentLine[$i - 2] != " ") //An empty cell following a filled cell on the current line. Creating right side border for the filled cell.
                or ($currentLine[$i] != " " and $i == $currentLineLength + 1) //Handle case where current line is longer then the next line.
                or ($nextLine[$i] == " " and $i != 0 and $nextLine[$i - 2] != " ") //An empty cell following a filled cell on the next line. Creating right side border for the filled cell.
                or ($nextLine[$i] != " " and $i == $nextLineLength + 1)) //Handle case where next line is longer then the current line.
            print "+   ";
        else
            print "    ";
    }
    print "\r\n";
}

?>
