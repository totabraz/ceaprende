<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('set_msg')) {
    function set_msg($msg = NULL)
    {
        $ci = &get_instance();
        $ci->session->set_userdata('aviso', $msg);
    }
}
if (!function_exists('get_msg')) {
    function get_msg($destroy = TRUE)
    {
        $ci = &get_instance();
        $retorno = $ci->session->userdata('aviso');
        if ($destroy) $ci->session->unset_userdata('aviso');
        return $retorno;
    }
}

if (!function_exists('getMsgOk')) {
    function getMsgOk($msg = NULL)
    {
        if (isset($msg)) {
            $startOfAlert = '<div class="row"><div class="col-xs-12"><div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $endOfAlert = '</div></div></div>';
            // Erros recebidos pelo envio. -> com os um estilo pré definido estilos
            $return = $startOfAlert . $msg . $endOfAlert;
            return $return;
        }
    }
}


if (!function_exists('getMsgError')) {
    function getMsgError($msg = NULL)
    {
        if (isset($msg)) {
                        
            $startOfAlert = '<div class="row"><div class="col-xs-12"><div class="alert alert-error alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $endOfAlert = '</div></div></div>';
            // Erros recebidos pelo envio. -> com os um estilo pré definido estilos
            $return = $startOfAlert . $msg . $endOfAlert;
            return $return;
        }
    }
}


if (!function_exists('globalLogout')) {
    function globalLogout($redirect = 'admin/login')
    {
        // Destroy os dados da sessão
        setSessionnOff();
        set_msg(getMsgError('Você saiu do sistema!'));
        // redirect(base_url(), 'refresh');
        redirect($redirect, 'refresh');
    }
}



if (!function_exists('verificaLogin')) {
    function verificaLogin($redirect = 'admin/login')
    {
        $ci = &get_instance();
        if ($ci->session->userdata('logged') != TRUE) {
            set_msg(getMsgOk('Acesso restrito! <br/> Faça login pra continuar.'));
            redirect($redirect, 'refresh');
        }
    }
}


if (!function_exists('verificaLoginAdmin')) {
    function verificaLoginAdmin($redirect = 'admin/login')
    {
        $ci = &get_instance();
        if (($ci->session->userdata('logged') != TRUE) && (
            ($ci->session->userdata('permission_value') !== PERMISSION_ADMIN) || ($ci->session->userdata('permission_value') !== PERMISSION_ROOT))) {
            set_msg(getMsgOk('Acesso restrito! <br/> Faça login pra continuar.'));
            redirect($redirect, 'refresh');
        }
    }
}


if (!function_exists('config_upload')) {
    function config_upload($path = './uploads', $types = 'pdf|doc|docx|PDF|DOC|DOCX', $size = 10240)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;
        $config['max_size'] = $size;
        return $config;
    }
}


if (!function_exists('config_upload_doc')) {
    function config_upload_doc($path = './uploads', $types = 'pdf|doc|docx|PDF|DOC|DOCX', $size = 10240)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;
        $config['max_size'] = $size;
        return $config;
    }
}

if (!function_exists('config_upload_img')) {
    function config_upload_img($path = './uploads', $types = 'png|jpg|jpeg|PNG|JPG|JPEG', $size = 1536)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;
        $config['max_size'] = $size;
        return $config;
    }
}

if (!function_exists('htmlToText')) {
    function htmlToText($html = NULL)
    {
        return htmlentities($html);
    }
}

if (!function_exists('textToHtml')) {
    function textToHtml($text = NULL)
    {
        return html_entity_decode($text);
    }
}

if (!function_exists('changeDateToDB')) {
    function changeDateToDB($date = NULL)
    {
        if (isset($date)) {
            if (strpos($date, '-') !== false) {

                $date = explode("-", $date);
                if (strlen($date[2]) > strlen($date[0])) $date = $date[2] . '-' . $date[1] . '-' . $date[0];
                else $date = $date[0] . '-' . $date[1] . '-' . $date[2];
            }
            return $date;
        }
    }
}
if (!function_exists('changeDateFromDB')) {
    function changeDateFromDB($date = NULL)
    {
        if (isset($date)) {
            if (strpos($date, '-') !== false) {

                $date = explode("-", $date);
                if (strlen($date[2]) > strlen($date[0])) $date = $date[0] . '-' . $date[1] . '-' . $date[2];
                else $date = $date[2] . '-' . $date[1] . '-' . $date[0];
            }

            return $date;
        }
    }
}

