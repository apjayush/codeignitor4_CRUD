<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('css/pagination.css'); ?>">
<script src="<?= base_url('/js/bootstrap.bundle.js') ?>"></script>


<?= session()->getFlashdata('error') ?>




<div class="card my-5 mx-5">
    <div class="card-body">

        <div class="container my-3 mx-3 py-3 px-3">


            <h2>Welcome to codeignitor CRUD App</h2>
            <br>

            
            <form action="/notes/create" method="post">
            <?= csrf_field() ?>
            <?= validation_list_errors() ?>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="titleArea" name="title" value="" placeholder="Your Title">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Note</label>
                <textarea class="form-control" id="noteArea" rows="3" name="content"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>

           

            </form>
        </div>
    </div>
</div>





<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?php echo session()->get('success'); ?>
    </div>
    <script>
        document.getElementById('titleArea').value = '';
        document.getElementById('noteArea').value = '';
    </script>
<?php endif; ?>