<?php
/****************************************************
    By   Mirza N.
    On   Apr 2nd 2013
    For  Bicom Systems
    Purpose: programming test #2 "IP Address Range"  
*****************************************************/

if ( $argv[1] and $argv[2] and $argv[3] )   //Verify that all CLI parameters exist.
{
    $fileHandle = @fopen( $argv[2], "r" );
    if ($fileHandle) 
    {
        $arrIPaddress = preg_split('/[.]/', $argv[3]);      //Split given IP address into an array of octets.
        $binaryIPAddress = convertIPToBinary($arrIPaddress); //Convert given IP address into binary sting for quick comparison.
        
        while ( ($lineFromFile = fgets($fileHandle)) !== false )
        {
            $arrIP_range = preg_split('/[.\/]/', $lineFromFile); //Split IP range into an array of octets and subnet mask into an array for comparison.
            $binaryIP_range = convertIPToBinary($arrIP_range); //Convert IP range into binary sting for quick comparison.
        
            if( ! strncmp($binaryIPAddress, $binaryIP_range, $arrIP_range[4]) )  //Compare Network ID portion of the given IP address and current range. Print those that match.
            {
                print $lineFromFile."\r\n";
            }
        }
        
        if (!feof($fileHandle))
        {
            print "Error: unexpected fgets() fail!!\n";
        }
        
        fclose($fileHandle);
    }
    else
    {
        print "\n Unable to open input file \"".$argv[1]."\" !!!\n";
    }
}
else 
{
    print "\n Missing parameter!\n Please provide all three parameters.\n";
}

    
    
function convertIPToBinary($arrIPaddress)
{
    for($i=0; $i<4; $i+=1)
    {
        $octetOfIP = $arrIPaddress[$i];
        
        for($c=7; $c>=0; $c-=1)
        {
            if($octetOfIP >= pow(2, $c))
            {
                $binary .= "1";
                $octetOfIP -= pow(2, $c);  
            }
            else
            {
                $binary .= "0";
            }
        }
    }
    
    return $binary;
}

?>
