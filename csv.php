<?php 
class csv_writer {
    private $str = "";

    function __construct($filename) {
        $this->filename = $filename;
    }

    function write($data) {
        for($item = 0; $item < count($data); $item++) {
            
            if( $item != count($data)-1 ) {
                $this->str .= $data[$item] . ",";
            }
            
            else {
                $this->str .= $data[$item] . PHP_EOL;
            }

        }

        $handle = fopen($this->filename, "w");
        
        fwrite($handle, $this->str);
        fclose($handle);
    }
} ?>