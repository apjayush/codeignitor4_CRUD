<?php

namespace App\Models;

use CodeIgniter\Model;

class NotesModel extends Model
{
    protected $table = 'CRUD';

    protected $allowedFields = ['title', 'content'];



    public function getNotes()
{
   
        return $this->findAll();

}



}



