<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of XFTP
 * @author              Miles <cuiming2355_cn@hotmail.com>
 * 
 * Devlopment
 * @author              melengo  <oz4n.rock@gmail.com>
 */
class XFTP extends CApplicationComponent {

    /**
     * @var string the host for establishing FTP connection. Defaults to null.
     */
    public $host = null;

    /**
     * @var string the port for establishing FTP connection. Defaults to 21.
     */
    public $port = 21;

    /**
     * @var string the username for establishing FTP connection. Defaults to null.
     */
    public $username = null;

    /**
     * @var string the password for establishing FTP connection. Defaults to null.
     */
    public $password = null;

    /**
     * @var boolean
     */
    public $ssl = false;

    /**
     * @var string the timeout for establishing FTP connection. Defaults to 90.
     */
    public $timeout = 120;

    /**
     * @var boolean whether the ftp connection should be automatically established
     * the component is being initialized. Defaults to false. Note, this property is only
     * effective when the EFtpComponent object is used as an application component.
     */
    public $cache;
    public $autoConnect = true;
    private $_active = false;
    private $_errors = null;
    private $_connection = null;
    var $natij = array();
    var $orgDir;

    /**
     * @param	varchar	$host
     * @param	varchar	$username
     * @param	varchar	$password
     * @param	boolean	$ssl
     * @param	integer	$port
     * @param	integer	$timeout
     */
    public function __construct($host = '127.0.0.1', $username = null, $password = 'dashboard', $ssl = false, $port = 21, $timeout = 90) {
        $this->host = 'ozan-rock.com';
        $this->username = 'nunen335';
        $this->password = 'vg57RrN569';   
        
//        $this->host = '125.167.149.63';
//        $this->username = 'dashboard';
//        $this->password = 'blink_182';
        
//        $this->host = '192.168.137.2';
//        $this->username = 'dani';
//        $this->password = 'dashboard';
        $this->ssl = $ssl;
        $this->port = $port;
        $this->timeout = $timeout;
    }

    /**
     * Initializes the component.
     * This method is required by {@link IApplicationComponent} and is invoked by application
     * when the EFtpComponent is used as an application component.
     * If you override this method, make sure to call the parent implementation
     * so that the component can be marked as initialized.
     */
    public function init() {
        parent::init();

        if ($this->autoConnect)
            $this->setActive(true);
    }

    /**
     * @return boolean whether the FTP connection is established
     */
    public function getActive() {
        return $this->_active;
    }

    /**
     * Open or close the FTP connection.
     * @param boolean whether to open or close FTP connection
     * @throws CException if connection fails
     */
    public function setActive($value) {
        if ($value != $this->_active) {
            if ($value)
                $this->connect();
            else
                $this->close();
        }
    }

    /**
     * Connect to FTP if it is currently not
     * @throws CException if connection fails
     */
    public function connect() {
        if ($this->_connection === null) {
            // Connect - SSL?
            $this->_connection = $this->ssl ? ftp_ssl_connect($this->host, $this->port, $this->timeout) : ftp_connect($this->host, $this->port, $this->timeout);
//            $this->_connection = $this->ssl ? ftp_connect($this->host, $this->port, $this->timeout) : ftp_ssl_connect($this->host, $this->port, $this->timeout);
            // Connection anonymous?
            if (!empty($this->username) AND !empty($this->password)) {
                $login_result = ftp_login($this->_connection, $this->username, $this->password);
            } else {
                $login_result = true;
            }

            // Check connection
            if (!$this->_connection)
                throw new CHttpException(403, 'FTP Library Error: Connection failed!');

            // Check login
            if ((empty($this->username) AND empty($this->password)) AND !$login_result)
                throw new CHttpException(403, 'FTP Library Error: Login failed!');

            $this->_active = true;
        }
    }

