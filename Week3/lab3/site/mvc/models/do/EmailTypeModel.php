<?php

/**
 * Description of PhotoTypeModel
 *
 * @author User
 */

namespace App\models\services;


class EmailTypeModel extends BaseModel {
    
    private $emailtypeid;
    private $emailtype;
    private $active;
    
    function getEmailtypeid() {
        return $this->emailtypeid;
    }

    function getEmailtype() {
        return $this->emailtype;
    }

    function getActive() {
        return $this->active;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setEmailtype($Emailtype) {
        $this->emailtype = $Emailtype;
    }

    function setActive($active) {
        $this->active = $active;
    }


}
