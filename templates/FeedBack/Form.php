<div class="container-fluid">
<div class="d-flex justify-content-center">

<h1 class="m-2">FeedBack</h1>
</div>
</div>

<div class="container-fluid">
<div class="d-flex justify-content-center">
<form class="w-50" action="<?= $formPath ?>" method="post" class="feedBackForm">
    <input class="m-2 bg-success w-100"  type="text" name="nick" placeholder="Enter your name"><br>
    <textarea class="m-2 bg-success w-100" name="message" cols="30" rows="10">Enter your message</textarea><br>

    <select class="m-2 bg-success w-100"  name="mark">
        <option value=”1”>1</option>
        <option value=”2”>2</option>
        <option value=”3”>3</option>
        <option value=”4”>4</option>
        <option value=”5”>5</option>
    </select></br>
    <div class="d-flex justify-content-center">
    <input class="m-2 bg-success w-50" type="submit" value="send" class="feedBackButton">
    </div>
</form>


</div>
</div>
<div class="d-flex flex-row-reverse fixed-top">
    <a class="btn btn-dark" href='/login'>Login</a>
</div>