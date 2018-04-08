
 	/*
        ENLARG IMAGE METHOD:
        required the following tag in html file

        <img id="myImg" class="img">

        <div id="myModal" data-imgId="img# class="img-modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="imgEnlarge">
        <div id="caption"></div>

        */

    //using jquery
    $(function() {

    	var modal = document.getElementById('myModal');
    	var modalImg = document.getElementById("imgEnlarge");
    	var captionText = document.getElementById("caption");
    	var span = document.getElementsByClassName("close")[0];

    	$('.imgPreview').on('click', function() {
            debugger;
    		modal.style.display = "block";
    		modalImg.src = $(this).prop('src')
    		captionText.innerHTML = $(this).attr("alt");


    	});

    	$('.close').on('click', function() {
    		modal.style.display = "none";
    	});



    });