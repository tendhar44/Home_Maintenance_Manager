
<div class="container">
    <a href="/home_maintenance_manager/public">Home</a>
    >
    <a href="/home_maintenance_manager/public/propertycontroller/<?php echo $_SESSION['userid'] ?>">Property</a>

    <br><br>
    <h3>Update Property</h3>
    <hr>
    <br>
    <form action="" method="post">
        <d

        Property Name:<br> <input type="text" name="propertyname" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['name'] ?>"><br><br>
        Address:<br> <input type="text" name="address" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['address'] ?>"><br><br>
        Description:<br> <input type="text" name="propertydes" value="<?php echo $_SESSION['propertyid' . $data["pn"]]['description'] ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
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