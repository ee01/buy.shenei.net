<?php
/*************************************************************************************************
 * �ļ�����upload.han.php
 * �汾�ţ�TTTuangou 1.0.0 beta
 * ����޸�ʱ�䣺2005��10��22�� 18:26:14
 * ���ߣ�����<foxis@qq.com>
 * �����������ļ�����
**************************************************************************************************/

class UploadHandler
{
	
    var $_error;

	
	var $_new_name;

	
	var $_save_name;

   
    var $_file;

   
    var $_path;

    
    var $_field;

   
    var $_max_size;

   
    var $_image;

   
    var $_ext;

   
    var $_ext_types;

   
    var $_image_types;



   
    function UploadHandler(& $file, $path, $field = 'upload', $image = false)
    {
        $this->_file       =& $file;
        $this->_path       =  $path;
        $this->_field      =  $field;
        $this->_max_size   =  50;         $this->_image      =  $image;
        $this->_ext        =  '';
        $this->_new_name   =  '';
        $this->_save_name  =  '';

        $this->_ext_types   = array('cgi', 'pl', 'js', 'asp', 'php', 'html', 'htm', 'jsp', 'jar', 'txt', 'rar', 'zip');
        $this->_image_types = array('gif', 'jpg', 'jpeg', 'png');
    }

	
    function setMaxSize($size)
    {
        $this->_max_size = (int) $size;
        return true;
    }

	
    function setExtTypes($array)
    {
        if(false == is_array($array))
        {
            return false;
        }

        $this->_ext_types =& $array;
        return true;
    }

	
    function setImgTypes($array)
    {
        if(false == is_array($array))
        {
            return false;
        }

        $this->_image_types =& $array;
        return true;
    }
  
	
    function setNewName($name)
    {
        $this->_new_name = trim($name);
        return true;
    }

	
    function getExt()
    {
        return $this->_ext;
    }

	
    function getSaveName()
    {
        return $this->_save_name;
    }


	
	function doUpload()
    {
        if(false == is_writable($this->_path))
        {
            $this->_setError(504);
            return false;
        }

        if(false == isset($this->_file[$this->_field]))
        {
            $this->_setError(501);
            return false;
        }

        $name = $this->_file[$this->_field]['name'];
        $size = $this->_file[$this->_field]['size'];
        $type = $this->_file[$this->_field]['type'];
        $temp = $this->_file[$this->_field]['tmp_name'];

        $type = preg_replace("/^(.+?);.*$/", "\\1", $type);

        if(false == $name || $name == 'none')
        {
            $this->_setError(501);
            return false;
        }

		$this->_ext = strtolower(end(explode('.', $name)));

		if(false == $this->_ext)
		{
            $this->_setError(502);
            return false;
		}
        if(false == $this->_image)
        {
            if(false == in_array($this->_ext, array_merge($this->_image_types, $this->_ext_types)))
            {
                $this->_setError(502);
                return false;
            }
        }
        else {
            if(false == in_array($this->_ext, $this->_image_types))
            {
                $this->_setError(507);
                return false;
            }

            if(function_exists('exif_imagetype') && !@exif_imagetype($temp)) {
				 $this->_setError(507);
                 return false;
			} elseif (function_exists('getimagesize') && !getimagesize($temp)) {
				$this->_setError(507);
                 return false;
        }
        }
        

        if($this->_max_size && 
           $this->_max_size * 1000 < $size)
        {
            $this->_setError(503);
            return false;
        }

        if(false == $this->_new_name)
        {
            $this->_save_name = $name;
            $full_path        = $this->_path . $name;
        }
        else {
            $this->_save_name = $this->_new_name;
            $full_path        = $this->_path     . $this->_save_name;
        }

		if(false == move_uploaded_file($temp, $full_path))
		{
			if(false == copy($temp,$full_path))
			{
	            $this->_setError(505);
	            return false;
			}
		}

        $this->_setError(506);
        return true;
    }

	
    function getError()
    {
        return $this->_error;
    }
	
	function _GetError() 
	{
		$type=$this->_file[$this->_field]['error'];
		$error_types=array(0=>'û�д��������ļ��ϴ��ɹ���',
							1=>'�ϴ����ļ������� php.ini �� upload_max_filesize ѡ�����Ƶ�ֵ��',
							2=>'�ϴ��ļ��Ĵ�С������ HTML ���� MAX_FILE_SIZE ѡ��ָ����ֵ��',
							3=>'�ļ�ֻ�в��ֱ��ϴ���',
							4=>'û���ļ����ϴ���',
							6=>'�Ҳ�����ʱ�ļ��С�',
							7=>'�ļ�д��ʧ��');
        if(false == isset($error_types[$type]))
        {
            $error_types[$type] = $val;
        }
        $this->_error = $error_types[$type];
        return true;

	}
	


   
    function _setError($type, $val = '')
    {

        $error_types = array(501 => 'û�����ص��ļ�',
                             502 => '���������չ��',
                             503 => '���ص��ļ������˷�����������Ƶ�ֵ������ʧ�ܣ�',
                             504 => 'Ŀ¼����д',
                             505 => '�ƶ��ļ�ʱ����',
                             506 => '���سɹ�',
                             507 => '���ص�ͼƬ�ļ�������Ч��ͼƬ�ļ�',
			);

        if(false == isset($error_types[$type]))
        {
            $error_types[$type] = $val;
        }
        $this->_error_no=$type;

        $this->_error = $error_types[$type];
        return true;
    }
    
    function getErrorNo()
    {
    	return $this->_error_no;
    }
}

?>