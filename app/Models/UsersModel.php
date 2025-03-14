<?php
 
namespace App\Models;
 
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama','email', 'username', 'password_hash', 'role'];
    
}