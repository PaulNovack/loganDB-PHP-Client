# loganDB-PHP-Client
##Client for loganDB server

More information at: http://logandb.com

## Version 0.5.0 without long data value support limited to under ~10,000 character values

## Added 

UnitTestV1.php which does some of needed unit tests.

##To do:

Write more unit tests for this PHP Client and Java Client.

Fix the large data value bugs to allow over ~10,000 character values

## Output of run of v1 of unit tests below

<table >                <tr class="testhead">
                    <td colspan="2">
                        <strong>Test #1:</strong> Run test of 500 24 Byte key and 8000 Byte value pairs and verify output.
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Test #1 preparing data:</strong> Creating random array of 500 24 Byte key and 8000 Byte value pairs........
                    </td>     
                </tr>                <tr class="ops">
                    <td>
                        <strong>Prepare operations per second:</strong>&nbsp;&nbsp; 12 ops/sec.
                    </td>   
                    <td>
                        <strong>Prepare time to complete:</strong>&nbsp;&nbsp; 
        39 seconds AND 215374 microseconds
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Running operation to test...................
                    </td>     
                </tr>                <tr class="ops">
                    <td>
                        <strong>Run operations per second:</strong>&nbsp;&nbsp; 1306 ops/sec.
                    </td>   
                    <td>
                        <strong>Run time to complete:</strong>&nbsp;&nbsp; 
        0 seconds AND 382765 microseconds
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Check operation to check operation ran and worked properly...................
                    </td>     
                </tr>                <tr class="pass">
                    <td colspan="2">
                        <strong>Result:</strong>&nbsp;&nbsp;---- PASS ----
                    </td>     
                </tr>                        <tr class="ops">
                    <td>
                        <strong>Check operations per second:</strong>&nbsp;&nbsp; 1573 ops/sec.
                    </td>   
                    <td>
                        <strong>Check time to complete:</strong>&nbsp;&nbsp; 
        0 seconds AND 317770 microseconds
                    </td>     
                </tr>                <tr class="testhead">
                    <td colspan="2">
                        <strong>Test #2:</strong> Run test of 50000 24 Byte key and 40 Byte value pairs and verify output.
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Test #2 preparing data:</strong> Creating random array of 50000 24 Byte key and 40 Byte value pairs........
                    </td>     
                </tr>                <tr class="ops">
                    <td>
                        <strong>Prepare operations per second:</strong>&nbsp;&nbsp; 1405 ops/sec.
                    </td>   
                    <td>
                        <strong>Prepare time to complete:</strong>&nbsp;&nbsp; 
        35 seconds AND 583148 microseconds
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Running operation to test...................
                    </td>     
                </tr>                <tr class="ops">
                    <td>
                        <strong>Run operations per second:</strong>&nbsp;&nbsp; 1735 ops/sec.
                    </td>   
                    <td>
                        <strong>Run time to complete:</strong>&nbsp;&nbsp; 
        28 seconds AND 818335 microseconds
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Check operation to check operation ran and worked properly...................
                    </td>     
                </tr>                <tr class="pass">
                    <td colspan="2">
                        <strong>Result:</strong>&nbsp;&nbsp;---- PASS ----
                    </td>     
                </tr>                        <tr class="ops">
                    <td>
                        <strong>Check operations per second:</strong>&nbsp;&nbsp; 1766 ops/sec.
                    </td>   
                    <td>
                        <strong>Check time to complete:</strong>&nbsp;&nbsp; 
        28 seconds AND 309092 microseconds
                    </td>     
                </tr>                <tr class="testhead">
                    <td colspan="2">
                        <strong>Test #3:</strong> Run test of 5 80 Byte key and 80 Byte value pairs and verify output.
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Test #3 preparing data:</strong> Creating random array of 5 80 Byte key and 80 Byte value pairs........
                    </td>     
                </tr>                <tr class="ops">
                    <td>
                        <strong>Prepare operations per second:</strong>&nbsp;&nbsp; 178 ops/sec.
                    </td>   
                    <td>
                        <strong>Prepare time to complete:</strong>&nbsp;&nbsp; 
        0 seconds AND 27997 microseconds
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Running operation to test...................
                    </td>     
                </tr>                <tr class="ops">
                    <td>
                        <strong>Run operations per second:</strong>&nbsp;&nbsp; 2622 ops/sec.
                    </td>   
                    <td>
                        <strong>Run time to complete:</strong>&nbsp;&nbsp; 
        0 seconds AND 1906 microseconds
                    </td>     
                </tr>                <tr class="desc">
                    <td colspan="2">
                        <strong>Check operation to check operation ran and worked properly...................
                    </td>     
                </tr>                <tr class="pass">
                    <td colspan="2">
                        <strong>Result:</strong>&nbsp;&nbsp;---- PASS ----
                    </td>     
                </tr>                        <tr class="ops">
                    <td>
                        <strong>Check operations per second:</strong>&nbsp;&nbsp; 286 ops/sec.
                    </td>   
                    <td>
                        <strong>Check time to complete:</strong>&nbsp;&nbsp; 
        0 seconds AND 17469 microseconds
                    </td>     
                </tr>            </table> 
