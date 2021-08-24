<?php
require_once 'database.php';
/**
 * @package Custom Method Library
 * @subpackage  Library extending Database
 * @author  Dibya Mitra
 */
class Functions extends Database
{
    /**
	 * Method to fetch Single Row from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	object
	 */
    public function selSingleRow($arr=NULL,$tablename,$where=NULL)
    {
        $res=parent::selSingleRow($arr,$tablename,$where);
        return $res;
    }

    /**
	 * Method to fetch Single Row from DB
	 * @param	string
	 * @return	object
	 */
    public function selSingleRowCustom($sql)
    {
        $res=parent::selSingleRowCustom($sql);
        return $res;
    }

    /**
	 * Method to fetch Multiple Rows from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	array
	 */
    public function selMultipleRow($arr=NULL,$tablename,$where=NULL)
    {
        $res=parent::selMultipleRow($arr,$tablename,$where);
        return $res;
    }

    /**
	 * Method to fetch Multiple Rows from DB
	 * @param	string
	 * @return	array
	 */
    public function selMultipleRowCustom($sql)
    {
        $res=parent::selMultipleRowCustom($sql);
        return $res;
    }

    /**
	 * Method to insert/update/delete by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @param	char
	 * @return	bool
	 */
    public function userQuery($fieldvar=NULL,$tablename,$condition=NULL,$task)
    {
        $res=parent::userQuery($fieldvar,$tablename,$condition,$task);
        return $res;
    }

    /**
	 * Method to insert/update/delete
	 * @param	string
	 * @return	bool
	 */
    public function userQueryCustom($sql)
    {
        $res=parent::userQueryCustom($sql);
        return $res;
    }

    /**
     * Method to pint array in formatted way
     * @param   array
     * @return  string
     */
    public function pr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    /**
     * Method to redirect to an url
     * @param   string
     */
    public function redirect($url)
    {
        header("location:".$url);
        exit;
    }

    /**
     * Method to redirect or to return previous page url
     * @param   string
     * @return  string
     */
    public function prevurl($chk=NULL)
    {
        $url=$_SERVER['HTTP_REFERER'];
        if(!isset($chk))
        {
            header("location:".$url);
            exit;
        }
        else
        {
            return $url;
        }
    }

    /**
     * Method to return the baseurl
     * @param   string
     * @return  string
     */
    public function baseurl($path=NULL)
    {
        $res=parent::baseurl($path);
        return $res;
    }

    /**
     * Method to return the imageurl
     * @param   string
     * @return  string
     */
    public function imgurl($path=NULL)
    {
        $res=parent::imgurl($path);
        return $res;
    }

    /**
     * Method to return the baseurl with page extension
     * @param   string
     * @return  string
     */
    public function siteurl($pgname)
    {
        $res=parent::siteurl($pgname);
        return $res;
    }

    /**
     * Method to return the authenticated url
     * @param   string
     * @return  string
     */
    public function authurl($pgname)
    {
        $sesspass=$this->getSession('session');
        $url=$this->siteurl('jsssess'.$sesspass.'/'.$pgname);
        return $url;
    }

    /**
     * Method to sanitize the output buffer
     * @param   string
     * @return  string
     */
    public function sanitize_output($buffer) 
    {
        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );
        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }

    /**
     * Method for Ajax Response
     * @param   string
     * @param   string
     * @param   string
     * @param   array
     * @return   object
     */
    public function sendAjaxResponse($resptype,$msg,$url=NULL,$param=array())
    {
        $response=array('status'=>$resptype,'msg'=>$msg);
        if(isset($url) and !empty($url))
        {
            $response['url']=$url;
        }
        if(isset($param) and !empty($param))
        {
            $response['param']=$param;
        }
        echo json_encode($response);
        exit;
    }

    /**
     * Method to check for Authentication
     */
    public function checkAuthenticate()
    {
        $session=$this->getSession('userdetails');
        if(!isset($session) or empty($session))
        {
            $this->clearSession('session');
            $redirect=$this->siteurl('sign-in');
            $this->redirect($redirect);
        }

        $cpass=$_REQUEST['jsspass'];
        if(!isset($cpass) or empty($cpass))
        {
            $this->clearSession('userdetails');
            $this->clearSession('session');
            $redirect=$this->siteurl('sign-in');
            $this->redirect($redirect);
        }
        else
        {
            $innercpass=$this->getSession('session');
            if($cpass!=$innercpass)
            {
                $this->clearSession('userdetails');
                $this->clearSession('session');
                $redirect=$this->siteurl('sign-in');
                $this->redirect($redirect);
            }
        }
    }

    /**
     * Method to set a value to a session key
     * @param   string
     * @param   string
     */
    public function setSession($key,$value)
    {
        $_SESSION[$key]=$value;
    }

    /**
     * Method to retrieve the session value from key
     * @param   string
     * @return  array
     */
    public function getSession($key=NULL)
    {
        if(isset($key) and !empty($key))
        {
            $val=$_SESSION[$key];
        }
        else
        {
            $val=$_SESSION;
        }
        return $val;
    }

    /**
     * Method to clear the session value for particular key
     * @param   string
     */
    public function clearSession($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Method to fetch options for dynamic dropdown
     * @param   string
     * @param   string
     * @param   string
     * @param   array
     * @return  string
     */
    public function dynamicDropdownOpt($tablename,$primarykey,$value,$selected=array())
    {
        $res=parent::dynamicDropdownOpt($tablename,$primarykey,$value,$selected);
        return $res;
    }

    /**
     * Method to fetch student list in the table format
     * @return  string
     */
    public function studentList()
    {
        $res=parent::studentlist();
        return $res;
    }

    /**
     * Method to retrieve single data of a student
     * @param   string
     * @return  object
     */
    public function getStudentData($studentid)
    {
        $res=parent::getStudentData($studentid);
        return $res;
    }

    /**
     * Method to check same student exist or not
     * @param   string
     * @param   string
     * @param   string
     * @param   string
     * @param   string
     * @param   string
     * @return  bool
     */
    public function checkAlready($fieldcol,$tablename,$fieldvalue,$primarykeyid,$primarykeyvalue=NULL,$method)
    {
        $res=parent::checkAlready($fieldcol,$tablename,$fieldvalue,$primarykeyid,$primarykeyvalue,$method);
        return $res;
    }
}