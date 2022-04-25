<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once '../header.php'; ?>
    
</head>
<body>

<div class="container">
<?php include_once 'nav.php'; ?>

<form class="py-5" id='addForm' method="post">
  <div class="form-group">
    <label for=""> Category Name</label>
    <input type="text" class="form-control" id="name" name="name" required>  
  </div>
  
  <div class="form-group">
    <label for=""> Description</label>
    <input type="text" class="form-control" id="description" name="description" required>  
  </div>
  
  <button type="submit" name="save" class="btn btn-primary save">Submit</button>
</form>

</div> 
<?php include_once '../footer.php'; ?>

<script>
$( document ).ready(function() {
  $('#name').val();
   $('#addForm').submit(function(e){
    e.preventDefault();
    var formvals = $(this).serialize();
    
    console.log(formvals);
    $.ajax({
        type: 'POST',
        url: 'addcat.php',
        data: formvals,
        success: function(response){
        var  res = JSON.parse(response);
          if(res.message === 'success'){
            Swal.fire('Success!',
              'Category added successfully!',
              'success'
                );
          }else{
            Swal.fire(
  'Error!',
  'Error occured!',
  'error'
)
          }
            console.log(res.message);
        }
    });

   });
   
});

</script>
</body>
</html>
<!-- $.ajax({
  type: "POST",
  url: url,
  data: data,
  success: success,
  dataType: dataType
}); -->