   @extends('layouts.main')
   @section('content')

       @include('partials.admin-topbar')
       @include('partials.student-sidebar')

       <!--Content Start-->
       <div class="content-start transition">
           <div class="container-fluid dashboard">
               <div class="content-header">
                   <h1>Mohon Maaf!</h1>
                   <h1>Fitur ini belum dikembangkan :(</h1>
               </div>
               <div class="row">
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-header">
                               <h4>Fitur ini akan dikembangkan jika kami ada waktu</h4>
                               <p><a href="/login">Login instead</a></p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       @include('partials.footer')
   @endsection