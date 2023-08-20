<?php if (!empty($notes) && is_array($notes)) : ?>

  <div class="container my-5 mx-5 ">

    <?php foreach ($notes as $notes_item) : ?>

      <div class="card">
        <div class="card-header">
          Featured
        </div>
        <div class="card-body">
          <h5 class="card-title"><?= esc($notes_item['title']) ?></h5>
          <p class="card-text"><?= esc($notes_item['content']) ?></p>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= esc($notes_item['id']) ?>">
            Edit
          </button>
          <a href="/notes/delete/<?= esc($notes_item['id']) ?>" class="btn btn-danger">Delete</a>

          
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= esc($notes_item['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content my-3 mx-3 py-3 px-3">
              <form action="/notes/update/<?= esc($notes_item['id']) ?>" method="post">
                <?= csrf_field() ?>
                <?= validation_list_errors() ?>

                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Title</label>
                  <input type="text" class="form-control" id="titleArea<?= esc($notes_item['id']) ?>" name="title" value="<?= esc($notes_item['title']) ?>" placeholder="Your Title">
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Note</label>
                  <textarea class="form-control" id="noteArea<?= esc($notes_item['id']) ?>" rows="3" name="content"><?= esc($notes_item['content']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>



              </form>
            </div>
          </div>
        </div>



      <?php endforeach ?>

      </div>

    <?php else : ?>

      <div class="container my-5 mx-5 ">

        <h3>Notes list is empty</h3>



      </div>

    <?php endif ?>