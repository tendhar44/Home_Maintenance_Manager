
<div class="container">

    <div class="row">
        <div class="col">

            <a href="/home_maintenance_manager/public">Home</a>
            >
            <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>

            <br><br>
            <h3>Update Property</h3>
            <hr>
            <br>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <form action="#" method="post">
                Property Name:<br> <input type="text" name="propertyname" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['name'] ?>"><br><br>
                Address:<br> <input type="text" name="address" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['address'] ?>"><br><br>
                Description:<br> <input type="text" name="propertydes" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['description'] ?>"><br><br>
                <div class="form-group"> 
                    <button type="submit" name="addTask" value="AddTask" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>

        <div class="col-auto">

            <?php 

            foreach ($data["img"] as $image) {


                echo '

                <img id="myImg" src="/home_maintenance_manager/public/image' . $image['name'] . '" alt="'. explode( '_', $image )[1] .'" width="200" height="200">

                <!-- The Modal -->
                <div id="myModal" class="modal">

                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

                <!-- Modal Caption (Image Text) -->
                <div id="caption"></div>
                </div>


                ';
            }


            ?>

            <label>
               Add Image
           </label>
           <form action="#" method="post">

            <input id="browse"  name="imgSelector[]" type="file" onchange="previewFiles()" multiple accept="image/*" disabled >

            <div id="preview"></div>

            <div class="form-group"> 
                <button type="submit" name="addTask" value="AddTask" class="btn btn-default">Submit</button>
            </div>
        </form>
    </div>
</div>

</div>

<script>
$(function() {

    var $propertySelector = $('#propertySelector');
    var $applianceSelector = $('#applianceSelector');
    // populate property selector.
    for (key in properties) {
        console.log(key);
        $propertySelector.append('<option>' + key + '</option>');
    }

    $('#createTaskButton').on('click', function(){
        $('.form-horizontal').fadeToggle(200);
    });

    // update appliance selector on change value from property selector
    $('#propertySelector').on('change', function(event, value) {
        console.log($(this).val());

        var selectedValue = $(this).val();

        if (selectedValue === 'Select Property') {
            // clear value
            // disable the appliance select
            $applianceSelector.val('select property first').prop('disabled', true);
            return;
        }
        // clear options in appliance selector
        $applianceSelector.empty();

        for (key in properties[selectedValue]) {
            $applianceSelector.append('<option value="' + properties[selectedValue][key] + '">' + key + '</option>');
        }

        $applianceSelector.prop('disabled', false);
    });
});
</script>