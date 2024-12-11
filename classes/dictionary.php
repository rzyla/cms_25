<?php 

class dictionary
{
    private language $language;
    
    function __construct(language $language)
    {
        $this->language = $language;
    }
    
    public function active()
    {
        return 
        [
            consts::$value_deactivate => $this->language->translate("common_deactive" ),
            consts::$value_activate => $this->language->translate("common_active" )
        ];
    }
    
    public function acl()
    {
        return
        [
            consts::$value_acl_none => $this->language->translate("dictionary_common_acl_0" ),
            consts::$value_acl_user => $this->language->translate("dictionary_common_acl_1" ),
            consts::$value_acl_admin => $this->language->translate("dictionary_common_acl_5" ),
            consts::$value_acl_supervisor => $this->language->translate("dictionary_common_acl_9" ),
        ];
    }
}

?>