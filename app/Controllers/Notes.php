<?php

namespace App\Controllers;



use App\Models\NotesModel;
// use CodeIgniter\Exceptions\PageNotFoundException;

class Notes extends BaseController
{

    // ************    This is create method for CRUD app   ***************
    public function create()
    {

        $model = model(NotesModel::class);

        // Load the pagination library
       $pager = \Config\Services::pager();
    
        // Define pagination settings
        $perPage = 3; // Number of notes per page
        $currentPage = $this->request->getVar('page') ? (int) $this->request->getVar('page') : 1;
    
        $data = [
            'notes' => $model->paginate($perPage),
            'pager' => $model->pager,
        ];



        helper('form');




        // Checks whether the form is submitted.
        if (!$this->request->is('post')) {
            // The form is not submitted, so returns the form.
            return view('notes/create.php',  $data)
                . view('notes/noteslist');
        }

        $post = $this->request->getPost(['title', 'content']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'content'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return view('notes/create.php', $data)
                . view('notes/noteslist');
        }


        // saving to the database
        $model->save([
            'title' => $post['title'],
            'content'  => $post['content'],
        ]);





        //refetching the data from the database after saving
        $data = [
            'notes' => $model->paginate($perPage),
            'pager' => $model->pager,
        ];

        //        



        return view('notes/create.php',)
            . view('notes/noteslist', $data);
    }



    // * *********  This is update method for CRUD APP  ***************
    public function update($id)
    {
        $model = model(NotesModel::class);

        helper('form');

        $note = $model->find($id); // Get the note you want to update

        if (!$note) {
            // Handle the case where the note with the provided ID doesn't exist
            // For example, you can show an error message or redirect back to the list
            return redirect()->to('/notes/create'); // Redirect to the create page
        }

        if (!$this->request->is('post')) {
            // The form is not submitted, so populate the form with existing note data
            $data['note'] = $note;
            return view('notes/update.php', $data) // Replace with your view file
                . view('notes/noteslist');
        }

        $post = $this->request->getPost(['title', 'content']);

        // Checks whether the submitted data passed the validation rules.
        if (!$this->validateData($post, [
            'title' => 'required|max_length[255]|min_length[3]',
            'content'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            $data['note'] = $note; // Pass the existing note data to repopulate the form
            return view('notes/update.php', $data) // Replace with your view file
                . view('notes/noteslist');
        }

        // Updating the note in the database
        $model->update($id, [
            'title' => $post['title'],
            'content' => $post['content'],
        ]);

        // Redirect back to the create page or wherever you want after updating
        return redirect()->to('/notes/create'); // Redirect to the create page
    }

    // * *********  This is DELETE method for CRUD APP  ***************    



    public function delete($id)
    {

        $model = model(NotesModel::class);


        // Delete the record from the database
        $model->delete($id);

        // Redirect to a success page or list of records
        return redirect()->to('/notes/create'); // Change the URL as needed
    }



  
}
