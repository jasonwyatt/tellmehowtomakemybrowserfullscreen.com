<?php

class UserAgent{
    public /*.string.*/ $vendor;
    public /*.string.*/ $browser;
    public /*.string.*/ $version;
    public /*.string.*/ $operating_system;
    public /*.bool.*/ $is_mobile = false;
    public /*.string.*/ $ua_string;
    public /*.bool.*/ $is_unknown = false;
    
    
    /**
     * Analyze the user agent string.
     * @return boolean
     */
    function analyze(){
    
        /*
         * Analyze the vendor and browser.
         */
        if(preg_match("/Firefox\\/([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $matches) != 0){
        
            $this->vendor = 'Mozilla';
            $this->browser = 'Firefox';
            $this->version = $matches[1];
            
        } elseif(preg_match("/Chrome\\/([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $matches) != 0){
        
            $this->vendor = 'Google';
            $this->browser = 'Chrome';
            $this->version = $matches[1];
            
        } elseif(preg_match("/MSIE ([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $matches) != 0){
        
            $this->vendor = 'Microsoft';
            if(preg_match("/Windows Phone OS ([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $os_matches) != 0){
                $this->browser = 'IE Mobile';
                $this->operating_system = $os_matches[0];
            }
            $this->browser = 'Internet Explorer';
            $this->version = $matches[1];
            
        } elseif(preg_match("/Safari/i", $this->ua_string) != 0){
        
            $this->vendor = 'Apple';
            if(preg_match("/Mobile/i", $this->ua_string) != 0){
                $this->browser = "Mobile Safari";
                $this->is_mobile = true;
            } else {
                $this->browser = "Safari";
                $this->is_mobile = false;
            }
            preg_match("/Version\\/([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $matches);
            $this->version = $matches[1];
            
        } elseif(preg_match("/Opera/i", $this->ua_string) != 0){
        
            $this->vendor = 'Opera';
            $this->browser = 'Opera';
            
            preg_match("/Version\\/([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $matches);
            $this->version = $matches[1];
            $this->is_mobile = false;
            
        } elseif(preg_match("/Android ([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $matches) != 0){
        
            $this->vendor = 'Google';
            $this->browser = 'Android';
            $this->operating_system = $matches[0];
            $this->is_mobile = true;
            if(preg_match("/Version\\/([0-9]+(\\.[0-9a-z]+)+)/i", $this->ua_string, $matches) != 0){
                $this->version = $matches[1];
            } else {
                $this->version = 'unknown';
            }
        
        } else {
            return false;
        }
        
        if($this->operating_system === null){
            // figure out the operating system.
            $this->operating_system = 'unknown';
            
            if(preg_match("/Windows NT ([0-9]+(\\.[0-9a-z]+)+);/", $this->ua_string, $matches) != 0){
                if($matches[1] === '6.1'){
                    $this->operating_system = 'Windows 7';
                } elseif ($matches[1] === '6.0') {
                    $this->operating_system = 'Windows Vista';
                } elseif ($matches[1] === '5.0') {
                    $this->operating_system = 'Windows 2000';
                } elseif ($matches[1] === '5.1') {
                    $this->operating_system = 'Windows XP';
                } elseif ($matches[1] === '5.2') {
                    $this->operating_system = 'Windows Server 2003';
                } elseif ($matches[1] === '4.0') {
                    $this->operating_system = 'Windows NT';
                }
            } elseif (preg_match("/Windows 95/", $this->ua_string) != 0) {
                $this->operating_system = 'Windows 95';
            } elseif (preg_match("/Windows 98/", $this->ua_string) != 0) {
                $this->operating_system = 'Windows 98';
            } elseif (preg_match("/Windows CE/", $this->ua_string) != 0) {
                $this->operating_system = 'Windows CE';
            } elseif (preg_match("/Linux ((x86_64)|(i686)|(AMD64))/i", $this->ua_string, $matches) != 0){
                $this->operating_system = $matches[0];
            } elseif (preg_match("/Mac OS X ([0-9]+([\\._][0-9]+)*)/", $this->ua_string, $matches) != 0) {
                $this->operating_system = "Mac OS X ".str_replace('_', '.', (string)$matches[1]);
            }
        }
        
        
        return true;
    }
    
    /**
     * Constructor.
     * @return void
     */
    public function __construct() {
        $this->ua_string = $_SERVER['HTTP_USER_AGENT'];
        
        if( $this->analyze() ){
            $this->is_unknown = false;
        } else {
            $this->is_unknown = true;
        }
    }
}

?>