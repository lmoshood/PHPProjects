<?php
$amount = $_GET['totalamount'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once 'header.php'; ?>
</head>
<body>
  <div class="container my-5" style=" vh: 100px;">
<form id="paymentForm" style="width: 450px; vh: 100px;">

<input type="hidden" id="amount" value="<?php echo $amount; ?>" required />

<div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" id="email-address" class="form-control" required />
  </div>

  <div class="form-group">
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" class="form-control" />
  </div>
  <div class="form-group">
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" class="form-control"/>
  </div>
  <div class="form-submit">
    <button type="submit" class="btn btn-primary" onclick="payWithPaystack()"> Pay </button>
  </div>
</form>
</div>
<script src="https://js.paystack.co/v1/inline.js"></script> 
<script>
const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'pk_test_49c4e4578a84a77cba83233663cc970a9e04ad56', // Replace with your public key
    email: document.getElementById("email-address").value,
    amount: document.getElementById("amount").value * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment completed! Reference: ' + response.reference;
      console.log(response);
      alert(message);
      // if(response.status === 'success'){
      //   window.location.href = 'thankyou.php'
      // }
      
    }
  });
  handler.openIframe();
}
</script>
<?php include_once 'footer.php'; ?>
</body>
</html>