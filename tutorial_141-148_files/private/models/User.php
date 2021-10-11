<?php

/**
 * User Model
 */
class User extends Model
{

	protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'rank',
        'date',
        'image',
        'school_id',
    ];

    protected $beforeInsert = [
        'make_user_id',
        'make_school_id',
        'hash_password'
    ];

    protected $beforeUpdate = [
        'hash_password'
    ];


    public function validate($DATA,$id = '')
    {
        $this->errors = array();

        //check for first name
        if(empty($DATA['firstname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['firstname']))
        {
            $this->errors['firstname'] = "Only letters allowed in first name";
        }

        //check for last name
        if(empty($DATA['lastname']) || !preg_match('/^[a-zA-Z]+$/', $DATA['lastname']))
        {
            $this->errors['lastname'] = "Only letters allowed in last name";
        }

        //check for email
        if(empty($DATA['email']) || !filter_var($DATA['email'],FILTER_VALIDATE_EMAIL))
        {
            $this->errors['email'] = "Email is not valid";
        }
        
        //check if email exists
        if(trim($id) == ""){
            if($this->where('email',$DATA['email']))
            {
                $this->errors['email'] = "That email is already in use";
            }
        }else{
            if($this->query("select email from $this->table where email = :email && user_id != :id",['email'=>$DATA['email'],'id'=>$id]))
            {
                $this->errors['email'] = "That email is already in use";
            }
        }

        //check for password
        if(isset($DATA['password'])){

            if(empty($DATA['password']) || $DATA['password'] !== $DATA['password2'])
            {
                $this->errors['password'] = "Passwords do not match";
            }

            //check for password length
            if(strlen($DATA['password']) < 8)
            {
                $this->errors['password'] = "Password must be at least 8 characters long";
            }
        }

        //check for gender
        $genders = ['female','male'];
        if(empty($DATA['gender']) || !in_array($DATA['gender'], $genders))
        {
            $this->errors['gender'] = "Gender is not valid";
        }

        //check for gender
        $ranks = ['student','reception','lecturer','admin','super_admin'];
        if(empty($DATA['rank']) || !in_array($DATA['rank'], $ranks))
        {
            $this->errors['rank'] = "Rank is not valid";
        }


        if(count($this->errors) == 0)
        {
            return true;
        }

        return false;
    }

    public function make_user_id($data)
    {
        $data['user_id'] = strtolower($data['firstname'] . "." . $data['lastname']);

        while($this->where('user_id',$data['user_id']))
        {
            $data['user_id'] .= rand(10,9999);
        }

        return $data;
    }


    public function make_school_id($data)
    {
        if(isset($_SESSION['USER']->school_id)){
            $data['school_id'] = $_SESSION['USER']->school_id;
        }
        return $data;
    }

    public function hash_password($data)
    {
        if(isset($data['password'])){
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        return $data;
    }

   
}