<?php $title = 'Survey App';?>
<!doctype html>
<html lang="en">
  <?php require('src/header.php') ?>
  <body>
  <?php require('src/nav.php') ?>
  <div class="container">
   
   <div class="row mb-1 pl-2"><a href="javascript:;" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal">Create New</a></div>
   <table class="table table-striped" id="tblEntAttributes">
  <thead>
    <tr>
      <th  scope="col">#</th>
      <th scope="col">Survay Name</th>
      <th scope="col">No. of question(s)</th>
      <th scope="col">No. of surveyor</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    
    
  </tbody>
</table>
   </div>

   <!-- Modal add survey -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Survey</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form name="newsurvey" class="needs-validation" novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" name="surveyname" placeholder="Survey Name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <button class="btn btn-primary" type="submit">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>


        </form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>


 <!-- Modal for add question for Selected survey -->
 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal2Label">Add Question details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h3> Area for Form, which collect information of questions/options for clicked Survey.  </h3>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
   
   
  <?php require('src/footer.php') ?>
  
  <script> 
  $(document).ready(function(){

    function getsurvey() {
                var fvals = $('form').serialize();
                
                $.ajax({
                    url: "http://localhost:8010/getsurvey",
                    type: 'get',
                    data: fvals,
                    success: function(result) {
                        renderData(result);
                    }
                });
            }

            getsurvey();

function renderData(data){

  var recordRow = '';
  var myFlag = false;  
  var count= 1;

  data.forEach(element => {
    //console.log(element);   {id: "1", survey_name: "Survey One", created_by: "kush", created_at: "2021-03-24 11:17:08"} 
    recordRow += '<tr><th scope="row">1</th><td>'+ element.survey_name +'</td><td>0</td><td>0</td>';
    recordRow += '<td><a href="javascript:;" data-toggle="modal" data-target="#exampleModal2" data-toggle="tooltip" title="Add some questions for this Survey" class="addQuestion" recid="'+ element.id +'" id="add'+ element.id +'"><span class="fa fa-plus-square mr-3"></span></a><a href="javascript:;" onclick="alert(\'Wait for some time, It will work soon...\')"><span class="fa fa-close"></span></a></td></tr>'
    myFlag = true;
  });
  if (myFlag) {
    $("#tblEntAttributes tbody").append(recordRow);
    var script = document.createElement("SCRIPT");
    script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js';
    script.type = 'text/javascript';
    document.getElementsByTagName("head")[0].appendChild(script);

    $('[data-toggle="tooltip"]').tooltip();
    
  }else {
    $("#tblEntAttributes tbody").append('<tr><td colspan="5" align="center">No Surveys!!! Please create some...</td></tr>');
  }
  
  
}


// Code for Create New Survey

$("form[name='newsurvey']").validate({

rules: {

    surveyname: "required"
},

messages: {
    surveyname: "Please enter Survay name"
},

submitHandler: function(form) {
    savesurvey();
}
});

function savesurvey() {
var fvals = $('form').serialize();

$.ajax({
    url: "http://localhost:8010/newsurvey",
    type: 'post',
    data: fvals,
    success: function(result) {
      location.reload();
    }
});
}


// $('body').delegate('.addQuestion','click',function() {
// });

  });
  </script>
  </body>
</html>