if (!function_exists('shorterText')) {
    function shorterText($text = '', $chars_limit = 10)
    {
        // Check if length is larger than the character limit
        if (strlen($text) > $chars_limit) {
            // If so, cut the string at the character limit
            $new_text = substr($text, 0, $chars_limit);
            // Trim off white space
            $new_text = trim($new_text);
            // Add at end of text ...
            return $new_text . "...";
        }
        // If not just return the text as is
        else {
            return $text;
        }
    }
}

if (!function_exists('removeSpaces')) {
    function removeSpaces($txtInit = '')
    {
        return rtrim(preg_replace('/\s+/', ' ', $word));
    }
}

if (!function_exists('setSessionnOn')) {
    function setSessionnOn($user)
    {
        // Getting  instance of CI
        $ci = &get_instance();
        $ci->load->library('session');
        // Getting  values
        $login = (isset($user->login)) ? $user->login : '';
        $email = (isset($user->email)) ? $user->email : '';
        $fist_name = (isset($user->fist_name)) ? $user->fist_name : '';
        // Setting values
        $ci->session->set_userdata('logged', TRUE);
        $ci->session->set_userdata('login', $login);
        $ci->session->set_userdata('email', $email);
        $ci->session->set_userdata('name', $fist_name);
    }
}

if (!function_exists('setSessionnOff')) {
    function setSessionnOff()
    {
        // Getting  instance of CI
        $ci = &get_instance();
        $ci->load->library('session');
        // UnSetting values
        $ci->session->unset_userdata('logged');
        $ci->session->unset_userdata('name');
        $ci->session->unset_userdata('user_login');
        $ci->session->unset_userdata('user_email');
    }
}

if (!function_exists('printInfoDump')) {
    function printInfoDump($dados, $txt = '')
    {
        echo '<pre>';
        if ($txt != '') {
            echo $txt;
            echo '<br/>';
            echo '<br/>';
        }
        var_dump($dados);
        echo '</pre>';
    }
}

if (!function_exists('printInfo')) {
    function printInfo($dados)
    {
        echo '<pre>';
        prinr_r($dados);
        echo '</pre>';
    }
}

if (!function_exists('AmIRoot')) {
    function AmIRoot()
    {
        $ci = &get_instance();
        $ci->load->library('session');
        return ($ci->session->userdata('permission_value') == PERMISSION_ROOT);
    }
}

if (!function_exists('isRoot')) {
    function isRoot($permission = 0)
    {
        return ($permission == PERMISSION_ROOT);
    }
}

if (!function_exists('getPermissionValue')) {
    function getPermissionValue($permissionLabel)
    {
        $permission = PERMISSION_VIEWER;
        switch ($permissionLabel) {
            case LABEL_ROOT:
                $permission = PERMISSION_ROOT;
                break;

            case LABEL_ADMIN:
                $permission = PERMISSION_ADMIN;
                break;

            case LABEL_EDITOR:
                $permission = PERMISSION_EDITOR;
                break;

            case LABEL_SELLER:
                $permission = PERMISSION_SELLER;
                break;

            case LABEL_VIEWER:
                $permission = PERMISSION_VIEWER;
                break;

            default:
                $permission = PERMISSION_VIEWER;
                break;
        }
        return $permission;
    }
}


if (!function_exists('removeBasicWords')) {
    function removeBasicWords($word = '')
    { {
        if (isset($word) && !is_array($word)) {    
                $word = rtrim(str_replace(' da ',  ' ', $word));
                $word = rtrim(str_replace(' de ',  ' ', $word));
                $word = rtrim(str_replace(' di ',  ' ', $word));
                $word = rtrim(str_replace(' do ',  ' ', $word));
                $word = rtrim(str_replace(' du ',  ' ', $word));
                $word = rtrim(str_replace(' e ',   ' ', $word));
                $word = rtrim(str_replace(' das ', ' ', $word));
                $word = rtrim(str_replace(' des ', ' ', $word));
                $word = rtrim(str_replace(' dis ', ' ', $word));
                $word = rtrim(str_replace(' dos ', ' ', $word));
                $word = rtrim(str_replace(' dus ', ' ', $word));
                $word = rtrim(preg_replace('/\s+/', ' ', $word));
            }
            return $word;
        }
    }


    if (!function_exists('safeInput')) {
        function safeInput($input)
        {
            if (isset($input) && !is_array($input)) {
                $input = rtrim(str_replace("'", '', $input));
                $input = rtrim(str_replace(';', '', $input));
                $input = rtrim(str_replace('"', '', $input));
                $input = rtrim(str_replace("SELECT", '', $input));
                $input = rtrim(preg_replace('/\s+/', '', $input));
            }
            return $input;
        }
    }
}
