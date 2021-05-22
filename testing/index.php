
<!DOCTYPE html>
<html lang="EN">
<head>
    <title>Test Code</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../campaign.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () //Setting up on Document to Ready Function
    {
        $("#Submit").click(function (event) {

            //getting form into Jquery Wrapper Instance to enable JQuery Functions on form                    
            var form = $("#jobform");

            //Serializing all For Input Values (not files!) in an Array Collection so that we can iterate this collection later.
            var params = form.serializeArray();

            //Getting Files Collection
            var files = $("#File1")[0].files;

            //Declaring new Form Data Instance  
            var formData = new FormData();

            //Looping through uploaded files collection in case there is a Multi File Upload. This also works for single i.e simply remove MULTIPLE attribute from file control in HTML.  
            for (var i = 0; i < files.length; i++) {
                formData.append('resume', files[i]);
            }
            //Now Looping the parameters for all form input fields and assigning them as Name Value pairs. 
            $(params).each(function (index, element) {
                formData.append(element.name, element.value);
            });

            //disabling Submit Button so that user cannot press Submit Multiple times
            var btn = $(this);
            btn.val("Uploading...");
            btn.prop("disabled", true);

            $.ajax({
                url: "mail.php", //You can replace this with MVC/WebAPI/PHP/Java etc
                method: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    //Firing event if File Upload is completed!  
                    alert(data);
                    btn.prop("disabled", false);
                    btn.val("Submit");
                    $("#jobform").reset();
                },
                error: function (error) { alert("Error"); }

            });

        });

    });
</script>
</head>
<body>
  <header id="header" class="fixed-top">
  </header>
<main>
    <div class="container" style="max-width:500px">
        <label><b>Job Form</b></label>
           <form action = "" method = "POST" enctype = "multipart/form-data" id='jobform'>
          <div class="mb-3">
            <label>Name </label>
            <input type="text" name='name' class="form-control" placeholder='Name' required/>
          </div>
          <div class="mb-3">
      
            <label>Email Id</label>
            <input type="text" class="form-control" name='email' placeholder='Email Id' required/>
          </div>
          
          <div class="mb-3">
            <label> Applied For </label>
            
            <select class="form-control" name='appliedfor' placeholder='Applied For'>
              <option value='Developer'>Developer</option>
              <option value='Designer'>Designer</option>
              <option valu='SEO'>SEO</option>
              <option value='HR Manager'>HR Manager</option>
            </select>
          </div>
          <div class="mb-3">
            <label> Resume </label>
            
            <input type = "file" class="form-control" name = "resume" id="File1" required/>
          </div>
          
          <button type="submit" name="submit" value='submit' id="Submit" class="btn btn-submit">Submit</button>
        </form>
      </div>
      <div id='error'></div>
        
 </main>
    <footer id="footer">
    </footer>
</body>


</html>
  