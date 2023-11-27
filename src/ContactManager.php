<?php

class ContactManager 
{
    private $contacts = array();

    public function getContacts()
    {
        return $this->contacts;
    }

    public function addContact($name, $number, $email)
    {

        $temp = [
            'name' => $name,
            'phone' => $number,
            'email' => $email
        ];

        array_push($this->contacts, $temp);
    }

    public function removeContact($name)
    {
        foreach($this->contacts as $key => $contact){
            if($contact['name'] == $name){
                array_splice($this->contacts, $key, 1);
            }
        }
        reset ($this->contacts);
    }
}
?>