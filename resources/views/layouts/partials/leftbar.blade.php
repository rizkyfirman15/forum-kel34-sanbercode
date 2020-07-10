<?php 

    use Illuminate\Support\Facades\Auth;
    $user = Auth::user(); 

?>
<h5 class="card-title">{{$user->name}}</h5>
<hr>
<h6 class="card-subtitle mb-2 text-muted"></h6>
<p class="card-text">Point Reputasi: </p>
<h4 class="text-center" style="color: darkslateblue"><b>{{$user->reputasi}}</b></h4>
<hr>