    /**
     * Closes the current FTP connection.
     *
     * @return	boolean
     */
    public function close() {
        if ($this->getActive()) {
            // Close the connection
            if (ftp_close($this->_connection)) {
                return true;
            } else {
                return false;
            }

            $this->_active = false;
            $this->_connection = null;
            $this->_errors = null;
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Passed an array of constants => values they will be set as FTP options.
     * 
     * @param	array	$config
     * @return	object (chainable)
     */
    public function setOptions($config) {
        if ($this->getActive()) {
            if (!is_array($config))
                throw new CHttpException(403, 'EFtpComponent Error: The config parameter must be passed an array!');

            // Loop through configuration array
            foreach ($config as $key => $value) {
                // Set the options and test to see if they did so successfully - throw an exception if it failed
                if (!ftp_set_option($this->_connection, $key, $value))
                    throw new CHttpException(403, 'EFtpComponent Error: The system failed to set the FTP option: "' . $key . '" with the value: "' . $value . '"');
            }

            return $this;
        }
        else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Execute a remote command on the FTP server.
     * 
     * @see		http://us2.php.net/manual/en/function.ftp-exec.php
     * @param	string remote command
     * @return	boolean
     */
    public function execute($command) {
        if ($this->getActive()) {
            // Execute command
            if (ftp_exec($this->_connection, $command)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Get executes a get command on the remote FTP server.
     *
     * @param	string local file
     * @param	string remote file
     * @param	const  mode
     * @return	boolean
     */
    public function get($local, $remote, $mode = FTP_ASCII) {
        if ($this->getActive()) {
            // Get the requested file
            if (ftp_get($this->_connection, $local, $remote, $mode)) {
                // If successful, return the path to the downloaded file...
                return $remote;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Put executes a put command on the remote FTP server.
     *
     * @param	string remote file
     * @param	string local file
     * @param	const  mode
     * @return	boolean
     */
    public function put($remote, $local, $mode = FTP_ASCII) {
        if ($this->getActive()) {
            // Upload the local file to the remote location specified
            if (ftp_put($this->_connection, $remote, $local, $mode)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Rename executes a rename command on the remote FTP server.
     *
     * @param	string old filename
     * @param	string new filename
     * @return	boolean
     */
    public function rename($old, $new) {
        if ($this->getActive()) {
            // Rename the file
            if (ftp_rename($this->_connection, $old, $new)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Rmdir executes an rmdir (remove directory) command on the remote FTP server.
     *
     * @param	string remote directory
     * @return	boolean
     */
    public function rmdir($dir) {
        if ($this->getActive()) {
            // Remove the directory
            if (ftp_rmdir($this->_connection, $dir)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }
    
    public function ftp_moveAll($src_dir, $dst_dir) {        
        # here we attempt to delete the file/directory
        if (!(@$this->rmdir($directory) || @$this->delete($directory))) {
            # if the attempt to delete fails, get the file listing
            $filelist = @$this->listFiles($directory);

            # loop through the file list and recursively delete the FILE in the list
            foreach ($filelist as $file) {
                $this->recursiveDelete($file);
            }

            #if the file list is empty, delete the DIRECTORY we passed
            $this->recursiveDelete($directory);
        }
    }
    
      function ftp_copyAll($conn_id, $src_dir, $dst_dir) {
        if (is_dir($dst_dir)) {
            return "<br> Dir <b> $dst_dir </b> Already exists  <br> ";
        } else {
            $d = dir($src_dir);
            ftp_mkdir($conn_id, $dst_dir);
            echo "creat dir <b><u> $dst_dir </u></b><br>";
            while ($file = $d->read()) { // do this for each file in the directory 
                if ($file != "." && $file != "..") { // to prevent an infinite loop 
                    if (is_dir($src_dir . "/" . $file)) { // do the following if it is a directory 
                        ftp_copyAll($conn_id, $src_dir . "/" . $file, $dst_dir . "/" . $file); // recursive part 
                    } else {
                        $upload = ftp_put($conn_id, $dst_dir . "/" . $file, $src_dir . "/" . $file, FTP_BINARY); // put the files 
                        echo "creat files::: <b><u>" . $dst_dir . "/" . $file . " </u></b><br>";
                    }
                }
                ob_flush();
                sleep(1);
            }
            $d->close();
        }
        return "<br><br><font size=3><b>All Copied  ok </b></font>";
    }

    public function recursiveDelete($directory) {
        # here we attempt to delete the file/directory
        if (!(@$this->rmdir($directory) || @$this->delete($directory))) {
            # if the attempt to delete fails, get the file listing
            $filelist = @$this->listFiles($directory);

            # loop through the file list and recursively delete the FILE in the list
            foreach ($filelist as $file) {
                $this->recursiveDelete($file);
            }

            #if the file list is empty, delete the DIRECTORY we passed
            $this->recursiveDelete($directory);
        }
    }

    /**
     * Mkdir executes an mkdir (create directory) command on the remote FTP server.
     *
     * @param	string remote directory
     * @return	boolean
     */
    public function mkdir($dir) {
        if ($this->getActive()) {
            // create directory
            if (ftp_mkdir($this->_connection, $dir)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Returns the last modified time of the given file
     * Note: Not all servers support this feature!
     * Note: mdtm method does not work with directories.
     *
     * @param	string remote file
     * @return	mixed Returns the last modified time as a Unix timestamp on success, or false on error.
     */
    public function mdtm($file) {
        if ($this->getActive()) {
            // get the last modified time
            $buff = ftp_mdtm($this->_connection, $file);
            if ($buff != -1) {
                return $buff;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Returns the size of the given file
     * Note: Not all servers support this feature!
     *
     * @param	string remote file
     * @return	mixed Returns the file size on success, or false on error.
     */
    public function size($file) {
        if ($this->getActive()) {
            // get the size of $file
            $buff = ftp_size($this->_connection, $file);
            if ($buff != -1) {
                return $buff;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Remove executes a delete command on the remote FTP server.
     *
     * @param	string remote file
     * @return	boolean
     */
    public function delete($file) {
        if ($this->getActive()) {
            // Delete the specified file
            if (ftp_delete($this->_connection, $file)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Change the current working directory on the remote FTP server.
     *
     * @param	string remote directory
     * @return	boolean
     */
    public function chdir($dir) {
        if ($this->getActive()) {
            // Change directory
            if (ftp_chdir($this->_connection, $dir)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Changes to the parent directory on the remote FTP server.
     *
     * @return	boolean
     */
    public function parentDir() {
        if ($this->getActive()) {
            // Move up!
            if (ftp_cdup($this->_connection)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Returns the name of the current working directory.
     *
     * @return	string
     */
    public function currentDir() {
        if ($this->getActive()) {
            return ftp_pwd($this->_connection);
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * Permissions executes a chmod command on the remote FTP server.
     *
     * @param	string remote file
     * @param	mixed  mode
     * @return	boolean
     */
    public function chmod($file, $mode) {
        if ($this->getActive()) {
            // Change the desired file's permissions
            if (ftp_chmod($this->_connection, $mode, $file)) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    /**
     * ListFiles executes a nlist command on the remote FTP server, returns an array of file names, false on failure.
     *
     * @param	string remote directory
     * @return	mixed
     */
    public function listFiles($directory) {
        if ($this->getActive()) {
            return ftp_nlist($this->_connection, $directory);
        } else {
            throw new CHttpException(403, 'EFtpComponent is inactive and cannot perform any FTP operations.');
        }
    }

    function chmodnum($chmod) {
        $trans = array('-' => '0', 'r' => '4', 'w' => '2', 'x' => '1');
        $chmod = substr(strtr($chmod, $trans), 1);
        $array = str_split($chmod, 3);
        return array_sum(str_split($array[0])) . array_sum(str_split($array[1])) . array_sum(str_split($array[2]));
    }

    public function createStr($file, $string) {
        $fw = fopen($file, 'w');
        if (!$fw) {
//            return 0;
            throw new CHttpException(403, 'File Not font');
        } else {
            fwrite($fw, $string);
            fclose($fw);
        }
    }

    public function getDir($directory, $sub = false) {
        $list = array();
        foreach ($this->ftp_get_filelist($this->_connection, $directory) as $data) {
            if ($data['type'] == 'directory' && ($data['filename'] != "." && $data['filename'] != "..")) {
                $list[] = array(
                    'text' => $data['filename'],
                    "path" => $directory . $data['filename'],
                    "value" => $data['filename'],
                    "type" => 'directory',
                    'id' => $sub = false ? $data['filename'] : $directory. $data['filename'],
                    'filesize' => $data['size'],
                    'children' => array()
                );
            }
        }
        return $list;
    }

    public function serch($directory, $key) {
        $list = array();
        foreach ($this->ftp_get_filelist($this->_connection, $directory) as $data) {
            $s = stripos($data['filename'], $key);
            if ($s === false) {
                null;
            } else {
                $list[] = array(
                    "path" => $directory . $data['filename'],
                    'file' => $directory . $data['filename'],
                    'filename' => $data['filename'],
                    'value' => $data['filename'],
                    'filesize' => $data['size'],
                    'filedate' => $data['month'] . ' ' . $data['day'] . ' ' . $data['time'],
                    'permissions' => $data['permissions'],
                    'chmod' => $this->chmodnum($data['permissions']),
                    'type' => $data['type'] === 'directory' ? 'directory' : $this->getXtension($data['filename']),
                    'owner' => $data['user'],
                    'group' => $data['group']
                );
            }
        }
        return $list;
    }

    public function get_filelist($directory) {
        $list = array();
        foreach ($this->ftp_get_filelist($this->_connection, $directory) as $data) {
            if ($data['filename'] != "." && $data['filename'] != "..") {
                $list[] = array(
                    "path" => $directory . $data['filename'],
                    'file' => $directory . $data['filename'],
                    'filename' => $data['filename'],
                    'value' => $data['filename'],
                    'filesize' => $data['size'],
                    'filedate' => $data['month'] . ' ' . $data['day'] . ' ' . $data['time'],
                    'permissions' => $data['permissions'],
                    'chmod' => $this->chmodnum($data['permissions']),
                    'type' => $data['type'] === 'directory' ? 'directory' : $this->getXtension($data['filename']),
                    'owner' => $data['user'],
                    'group' => $data['group']
                );
            }
        }

        return array('files' => $list);
    }

    protected function getXtension($fn) {
        $str2 = explode('.', $fn);
        $len2 = count($str2);
        $ext = $str2[($len2 - 1)];

        if ($len2 == 1) {
            return 'unknow';
        } else {
            return $ext;
        }
    }

    public function ftp_get_filelist($con, $directory) {
        if (is_array($children = @ftp_rawlist($con, $directory))) {
            $items = array();
            foreach ($children as $child) {
                $chunks = preg_split("/\s+/", $child);
                list($item['permissions'], $item['number'], $item['user'], $item['group'], $item['size'], $item['month'], $item['day'], $item['time']) = $chunks;
                $item['type'] = $chunks[0]{0} === 'd' ? 'directory' : 'file';
                array_splice($chunks, 0, 8);
                $item['filename'] = implode(" ", $chunks);
                $items[] = $item;
            }
            return $items;
        }
    }

    public function copy($local, $remote) {
        if (!$this->orgDir) {
            $this->orgDir = realpath($local);
            if (!is_dir($local)) {
                $this->put($remote, $local);
            } else {
                $local = realpath($local) . "/";
                if (!@$this->chdir($remote)) {
                    $this->mkdir($remote);
                }
            }
        }

        if ($open = opendir($local)) {
            while (false !== ($file = readdir($open))) {
                if ($file != "." && $file != "..") {
                    $remote_file = $remote . substr(realpath($local . $file), strlen($this->orgDir));
                    $local_file = $local . $file;
                    if (!is_dir($local_file)) {
                        $this->put($remote_file, $local_file);
                    } else {
                        $this->mkdir($remote_file);
                        $this->copy($local . $file . "/", $remote);
                    }
                }
            }
            closedir($open);
        }
    }

    /**
     * Close the FTP connection if the object is destroyed.
     *
     * @return	boolean
     */
    public function __destruct() {
        return $this->close();
    }

//    public function getDir($directory) {
//        $conection = $this->_connection;
//        $raw = @ftp_rawlist($conection, $directory);
//        $list = array();
//        foreach ($raw as $value) {
//            preg_match("#^(d|-)([rwx\-]{9}) +([\d]+) ([\w\d\-]+) +([\w\d\-]+) +([\d]+) ([\w]{3}) +([\d]{1,2}) ([\d :]{5}) (.{3,})#i", $value, $match);
//            ftp_chdir($conection, $directory);
//            $pwd = ftp_pwd($conection);
//            if (isset($match[1])) {
//                if ($match[1] === 'd') {
//                    $list[] = array(
//                        'text' => $match[10],
//                        "value" => $match[10],
//                        "type" => 'directory',
//                        'id' => $pwd . "/" . $match[10],
//                        'filesize' => $match[6],
//                        'children' => array()
////                        'children' => $this->getDir($pwd . '/' . $match[10])
//                    );
//                }
//            }
//        }
//        
//        return $list;
//    }
//    public function getDir($directory) {          
//         $raw =  @ftp_rawlist($this->_connection, $directory);
//        $list = array();
//        foreach ($raw as $value) {
//            $data = preg_match("#^(d|-)([rwx\-]{9}) +([\d]+) ([\w\d\-]+) +([\w\d\-]+) +([\d]+) ([\w]{3}) +([\d]{1,2}) ([\d :]{5}) (.{3,})#i", $value, $match);
//            if ($match[1] === 'd') {
//                $list[] = array(
//                    'type' => $match[1],
//                    'permissions' => $this->chmodnum($match[2]),
//                    'owner' => $match[4],
//                    'group' => $match[5],
//                    'size' => $match[6],
//                    'data' => strtotime($match[7] . $match[8] . $match[9]),
//                    'filename' => $match[10], 
//                );  
//            }
//            
//        }
//        
//        return $list;
//       
//
//        $dh = opendir($dir);
//        $content = array();
//        while (($file = readdir($dh)) !== false) {
//            if ($file != '.' AND $file != '..') {
//                if (filetype($dir . $file) == 'dir') {
//                    // must be checked if this folder have other subfolder
//                    if ($this->countSubDir($dir . $file . '/') == 0) {
//                        $content[] = array(
//                            "text" => $file,
//                            "leaf" => 'true',
//                            "value" =>$file,
//                            "id" => $dir . $file,
//                            'filesize' => fileOpration()->CalcDirectorySize($dir . $file.'/'),                            
//                            'type'=>'directory'
//                        );
//                       
//                    } else {
//                        $content[] = array(
//                            'text' => $file,
//                            'value'=>$file,
//                            'id' => $dir . $file,
//                            'type'=>'directory',
//                            'filesize' => fileOpration()->CalcDirectorySize($dir . $file.'/'),                           
//                            'children' => $this->getDir($dir . $file . '/', true)
//                        );
//                       
//                    }
//                }
//            }
//             
//        }       
//        //return array('files' => $content);
//        return $content;
//        
//        closedir($dh);
//    }
}
